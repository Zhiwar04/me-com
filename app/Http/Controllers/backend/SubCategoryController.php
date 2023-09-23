<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\{Category, SubCategory};
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::with('Category')->latest()->get();
        if(request()->wantsJson()){
            return response()->json($subcategories);
        }
        return view('backend.subcategory.subcategory_all',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::OrderBy('category_name','ASC')->get();
        if(request()->wantsJson()){
            return response()->json($categories);
        }

        return view('backend.subcategory.subcategory_add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $sub  =   SubCategory::insert([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_slug'=>strtolower(str_replace(' ','-',$request->subcategory_name))
        ]);
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'SubCategory Added successfully',

            ]);
        };
        $notification = array(
            'message' =>'subcategory Added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('subcategories.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $subcat = SubCategory::where('category_id',$id)->orderBy('subcategory_name','ASC')->get();
        if(request()->wantsJson()){
            return response()->json($subcat);
        };
        return json_encode($subcat);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::OrderBy('category_name','ASC')->get();
                $subcategory = SubCategory::with('category')->findOrFail($id);
                if(request()->wantsJson()){
                    return response()->json(
                       $subcategory
                    );
                }
                return view('backend.subcategory.subcategory_edit',compact('categories','subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

      $sub =   SubCategory::findOrFail($id)->update([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_slug'=>strtolower(str_replace(' ','-',$request->subcategory_name))
        ]);
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'SubCategory Updated successfully',
                'status'=>201,
                'data'=>$sub,
            ]);
        };
        $notification = array(
            'message' =>'subcategory Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('subcategories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SubCategory::findOrFail($id)->delete();
                $notification = array(
                    'message' =>'subcategory Deleted successfully',
                    'alert-type' => 'success'
                );
                if(request()->wantsJson()){
                    return response()->json([
                        'msg'=>'SubCategory Deleted successfully',
                        'status'=>201,
                    ]);
                };
                return redirect()->route('subcategories.index')->with($notification);
    }
}
