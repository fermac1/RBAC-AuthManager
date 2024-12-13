<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $role = Role::where('name', 'user')->first();

        if (!$role) {
            return response()->json(['error' => 'Role not found'], 400);
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role_id' => $role->id
        ]);

        $token = JWTAuth::fromUser($user);
       $cookie = cookie('jwt', $token, 60, null, null, true, true);

        return redirect('/home')->with('success', "Account successfully registered.")
        ->withCookie($cookie);
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (! $token = JWTAuth::attempt($credentials)) {
                return redirect('/')
                ->with('error', 'Invalid Credentials');
            }

            $user = Auth::user();
            $token = JWTAuth::fromUser($user);

            $cookie = cookie('jwt', $token, 60, null, null, true, true);

            session()->flash('success', 'Login successful!');

            return redirect('/home')
            ->withCookie($cookie);
        } catch (JWTException $e) {
               Log::error('Could not create token:', ['error' => $e->getMessage()]);
            return redirect('/')
                ->with('error', 'Internal server error');
        }
    }

    public function logout(Request $request)
    {
        try {
            $token = $request->bearerToken() ?? $request->cookie('jwt');

            if (!$token) {

                return redirect()->with('error' , 'Token not provided');

            }
            JWTAuth::invalidate($token);

            return redirect('/')->with('success', 'Successfully logged out')->withCookie(cookie()->forget('jwt'));

        } catch (\Exception $e) {
            return redirect()->with('error' , 'Could not log out, please try again');

        }
    }
}
