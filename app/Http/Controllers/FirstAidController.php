<?php

namespace App\Http\Controllers;

use App\FirstAid;
use Illuminate\Http\Request;

class FirstAidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $first_aid = FirstAid::orderBy('id', 'desc')->get();
        return view('backend.pages.first_aid', compact('first_aid'));
    }

    public function save(Request $request) {
        $first_aid = FirstAid::create($request->all());
        
        return redirect()->back()->with('success','Successfully Added');
    }
    
    public function edit($id)
    {
        $first_aid = FirstAid::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('first_aid'));
    }
    
    public function update(Request $request, $id)
    {
        FirstAid::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }
    
    public function destroy($id)
    {
        $first_aid = FirstAid::find($id);
        $first_aid->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
