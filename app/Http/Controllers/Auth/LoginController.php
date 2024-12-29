<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(){
        return view('Auth.login');
    }
    public function checkLogin(LoginRequest $request){
        $user = User::where('email', $request->email)->first();
        
         if (!$user || !Hash::check($request->password, $user->password)) {
             throw ValidationException::withMessages([
                 'email' => ['The provided credentials are incorrect.'],
             ]);
         } 
         $credentials = $request->only('email', 'password');
         if (Auth::attempt($credentials)) {
            $token = $user->createToken('YourAppName')->accessToken;
            $user->token = $token;
           return response()->json([
               'status' => 200,
               'user' => $user,
           ]);
        }
    
    }
}
