<?php

namespace App\Http\Controllers\Api\v1\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class logoutController extends Controller
{
    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Logout Successfully'
        ]);
    }
    public function getUser(){
        return response()->json([
            'user' => auth()->user()
        ]);
    }
}