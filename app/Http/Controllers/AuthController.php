<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
       // dd($request->all());
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        $user = $request->only('email', 'password');
        if (Auth::attempt(['email' => $user['email'], 'password' => $user['password']])) {
            return view('content.pages.pages-home');
        } else {
            return back()->with('error', 'please enter correct crendential');
        }
    }
    public function logout()
    {
        return redirect('auth/login-basic');
    }
}