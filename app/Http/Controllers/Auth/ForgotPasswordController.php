<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Generate a JWT token
            $token = JWTAuth::fromUser($user);

            // Send reset email
            $resetLink = route('password.reset.form', ['token' => $token]);
            Mail::to($user->email)->send(new PasswordResetMail($resetLink));

            return back()->with('success', 'Password reset link sent to your email.');
        }else{

            return back()->with('error', 'User not found');
        }


    }

    public function showResetForm($token)
    {
        try {
           JWTAuth::setToken($token)->authenticate();

            return view('auth.reset-password', ['token' => $token]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid or expired token'], 400);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        try {
            $user = JWTAuth::setToken($request->token)->authenticate();

            $user->password = bcrypt($request->password);
            $user->save();

            return redirect('/')->with('success', 'Password successfully updated');
        } catch (\Exception $e) {
            return back()->with('error', 'Invalid or expired token');
        }
    }
}
