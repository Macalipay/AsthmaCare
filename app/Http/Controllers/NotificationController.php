<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $notifications = notification::with('user_notif')->orderBy('id')->get();
        $count = notification::with('user_notif')->where('status', 0)->count();
        return response()->json(compact('notifications', 'count'));
    }

}
