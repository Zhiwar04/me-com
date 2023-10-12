<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ActiveUserController extends Controller
{
    public function AllUser()
    {
        $users = User::where('role', 'user')->latest()->get();
        if(request()->wantsJson()){
            return response()->json($users);
        }
        return view('backend.user.user_all_data', compact('users'));
    } //end method
    public function AllVendor()
    {
        $vendors = User::where('role', 'vendor')->latest()->get();
        if(request()->wantsJson()){
            return response()->json($vendors);
        }
        return view('backend.user.vendor_all_data', compact('vendors'));
    } //end method
}