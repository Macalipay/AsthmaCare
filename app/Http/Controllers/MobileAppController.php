<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class MobileAppController extends Controller
{

    protected function register(Request $request) {
        $request['password'] = Hash::make($request->password);
        $user = User::create($request->all());

        return "Success";
    }

}
