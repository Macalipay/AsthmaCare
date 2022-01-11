<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Hash;
use App\ModelHasRole;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function index() {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('backend.pages.company', compact('companies'));
    }

    public function store(Request $request) {
        $company = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'photo' => ['required'],
        ]);

        $user = User::select('id')->orderBy('id', 'desc')->first();

        $file = $request->photo->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);

        $imageName = $filename.time().'.'.$request->photo->extension();  
        $image = $request->photo->move(public_path('img/permit'), $imageName);

        $requestData = $request->all();
        $requestData['photo'] = $imageName;


        $company = Company::create([
            'company_name' => $request->company_name,
            'address' => $request->address,
            'contact' => $request->contact,
            'city' => $request->city,
            'photo' => $imageName,
        ]);

         $user = User::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'company_id' => $company->id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

         ModelHasRole::create([
            'role_id' => 3,
            'model_type' => 'App\User',
            'model_id' => $user->id,
        ]);

        return redirect()->back()->with('success','Successfully Added');
    }
    
    public function edit($id)
    {
        $companies = Company::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('companies'));
    }
    
    public function update(Request $request, $id)
    {
        Company::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }
    
    public function destroy($id)
    {
        $companies = Company::find($id);
        $companies->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }

    public function status($id)
    {
        $companies = Company::find($id);
        $companies->delete();
        return redirect()->back()->with('success','Successfully Change Status!');
    }
}
