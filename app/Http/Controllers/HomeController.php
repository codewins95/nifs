<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function  authCheck()
    {
        $isAuthenticated = Auth::check();
        return response()->json(['isAuthenticated' => $isAuthenticated]);
    }

    public function loginAuth(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            return response()->json(['isAuthenticated' => true]);
        } else {
            return response()->json(['isAuthenticated' => false]);
        }
    }
}
