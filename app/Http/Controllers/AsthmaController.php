<?php

namespace App\Http\Controllers;

use App\Asthma;
use App\Symptoms;
use Illuminate\Http\Request;

class AsthmaController extends Controller
{
    
    public function index() {
        $types = Asthma::orderBy('id', 'desc')->get();
        $symptoms = Symptoms::orderBy('id', 'desc')->get();
        return view('backend.pages.asthma', compact('types', 'symptoms'));
    }

    public function save(Request $request) {
        $symptoms = Asthma::create($request->all());
        
        return redirect()->back()->with('success','Successfully Added');
    }
    
    public function edit($id)
    {
        $symptoms = Asthma::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('symptoms'));
    }
    
    public function update(Request $request, $id)
    {
        Asthma::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }
    
    public function destroy($id)
    {
        $symptoms = Asthma::find($id);
        $symptoms->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
