<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    { 
        $user = User::where('email', $request->email)->first();
        
         if (!$user || !Hash::check($request->password, $user->password)) {
             throw ValidationException::withMessages([
                 'email' => ['The provided credentials are incorrect.'],
             ]);
         } 
        $credential = [
            'email' => $request->email, 
            'password' => $request->password,
        ];  
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
    public function logOut(){
        Auth::logout();
        return redirect()->route('login')->with('success', 'Admin logout successfully!.');
    }
}
