<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Image;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        if(request()->wantsJson()){

            return response()->json($categories);
        }
        return view('backend.category.category_all',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.category_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //rasmaka wargirawatawa
       $image = $request->file('category_image');
       //naweki nwey le nrawa bam shewaya 20282.png
       $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
       //ba package image intervation size rasmaka kam krawataa
       Image::make($image)->resize(120,120)->save('upload/category/'.$name_gen);
       //rasmaka lam shwena save krawa
       $save_url = 'upload/category/'.$name_gen;
       //inserti datakan krawa bo naw databasaka
     $category =   Category::insert([
           'category_name'=>$request->category_name,
           'category_slug'=>strtolower(str_replace(' ','-',$request->category_name)),
           'category_image'=>$save_url,
       ]);
     if(request()->wantsJson()){
         return response()->json([
             'msg'=>'Category Added successfully',

         ]);
     };
       $notification = array(
           'message' =>'category Added successfully',
           'alert-type' => 'success'
       );
       return redirect()->route('categories.index')->with($notification);

    }
    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Category = Category::findOrFail($id);
        if(request()->wantsJson()){
            return response()->json($Category);
        }
        return view('backend.category.category_edit',compact('Category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $old_img = $request->old_image;

        if ($request->file('category_image')) {

        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(120,120)->save('upload/category/'.$name_gen);
        $save_url = 'upload/category/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

$category = Category::findOrFail($id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            'category_image' => $save_url,
        ]);
       if(request()->wantsJson()){
         return response()->json([
             'msg'=>'Category Updated successfully',
             'status'=>201,
             'data'=>$category,
         ]);
        };
       $notification = array(
            'message' => 'Category Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('categories.index')->with($notification);

        } else {

          $category =    Category::findOrFail($id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
        ]);
     if(request()->wantsJson()){
         return response()->json([
             'msg'=>'Category Updated successfully',
         ]);
        };
       $notification = array(
            'message' => 'Category Updated without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);

        } // end else
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $img = $category->category_image;
        unlink($img );

        Category::findOrFail($id)->delete();
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Category Deleted successfully',
                'status'=>201,

            ]);
        }
        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}