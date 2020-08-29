<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest:admin')->except('logout');
    }

    public function login(Request $request) {

        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $status = Auth::guard('admin')->attempt($credentials, $request->remember);

        if($status) {
            return redirect()->intended(route('home-admin'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function index() {
        return view('auth.login-admin');
    }
}
