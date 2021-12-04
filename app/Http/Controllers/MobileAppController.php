<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\asthma;
use App\Patient;
use App\Appointment;
use App\ActionPlan;
use App\Company;
use App\ModelHasRole;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Auth;

class MobileAppController extends Controller
{

    protected function register(Request $request) {
        
        $message = "";
        $last_id = "";
        if(User::where('email', $request->email)->where('username', $request->username)->get()->count() === 1) {
            $message = "both";
        }
        else if(User::where('email', $request->email)->get()->count() === 1) {
            $message = "email";
        }
        else if(User::where('username', $request->username)->get()->count() === 1) {
            $message = "username";
        }
        else {
            $request['password'] = Hash::make($request->password);
            $user = User::create($request->all());
            $last_id = $user->id;

            $data = ModelHasRole::create([
                'role_id' => 5,
                'model_type' => 'App\User',
                'model_id' => $last_id,
            ]);

            $message = "success";
        }
        

        return array("message"=>$message, "id"=>$last_id);
    }

    protected function login(Request $request) {
        $message = "";
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('username', $request->username)->with('user_role')->first();
            $message = "success";
        }
        else {
            $user = null;
            $message = "error";
        }
        return array("message"=>$message, "data"=>$user);
    }

    protected function getDoctor(Request $request) {
        $doctor = User::with('user_role', 'schedule')->whereHas('user_role', function($query) {
            return $query->where('role_id', 4);
        })->whereHas('schedule', function($query) use($request){
            return $query->where('day', '=', $request->day);
        })->where('company_id', $request->id)->get();
        return array("data"=>$doctor);
    }

    protected function getCompany() {
        $company = Company::get();
        return array("data"=>$company);
    }

    protected function getAsthma() {
        $asthma = asthma::with('symptoms')->get();
        return array("data"=>$asthma);
    }

    protected function setAppointment(Request $request) {
        $patient = array(
            "firstname" => $request->firstname,
            "middlename" => $request->middlename,
            "lastname" => $request->lastname,
            "asthma_id" => $request->asthma_id,
            "asthma_level" => '',
            "gender" => $request->gender,
            "birthday" => $request->birthday,
            "contact" => $request->contact,
            "email" => $request->email
        );

        $patient_save = Patient::create($patient);
        $last_id = $patient_save->id;
        
        $appointment = array(
            "date" => $request->date,
            "time" => $request->time,
            "doctor_id" => $request->doctor_id,
            "remarks" => $request->remarks,
            "patient_id" => $last_id,
            "user_id" => $request->user_id,
            "status" => 0
        );

        $appointment_save = Appointment::create($appointment);
        
        return array("message"=>"success");

    }
    
    protected function getAppointment(Request $request) {
        $appointment = Appointment::with('patient')->where('user_id', $request->id)->orderBy('date', 'desc')->orderBy('time', 'asc')->get();
        
        return array("data"=>$appointment);
    }

    protected function getExistingAppointment(Request $request) {
        $appointment = Appointment::where('date', $request->date)->where('doctor_id', $request->doctor_id)->where('status', '=', '0')->orWhere('status', '=', '1')->orderBy('date', 'desc')->get();
        
        return array("data"=>$appointment);
    }

    protected function getIncomingPatient(Request $request) {

        $appointment = Appointment::with('patient')->where('doctor_id', $request->id)->where('status', 'approved')->whereDate('date', '=', Carbon::today()->toDateString())->orderBy('date', 'desc')->get();
        return array("data"=>$appointment);
        
    }

    protected function getPatientList(Request $request) {

        $patient = Patient::with('asthma')->orderBy('firstname', 'asc')->get();
        return array("data"=>$patient);
        
    }
    
    protected function getIncomingAppointment(Request $request) {

        $appointment = Appointment::with('patient')->where('doctor_id', $request->id)->where('status', 'approved')->orderBy('date', 'desc')->get();
        return array("data"=>$appointment);
        
    }

    protected function getPatientHistory(Request $request) {

        $appointment = Appointment::with('patient')->where('doctor_id', $request->id)->where('status', 'done')->orderBy('date', 'desc')->get();
        return array("data"=>$appointment);
        
    }
    
    protected function setActionPlan(Request $request) {

        $action_plan_save = ActionPlan::create($request->all());
        
        return array("message"=>"success");

    }
    
    protected function getActionPlan(Request $request) {

        $action_plan = ActionPlan::where('user_id', $request->id)->get();
        
        return array("data"=>$action_plan);

    }
    
    protected function updateStatus(Request $request) {

        $appointment = Appointment::where('id', $request->id)->update(["status"=>$request->status]);
        
        return array("message"=>"success");

    }

}
