<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->except(['_token']);

        if (auth()->attempt($credentials)) {
            return redirect()->to('/');
        }

        return redirect()->back()->with('message', 'Invalid credentials');
    }
}
