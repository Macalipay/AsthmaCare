<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index() {
           
        return view('backend.pages.appointment', compact('calendar', 'appointments'));
    }

    public function save(Request $request) {
        $appointments = Appointment::create($request->all());
        
        return redirect()->back()->with('success','Successfully Added');
    }
    
    public function edit($id)
    {
        $appointments = Appointment::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('appointments'));
    }
    
    public function update(Request $request, $id)
    {
        Appointment::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }
    
    public function destroy($id)
    {
        $appointments = Appointment::find($id);
        $appointments->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
