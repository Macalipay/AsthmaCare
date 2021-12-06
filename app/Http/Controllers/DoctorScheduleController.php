<?php

namespace App\Http\Controllers;

use App\DoctorSchedule;
use Illuminate\Http\Request;

class DoctorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $doctorSchedule = DoctorSchedule::where('doctor_id', $request->doctor_id)->where('day',$request->day)->count();
        if($doctorSchedule >= 1) {
            return 'failed';
        }
        else {
            DoctorSchedule::create($request->all());
            return 'success';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DoctorSchedule  $doctorSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $sched = DoctorSchedule::where('doctor_id', $request->doctor_id)->get();
        return $sched;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DoctorSchedule  $doctorSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorSchedule $doctorSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DoctorSchedule  $doctorSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorSchedule $doctorSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DoctorSchedule  $doctorSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorSchedule $doctorSchedule)
    {
        //
    }
}
