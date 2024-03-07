<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    public function getAllUsers()
    {
        $users = User::where('role', 'User')->get();
        return view('admin.users.all', ['users' => $users]);
    }
    public function archive($id)
    {
        $user = User::findOrFail($id);
        $user->archive = true;
        $user->save();
        return redirect()->route('users.all')->with('success', 'User archive successfully!');
    }
}
