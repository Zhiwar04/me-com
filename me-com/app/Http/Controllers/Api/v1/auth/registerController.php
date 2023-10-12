<?php

namespace App\Http\Controllers\Api\v1\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\vendorReg;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class registerController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;

        if ($request->has('role')) {
            $user->role = $request->role;
        }

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        auth()->attempt(['email' => $user->email, 'password' => $request->password]);

        $token = auth()->user()->createToken('!!**$$zhiwar@@##shaida@@##zh%^&sh%^&!!**$$')->accessToken;

        if ($user) {
            return response()->json([
                'message' => 'User Created Successfully',
                'user' => $user,
                'token' => $token  // Fixed the array key-value pair here
            ], 200);
        }
    }
    public function becomeVendor(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'vendor_join'=>'required',
            'username'=>'required',
            'phone'=>'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt( $request->password);
        $user->vendor_join = $request->vendor_join;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->role = 'vendor';
        $user->status = 'inactive';
        $user->save();


        auth()->attempt(['email' => $user->email, 'password' => $request->password]);

        $token = auth()->user()->createToken(env('PASSPORT_CLIENT_SECRET'))->accessToken;
        if ($user) {
            $vuser = User::where('role','admin')->get();
            Notification::send($vuser, new vendorReg($request));
            return response()->json([
                'message' => 'User Created Successfully',
                'user' => $user,
                'token' => $token  // Fixed the array key-value pair here
            ], 200);
        }
        else {
            // Authentication failed, handle the error
            return response()->json([
                'message' => 'Authentication failed. Check your credentials.',
            ], 401);
        }

    }
}