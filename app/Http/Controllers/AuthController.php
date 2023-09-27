<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

class AuthController extends Controller
{
    //login
    public function login(Request $request)
    {

        if ($request->isMethod('get')) {
            return view('auth.login');
        }
        $request->validate(['email' => 'required|email', 'password' => 'required']);

        if (!auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) {

            return redirect()->back()->with([
                'success' => 0,
                'msg' => 'Invalid Login credentials'
            ]);
        }
        return Redirect::intended(route('home'))->with([
            'success' => 1,
            'msg' => 'Successfully logged in',
        ]);

    }
    public function logout(Request $request)
    {
        auth()->logout();

        return redirect()->route('login')->with([
            'success' => 1,
            'msg' => 'Successfully signed out',
        ]);
    }
}