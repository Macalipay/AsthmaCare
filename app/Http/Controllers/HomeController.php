<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $appointment = Appointment::count();
        $ongoing = Appointment::where('status', 0)->count();
        $completed = Appointment::where('status', 1)->count();
        $cancelled = Appointment::where('status', 3)->count();
        $latest_appointments = Appointment::get(); 
        return view('backend.pages.dashboard', compact('appointment', 'ongoing', 'completed', 'cancelled', 'latest_appointments'));
    }
}
