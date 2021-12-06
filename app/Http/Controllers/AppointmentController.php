<?php

namespace App\Http\Controllers;

use App\Appointment;
use Auth;
use DB;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use MaddHatter\LaravelFullcalendar\Event;

class AppointmentController extends Controller
{
    public function index(Request $request) 
    {

        if($request->ajax()) {
            if(Auth::user()->roles->first()->name == 'Staff') {
                $data = Appointment::with('patient')->select('id', \DB::raw('(CASE 
                                            WHEN status = 0 THEN CONCAT( time, " ( On-Going )") 
                                            WHEN status = 1 THEN CONCAT( time, " ( Completed )")
                                            WHEN status = 2 THEN CONCAT( time, " ( Cancelled )")
                                            ELSE CONCAT( time, " ( Blocked Schedule )")
                                            END) AS title'), 'date as start', 'date as end')->whereDate('date', '>=', $request->start)
                ->whereDate('date',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);
            } else if(Auth::user()->roles->first()->name == 'Doctor') {
                $data = Appointment::with('patient', 'doctor')->select('id', \DB::raw('(CASE 
                                        WHEN status = 0 THEN CONCAT( time, " ( On-Going )") 
                                        WHEN status = 1 THEN CONCAT( time, " ( Completed )")
                                        WHEN status = 2 THEN CONCAT( time, " ( Cancelled )")
                                        ELSE CONCAT( time, " ( Blocked Sched )")
                                        END) AS title'), 'date as start', 'date as end')
                ->where('doctor_id', Auth::user()->id)->whereDate('date', '>=', $request->start)
                ->whereDate('date',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);
            } else {
                $data = Appointment::with('patient', 'doctor')->select('id', \DB::raw('(CASE 
                                        WHEN status = 0 THEN CONCAT( time, " ( On-Going )") 
                                        WHEN status = 1 THEN CONCAT( time, " ( Completed )")
                                        WHEN status = 2 THEN CONCAT( time, " ( Cancelled )")
                                        ELSE CONCAT( time, " ( Blocked Sched )")
                                        END) AS title'), 'date as start', 'date as end')
                ->whereDate('date', '>=', $request->start)
                ->whereDate('date',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);
            }
            return response()->json($data);
       }
 
        return view('backend.pages.appointment');
    }

    public function ajax(Request $request)
    {
 
        switch ($request->type) {
           case 'add':
              $event = Event::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = Event::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }

    public function save(Request $request) {
        $appointments = Appointment::create($request->all());
        
        return redirect()->back()->with('success','Successfully Added');
    }
    
    public function edit($id)
    {
        $appointments = Appointment::with('patient')->where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('appointments'));
    }

    public function completed(Request $request, $id)
    {
        Appointment::find($id)->update(['status' => 1]);
    }

    public function cancel($id)
    {
        Appointment::where('id', $id)->update(['status' => 2]);
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
