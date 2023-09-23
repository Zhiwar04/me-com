<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    $roles = Role::all();
    if(request()->wantsJson()){
        return response()->json($roles);
    }
    return view('backend.pages.roles.all_roles',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.roles.add_roles');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,

        ]);
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Roles Inserted successfully',
                'status'=>201,
                'data'=>$role,
            ]);
        };

        $notification = array(
            'message' => 'Roles Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('roles.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::findOrFail($id);
        if(request()->wantsJson()){
            return response()->json($roles);
        }
        return view('backend.pages.roles.edit_roles',compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

       $role =  Role::findOrFail($id)->update([
            'name' => $request->name,

        ]);
       if(request()->wantsJson()){
           return response()->json([
               'msg'=>'Roles Updated successfully',
               'status'=>201,
               'data'=>$role,
           ]);
         };
        $notification = array(
            'message' => 'Roles Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('roles.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::findOrFail($id)->delete();
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Roles Deleted successfully',
                'status'=>201,
            ]);
        };
       $notification = array(
            'message' => 'Roles Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}