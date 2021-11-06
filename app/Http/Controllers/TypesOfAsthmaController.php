<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypesOfAsthma;

class TypesOfAsthmaController extends Controller
{
    //
    public function index() {
        $types = TypesOfAsthma::orderBy('id', 'desc')->get();
        return view('backend.pages.types', compact('types'));
    }

    public function save(Request $request) {
        $symptoms = TypesOfAsthma::create($request->all());
        
        return redirect()->back()->with('success','Successfully Added');
    }
    
    public function edit($id)
    {
        $symptoms = TypesOfAsthma::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('symptoms'));
    }
    
    public function update(Request $request, $id)
    {
        TypesOfAsthma::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }
    
    public function destroy($id)
    {
        $symptoms = TypesOfAsthma::find($id);
        $symptoms->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
