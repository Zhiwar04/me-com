<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(!auth()->attempt($request->only('email','password'))){
            return response()->json([
                'message' => 'Invalid login details'
            ],401);
        }
  // auth attempt is a function that check the email and password and return true or false if the user is exist or not
  // if the user is exist it will return true and if not it will return false
  // if the user is exist it will create a token for the user and return the user and the token
  // if the user is not exist it will return a message that the user is not exist
         $token = auth()->user()->createToken('!!**$$zhiwar@@##shaida@@##zh%^&sh%^&!!**$$')->accessToken;

        return response()->json([
            'user' => auth()->user(),
            'token' => $token]);
    }
}