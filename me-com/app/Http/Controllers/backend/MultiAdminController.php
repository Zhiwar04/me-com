<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Validator;

class MultiAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alladminuser = User::where('role','admin')->latest()->get();
        if(request()->wantsJson()){
            return response()->json($alladminuser);
        }
        return view('backend.admin.all_admin',compact('alladminuser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.admin.add_admin',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:50',
            'username'=>'required|unique:users',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $notification = array(
            'message' => 'something goes wrong try again',
            'alert-type' => 'error'
        );
        if ($validator->fails()) {
         return redirect()->back()->with($notification);
        }
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }
       if(request()->wantsJson()){
            return response()->json([
                'msg'=>'New Admin User Inserted successfully',
                'status'=>201,
                'data'=>$user,
            ]);
        }
         $notification = array(
            'message' => 'New Admin User Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admins.index')->with($notification);

}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        if(request()->wantsJson()){
            return response()->json($user);
        }
        return view('backend.admin.edit_admin',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Admin User Updated successfully',
                'status'=>201,
                'data'=>$user,
            ]
        );
    }
         $notification = array(
            'message' => 'New Admin User Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admins.index')->with($notification);

}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
    if (!is_null($user)) {
        $user->delete();
    }
    if(request()->wantsJson()){
        return response()->json([
            'msg'=>'Admin User Deleted successfully',
            'status'=>201,
            'data'=>$user,
        ]);
    }
     $notification = array(
        'message' => 'Admin User Deleted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
    }

}