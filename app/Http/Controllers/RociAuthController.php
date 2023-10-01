<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class RociAuthController extends Controller
{
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }

    public function login(){
        return view("authentication.login");
    }

    public function register(){
        return view("authentication.register");
    }

    public function loginProcessor(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json([
                'status' => 'success',
                'message' => 'Authentication Successful',
                'color' => 'green',
            ]);
        }else{
            return response()->json(['status'=>'error', 'message'=>'Invalid Credentials', 'color'=>'red']);
        }
    }

    public function registerProcessor(Request $request){    
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
        ]);

        $create = User::create([
            'name' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'email' => $request->input('email'),
            'balance' => 1000,
        ]);

        if($create){
            return response()->json([
                'status' => 'success',
                'message' => 'Registration Successful',
                'color' => 'green',
            ]);
        }
    }
}
