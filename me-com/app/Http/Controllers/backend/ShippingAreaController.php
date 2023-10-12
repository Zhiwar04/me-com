<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDivision;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $division = ShipDivision::latest()->get();
        if (request()->wantsJson()) {
            return response()->json($division);
        }
        return view('backend.ship.division.division_all', compact('division'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.ship.division.division_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $area =  ShipDivision::insert([

            'division_name' => $request->division_name,
        ]);
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'ShipDivision Inserted successfully',
                'status'=>201,
                'data'=>$area,
            ]);
        };
        $notification = array(
            'message' => 'ShipDivision Inserted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('divisions.index')->with($notification);
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
        $division = ShipDivision::findOrFail($id);
        if(request()->wantsJson()){
            return response()->json($division);
        }
        return view('backend.ship.division.division_edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

       $area  =  shipDivision::findOrFail($id)->update([
            'division_name' => $request->division_name,
        ]);
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'ShipDivision Updated successfully',
                'status'=>201,
                'data'=>$area,
            ]);
        };
        $notification = array(
            'message' => 'ShipDivision Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('divisions.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ShipDivision::findOrFail($id)->delete();
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'ShipDivision Deleted successfully',
                'status'=>201,
            ]);
        };
        $notification = array(
            'message' => 'ShipDivision Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}