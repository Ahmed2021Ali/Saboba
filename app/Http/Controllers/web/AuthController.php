<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('dashboard.auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = [
            'phone' => $request->phone,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials)) {
            flash()->success('تم تسجيل الدخول بنجاح');
            return redirect()->route('home'); // Redirect to a home page or dashboard
        }
        flash()->error('بيانات تسجيل الدخول غير صحيحة');
        return redirect()->back()->withInput();
    }


    public function home()
    {
        return view('dashboard.home');
    }


    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            flash()->success('تم تسجيل الخروج بنجاح');
        } else {
            flash()->error('لم يتم تسجيل الخروج');
        }
        return redirect()->route('login.form');
    }
}
