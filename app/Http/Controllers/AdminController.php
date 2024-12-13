<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public function makeAdmin($id)
    {
        if (Gate::allows('is-super-admin', auth()->user())) {
            $user = User::findOrFail($id);
            if($user->role->name === 'admin'){

                return back()->with('error', 'User is an admin');
            }else{

                $adminRole = Role::where('name', 'admin')->first();
                $user->role()->associate($adminRole);
                $user->save();

                return back()->with('success', 'User is now an admin');
            }
        }else{

            return back()->with('error', 'You are Unauthorized');
        }

    }

    public function removeAdmin($id)
    {
        $user = User::findOrFail($id);

        if (Gate::denies('is-super-admin')) {
            return back()->with('error', 'You are Unauthorized');
        }else{

            if($user->role->name !== 'admin'){

                return back()->with('error', 'User is not an admin');
            }else{

                $adminRole = Role::where('name', 'admin')->first();
                $user->role()->dissociate($adminRole);

                $userRole = Role::where('name', 'user')->first();

                $user->role()->associate($userRole);

                $user->save();

                return back()->with('success', 'User is no more an admin');
            }
        }

    }
}
