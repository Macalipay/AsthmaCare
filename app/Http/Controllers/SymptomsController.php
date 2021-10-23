<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Symptoms;

class SymptomsController extends Controller
{
    //
    public function index() {
        $symptoms = Symptoms::orderBy('id', 'desc')->get();
        return view('backend.pages.symptoms', compact('symptoms'));
    }

    public function save(Request $request) {
        $symptoms = Symptoms::create($request->all());
        
        return redirect()->back()->with('success','Successfully Added');
    }
    
    public function edit($id)
    {
        $symptoms = Symptoms::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('symptoms'));
    }
    
    public function update(Request $request, $id)
    {
        Symptoms::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }
    
    public function destroy($id)
    {
        $symptoms = Symptoms::find($id);
        $symptoms->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
