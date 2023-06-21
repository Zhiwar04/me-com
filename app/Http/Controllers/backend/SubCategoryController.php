<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
class SubCategoryController extends Controller
{
    public function AllSubCategory(){
        $subcategories = SubCategory::latest()->get();
           return view('backend.subcategory.subcategory_all',compact('subcategories'));
       }//end method AllCategory
       public function AddSubCategory(){
              $categories = Category::OrderBy('category_name','ASC')->get();
              return view('backend.subcategory.subcategory_add',compact('categories'));
         }//end method AddCategory
         public function StoreSubCategory(Request $request){
            SubCategory::insert([
                'category_id'=>$request->category_id,
                'subcategory_name'=>$request->subcategory_name,
                'subcategory_slug'=>strtolower(str_replace(' ','-',$request->subcategory_name))
            ]);
            $notification = array(
                'message' =>'subcategory Added successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.subcategory')->with($notification);
           }//end method StoreSubCategory
              public function EditSubCategory($id){
                $categories = Category::OrderBy('category_name','ASC')->get();
                $subcategory = SubCategory::findOrFail($id);
                return view('backend.subcategory.subcategory_edit',compact('categories','subcategory'));
              }//end method EditSubCategory
              public function UpdateSubCategory(Request $request){
                 $subcat_id = $request->id;
                    SubCategory::findOrFail($subcat_id)->update([
                        'category_id'=>$request->category_id,
                        'subcategory_name'=>$request->subcategory_name,
                        'subcategory_slug'=>strtolower(str_replace(' ','-',$request->subcategory_name))
                    ]);
                    $notification = array(
                        'message' =>'subcategory Updated successfully',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('all.subcategory')->with($notification);
              }
              public function DeleteSubCategory($id){
                SubCategory::findOrFail($id)->delete();
                $notification = array(
                    'message' =>'subcategory Deleted successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('all.subcategory')->with($notification);
              } /// end method

              public function GetSubCategory($category_id){
                $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
                return json_encode($subcat);
              }
}