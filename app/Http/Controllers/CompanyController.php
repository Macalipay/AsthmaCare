<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function index() {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('backend.pages.company', compact('companies'));
    }

    public function save(Request $request) {
        $companies = Company::create($request->all());
        
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
