<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App\ModelHasRoles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    
    protected function index() {

        $doctors = User::with('roles')->whereHas('roles', function(Builder $query) {
            $query->where('role_id','=','2');
        })->orderBy('id', 'desc')->get();

        return view('backend.pages.doctors', compact('doctors'));

    }

    protected function save(Request $request) {

        
        $input['email'] = $request->email;
        $input['username'] = $request->username;

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
            $request['password'] = Hash::make('doctor1');
            
            $doctor = User::create($request->all());
            $last_id = $doctor->id;
    
            $data = ModelHasRoles::create([
                'role_id' => 2,
                'model_type' => 'App\User',
                'model_id' => $last_id,
            ]);
            
            return redirect()->back()->with('success','Successfully Added');
        }
    }
    
    public function edit($id)
    {
        $doctor = User::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('doctor'));
    }
    
    public function update(Request $request, $id)
    {
        User::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }
    
    public function destroy($id)
    {
        $doctor = User::find($id);
        $roles = ModelHasRoles::where('model_id', $id);
        $doctor->delete();
        $roles->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }

}
