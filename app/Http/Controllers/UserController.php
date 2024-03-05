<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user()
    {
        return view('user.dashboard');
    }
    public function organizer()
    {
        return view('organizer.dashboard');
    }
    public function admin()
    {
        return view('admin.dashboard');
    }
}
