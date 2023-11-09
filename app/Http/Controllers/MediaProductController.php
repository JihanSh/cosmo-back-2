<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\MediaProduct;

class MediaProductController extends Controller
{
    public function addImage(Request $request){
        $image= new MediaProduct;
        $media_product_id=$request->input('media_product_id');
        $product= Product::find($media_product_id);
        $image->MediaProduct()->associate($media_product_id);
        $image_path=$request->file('ImageURL')->store('images','public');
        $image->ImageURL=$image_path;
        $image->save();
        return response()->json([
            'message'=> $image
        ]);
    }

    public function getImage(Request $request, $id){
        $image= MediaProduct::find($id);
        return response()->json([
            'message'=>$image
        ]);
    }

      public function getImageByProduct(Request $request, $productId) {
        $image= MediaProduct::where('media_product_id', $productId)->get();
        return response()->json(['message' => $image]);
}







    public function getAllImage(Request $request){
        $image= MediaProduct::all();
        return response()->json([
            'message'=>$image
        ]);
    }

    public function editImage(Request $request, $id){
        $image= MediaProduct::find($id);
        $inputs=$request->except('_method', 'media_product_id');
        $image->update($inputs);
        if ($request->has('media_product_id')){
            $media_product_id=$request->input('media_product_id');
            $image->MediaProduct()->associate($media_product_id);
            $image_path=$request->file('ImageURL')->store('images','public');
            $image->ImageURL=$image_path;
            $image->save();
        }

        return response()->json([
            'message'=>$image
        ]);
    }

    public function deleteImage(Request $request, $id){
        $image= MediaProduct::find($id);
        $image->delete();
        return response()->json([
            'message'=>$image
        ]);
    }



}
