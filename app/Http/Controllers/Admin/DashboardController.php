<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Plan;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $plans = Plan::all();
        $messages = Message::all(); // Assuming you have a Message model

        return view('admin.dashboard', compact('users', 'plans', 'messages'));
    }
}
