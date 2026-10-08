<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function showLogin() {
        if (Auth::check()) {
            return Redirect::to('Home/home');
        }
        return view('Home/login');
    }

    public function validaLogin(Request $request) {
        $data = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return Redirect::intended('/inicio');
        }
        return Redirect::back()->withInput();
    }

    public function Logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to('/login')->withInput();
    }
}
