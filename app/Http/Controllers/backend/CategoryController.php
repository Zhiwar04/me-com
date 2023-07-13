<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

use Image;
class CategoryController extends Controller
{
    public function AllCategory(){
        $categories = Category::latest()->get();
           return view('backend.category.category_all',compact('categories'));
       }//end method AllCategory
       public function AddCategory(){
        return view('backend.category.category_add');
       }
       public function StoreCategory(Request $request){
        //rasmaka wargirawatawa
        $image = $request->file('category_image');
        //naweki nwey le nrawa bam shewaya 20282.png
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        //ba package image intervation size rasmaka kam krawataa
        Image::make($image)->resize(120,120)->save('upload/category/'.$name_gen);
        //rasmaka lam shwena save krawa
        $save_url = 'upload/category/'.$name_gen;
        //inserti datakan krawa bo naw databasaka
        Category::insert([
            'category_name'=>$request->category_name,
            'category_slug'=>strtolower(str_replace(' ','-',$request->category_name)),
            'category_image'=>$save_url,
        ]);
        $notification = array(
            'message' =>'category Added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.category')->with($notification);
       }
       public function EditCategory($id){
        $Category = Category::findOrFail($id);
        return view('backend.category.category_edit',compact('Category'));
       }
       public function UpdateCategory(Request $request){

        $category_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('category_image')) {

        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(120,120)->save('upload/category/'.$name_gen);
        $save_url = 'upload/category/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            'category_image' => $save_url,
        ]);

       $notification = array(
            'message' => 'Category Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);

        } else {

             Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
        ]);

       $notification = array(
            'message' => 'Category Updated without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);

        } // end else

    }// End Method
    public function DeleteCategory($id){

        $category = Category::findOrFail($id);
        $img = $category->category_image;
        unlink($img );

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

}