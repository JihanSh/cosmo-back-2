<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function addDepartment(Request $request){
        $department= new Department;
        $departmentName=$request->input('departmentName');
        $visibility=$request->input('visibility');
        $department->visibility=$visibility;
        $department->departmentName=$departmentName;
        $department->save();
        return response()->json([
            'message'=>$request->all()
        ]);
    }

    public function getDepartment(Request $request, $id){
        $department=Department::find($id);
        return response()->json([
            'message'=>$department
        ]);
    }

    public function editDepartment(Request $request, $id){
        $department= Department::find($id);
        $inputs=$request->except('_method');
        $department->update($inputs);

        return response()->json([
            'message'=>$department
        ]);
    }

    public function getAllDepartment(Request $request){
        $department= Department::all();
        return response()->json([
            'message'=>$department
        ]);
    }

    public function deleteDepartment(Request $request, $id){
        $department= Department::find($id);
        $department->delete();
        return response()->json([
            'message'=>$department
        ]);
    }

    // json_decode is to make sure that the array of categories for example is ontained as an array and not a json object
    // sync will take an array of ids and will in insert them in the pevet table
}
