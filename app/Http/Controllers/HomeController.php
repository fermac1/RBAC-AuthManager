<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('role');

        $users = User::with('role')->latest()->get();

         if ($user->role->name === 'admin' || $user->role->name === 'super-admin') {
            return view('admin.home', ['users' => $users]);
        } else {
            return view('home', ['users' => $users]);
        }
    }
}
