<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $token = $user->createToken('example-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login(Request $request){
        $credentials = $request->validate(['email' => ['required'], 'password' => ['required']]);
        // return $credentials;
        if(!Auth::attempt($credentials)){
            return response(['email' => 'Sorry it seems you credentials is not in our records'], 422);
        }
        $user = User::where('email', $credentials['email'])->first();
        $token = $user->createToken('example-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];

    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();

        return ;
    }
}
