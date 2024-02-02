<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check('admin')) {
            return redirect()->route('dashboard');
        }

        return view('frontend.home');
    }
    public function getDashboard(){
        $user = Auth::user();
        
        return view('frontend.dashboard',compact('user'));
    }
}