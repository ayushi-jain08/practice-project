<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    // Register Controller
    public function getRegister(){
      return view('frontend.registration');
    }
    public function RegisterStore(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required|email' ,
            'phone' => 'required|numeric',
            'address' => 'required' ,
            'password' => 'required' ,
        ]);

        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone = $req->phone; 
        $user->address = $req->address;
        $user->password = Hash::make($req->password);
        $user->save();

        $notification = array(
            'message' => 'You are registered successfully,now please login',
          'alert-type' => 'success'
        );
        
        return redirect()->route('login.user')->with($notification);
    }
    public function index($id, Request $req){
        $user = User::findOrFail($id);
        return view('frontend.EditUser', compact('user'));
    }
    public function store(Request $req){
        $id = $req->id ;
        $user = User::findOrFail($id);
        
        if(!$user){
            $notification = [
                'alert-type' => 'error',
                'message' => 'No such user found',
            ];
            return redirect()->route('dashboard')->with($notification);
        }
        $req->validate([
            'name' => 'required',
            'email' => 'required|email' ,
            'phone' => 'required|numeric',
            'address' => 'required' ,
        ]);

        $user->update($req->all());

        $notification = array(
            'message' => 'your profile updated successfully',
          'alert-type' => 'success'
        );
        
        return redirect()->route('dashboard')->with($notification);
    }
}