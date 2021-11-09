<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\asthma;
use App\Patient;
use App\Appointment;
use App\ModelHasRoles;
use Illuminate\Support\Facades\Hash;
use Auth;

class MobileAppController extends Controller
{

    protected function register(Request $request) {
        
        $message = "";
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

            $data = ModelHasRoles::create([
                'role_id' => 3,
                'model_type' => 'App\User',
                'model_id' => $last_id,
            ]);

            $message = "success";
        }
        

        return array("message"=>$message);
    }

    protected function login(Request $request) {
        $message = "";
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('username', $request->username)->with('roles')->first();
            $message = "success";
        }
        else {
            $user = null;
            $message = "error";
        }
        return array("message"=>$message, "data"=>$user);
    }

    protected function getDoctor() {
        $doctor = User::with('roles')->whereHas('roles', function($query) {
            return $query->where('role_id', 2);
        })->get();
        return array("data"=>$doctor);
    }

    protected function getAsthma() {
        $asthma = asthma::get();
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
            "age" => $request->age,
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
            "user_id" => $request->user_id
        );

        $appointment_save = Appointment::create($appointment);
        
        return array("message"=>"success");

    }

}
