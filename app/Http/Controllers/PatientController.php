<?php

namespace App\Http\Controllers;

use App\Patient;
use App\asthma;
use App\Appointment;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::orderBy('id', 'desc')->get();
        $asthmas = asthma::orderBy('id', 'desc')->get();
        return view('backend.pages.patient', compact('patients', 'asthmas'));
    }

    public function patient_history($id)
    {
        $patient = Patient::where('id', $id)->orderBy('id', 'desc')->first();
        $appointments = Appointment::where('patient_id', $id)->orderBy('id', 'desc')->get();
        return view('backend.pages.patient_history', compact('patient', 'appointments'));
    }

    public function store(Request $request) {
        $patients = Patient::create($request->all());
        
        return redirect()->back()->with('success','Successfully Added');
    }
    
    public function edit($id)
    {
        $patients = Patient::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('patients'));
    }
    
    public function update(Request $request, $id)
    {
        Patient::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }
    
    public function destroy($id)
    {
        $patients = Patient::find($id);
        $patients->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
