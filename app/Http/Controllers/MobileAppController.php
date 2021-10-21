<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
            $message = "success";
        }
        

        return array("message"=>$message);
    }

    protected function login(Request $request) {
        $message = "";
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('username', $request->username)->first();
            $message = "success";
        }
        else {
            $user = null;
            $message = "error";
        }
        return array("message"=>$message, "data"=>$user);
    }

}
