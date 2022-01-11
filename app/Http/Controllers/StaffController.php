<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use Auth;
use App\Company;
use App\ModelHasRole;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    protected function index() {

        $staff = User::with('roles')->where('company_id', Auth::user()->company_id)->whereHas('roles', function(Builder $query) {
            $query->where('role_id','=','3');
        })->orderBy('id', 'desc')->get();
        $company = Company::orderBy('id', 'desc')->get();

        return view('backend.pages.staff', compact('staff', 'company'));

    }

    protected function save(Request $request) {
        $input['email'] = $request->email;
        $input['username'] = $request->username;
        $request['birthday'] = date('Y-m-d', strtotime($request->birthday));

        $rules = array(
            'email' => 'unique:users,email',
            'username' => 'unique:users,username'
        );
        $validator = Validator::make($input, $rules);
        
        if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }
        else {
            $request['password'] = Hash::make('staff123');
            
            $staff = User::create($request->all());
            $last_id = $staff->id;
    
            $data = ModelHasRole::create([
                'role_id' => 3,
                'model_type' => 'App\User',
                'model_id' => $last_id,
            ]);
            
            return redirect()->back()->with('success','Successfully Added');
        }
    }
    
    public function edit($id)
    {
        $staff = User::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('staff'));
    }
    
    public function update(Request $request, $id)
    {
        $request['birthday'] = date('Y-m-d', strtotime($request->birthday));
        User::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }
    
    public function destroy($id)
    {
        $staff = User::find($id);
        $roles = ModelHasRole::where('model_id', $id);
        $staff->delete();
        $roles->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
