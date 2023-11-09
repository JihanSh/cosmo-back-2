<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class SubCategoryController extends Controller
{
    public function addSubcategory(Request $request){
        $subcategory= new Subcategory;
        $subcategoryName=$request->input('subcategoryName');
        $subcategory->subcategoryName=$subcategoryName;
        $category=json_decode($request->input('category_id'));
        $subcategory->save();
        $subcategory->category()->sync($category);
        return response()->json([
            'message'=>$request->all()
        ]);
    }

    public function getSubcategory(Request $request, $id){
        $subcategory= Subcategory::find($id);
        return response()->json([
            'message'=>$subcategory
        ]);
    }


    //  public function getSubcategoryByCategory(Request $request, $categoryId){
    //     $subcategory= Subcategory::where('category_id', $categoryId)->get();
    //     return response()->json([
    //         'message'=>$subcategory
    //     ]);
    // }






    public function editSubcategory(Request $request, $id){
        $subcategory= Subcategory::find($id);
        $inputs=$request->except('_method', 'category_id');
        $subcategory->update($inputs);
          if ($request->has('category_id')){
            $subcategory->category()->sync(json_decode($request->input('category_id')));
        }

        $subcategory->save();
        return response()->json([
            'message'=>$subcategory
        ]);
    }

    public function getAllSubcategory(Request $request){
        $subcategory= Subcategory::all();
        return response()->json([
            'message'=>$subcategory
        ]);
    }

    public function deleteSubcategory(Request $request, $id){
        $subcategory= Subcategory::find($id);
        $subcategory->delete();
        return response()->json([
            'message'=>$subcategory
        ]);
    }








}
