<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     //Login Controller
     public function getLogin(){
        return view('frontend.Login');
      }

      public function login(Request $request)
      {
          $request->validate([
              'email' => 'required|email',
              'password' => 'required',
          ]);
      
          $credentials = $request->only('email', 'password');
          if (Auth::guard('admin')->attempt($credentials, $request->get('remember'))) {
            // Authentication successful
            $admin = Auth::guard('admin')->user();
            $notification = [
                'alert-type' => 'success',
                'message' => 'You have logged in successfully.'
            ];
            return redirect()->route('dashboard')->with($notification);
        } else {
            // Authentication failed
            $notification = [
                'alert-type' => 'error',
                'message' => 'Invalid credentials. Please try again.',
            ];
            return redirect()->route('login.user')->withInput($request->except('password'))->with($notification);
        }
    
}
public function Logout () {
    Auth::guard('admin')->logout();
    return redirect()->route('logout.user'); 
   }
}