<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
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
        return view('backend.pages.roles.all_roles_permission',compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        // getpermissionGroups() method in User Model for get permission group name
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.roles.add_roles_permission',compact('roles','permissions','permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $key => $item){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

         $db=    DB::table('role_has_permissions')->insert($data);
        }
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Role Permission Added successfully',
                'status'=>201,
                'data'=>$db,
            ]);

        };

         $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('rolePermissions.index')->with($notification);
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
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Role Permission Updated successfully',
                'status'=>201,
                'data'=>$role,

            ]);
        }
        return view('backend.pages.roles.role_permission_edit',compact('role','permissions','permission_groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;
        if(request()->wantsJson()){
            $role->syncPermissions($permissions);
            return response()->json([
                'msg'=>'Role Permission Updated successfully',
                'status'=>201,
                'data'=>$role,

            ]);
        }
        if (!empty($permissions)) {
           $role->syncPermissions($permissions);
        }

         $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('rolePermissions.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    $role = Role::findOrFail($id);
    if (!is_null($role)) {
        $role->delete();
    }
    if(request()->wantsJson()){
        return response()->json([
            'msg'=>'Role Permission Deleted successfully',
            'status'=>201,
            'data'=>$role,

        ]);
    }
     $notification = array(
        'message' => 'Role Permission Deleted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
    }
}