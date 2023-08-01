<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function index()
    {
        return Inertia('');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function authenticate(LoginRequest $loginRequest)
    {
        $remember = ($loginRequest->remember == true) ? true : false;
        if (Auth::attempt(['email' => $loginRequest->user, 'password' => 'password'], $remember)) {
            return redirect()->intended('admin/dashboard');
        }
        if (Auth::attempt(['username' => $loginRequest->user, 'password' => 'password'], $remember)) {
            return redirect()->intended('admin/dashboard');
        }
        return back()->withErrors([
            'credentials_error' => ['The provided user/email and password does not match our records.']
        ]);
    }

}
