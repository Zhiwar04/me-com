<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        if(request()->wantsJson()){
            return response()->json($permissions);
        }
        return view('backend.pages.permission.all_permission',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.permission.add_permission');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,

        ]);
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Permission Inserted successfully',
                'status'=>201,
                'data'=>$role,
            ]);
        };
        $notification = array(
            'message' => 'Permission Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('permissions.index')->with($notification);
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
        $permission = Permission::findOrFail($id);
        if(request()->wantsJson()){
            return response()->json($permission);
        }
        return view('backend.pages.permission.edit_permission',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $permission =  Permission::findOrFail($id)->update([
             'name' => $request->name,
             'group_name' => $request->group_name,

         ]);
       if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Permission Updated successfully',
                'status'=>201,
                'data'=>$permission,
            ]);
        };
         $notification = array(
             'message' => 'Permission Updated Successfully',
             'alert-type' => 'success'
         );

         return redirect()->route('permissions.index')->with($notification);  //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Permission::findOrFail($id)->delete();
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Permission Deleted successfully',
                'status'=>201,
                'data'=>$id,
            ]);
        };
          $notification = array(
             'message' => 'Permission Deleted Successfully',
             'alert-type' => 'success'
         );

         return redirect()->back()->with($notification);
    }
}