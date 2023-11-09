<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;


// For uploading images
use Illuminate\Support\Facades\Storage;



class BrandController extends Controller
{
    public function addBrand(Request $request){
        $brand= new Brand;
        
        $brandName=$request->input('brandName');
       
        $brand->brandName=$brandName;
        $brand->save();
        return response()->json([
            'message'=>$request->all()
        ]);
    }

    // the id named here should be the same as that used in the route
    public function getBrand(Request $request, $id){
        $brand= Brand::find($id);
        return response()->json([
            'message'=>$brand
        ]);
    }

    public function editBrand(Request $request, $id){
        $brand= Brand::find($id);
        $inputs=$request->except('_method');
        $brand->update($inputs);

        return response()->json([
            'message'=>$brand
        ]);
    }

  

    public function getAllBrand(Request $request){
        $brand= Brand::all();
        return response()->json([
            'message'=>$brand
        ]);
    }

    public function deleteBrand(Request $request, $id){
        $brand= Brand::find($id);
        $brand->delete();
        return response()->json([
            'message'=>$brand
        ]);
    }


}
