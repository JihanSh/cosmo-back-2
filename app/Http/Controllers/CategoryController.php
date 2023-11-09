<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Department;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        $category= new Category;
        $categoryName=$request->input('categoryName');
        $department=json_decode($request->input('department_id'));
        $category->categoryName=$categoryName;
        $category->save();
        $category->departments()->sync($department);
        return response()->json([
            'message'=>$request->all()
        ]);
    }

    public function getCategory(Request $request, $id){
        $category= Category::find($id);
        return response()->json([
            'message'=>$category
        ]);
    }

    //   public function getCategoryByDepartment(Request $request, $departmentId){
    //     $category= Category::where('departments_id', $departmentId)->get();
    //     return response()->json([
    //         'message'=>$category
    //     ]);
    // }


    public function editCategory(Request $request, $id){
        $category= Category::find($id);
        $inputs=$request->except('_method', 'department_id');
        $category->update($inputs);
        if ($request->has('department_id')){
          $category->departments()->sync(json_decode($request->input('department_id')));
      }

      $category->save();
        return response()->json([
            'message'=>$category
        ]);
    }

    public function getAllCategory(Request $request){
        $category= Category::all();
        return response()->json([
            'message'=>$category
        ]);
    }

    public function deleteCategory(Request $request, $id){
        $category= Category::find($id);
        $category->delete();
        return response()->json([
            'message'=>$category
        ]);
    }


}
