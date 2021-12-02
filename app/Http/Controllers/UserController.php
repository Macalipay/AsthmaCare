<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App\Role;
use App\ModelHasRole;

class UserController extends Controller
{
    //
    public function index() {
        $users = User::with('user_role')->whereHas('user_role', function(Builder $query) {
            $query->where('role_id','=','5');
        })
        ->orderBy('id', 'desc')->get();
        return view('backend.pages.users', compact('users'));
    }

    public function admin() {
        $users = User::with('user_role')->whereHas('user_role', function(Builder $query) {
            $query->where('role_id','=','1');
        })
        ->orderBy('id', 'desc')->get();
        return view('backend.pages.users', compact('users'));
    }

}
