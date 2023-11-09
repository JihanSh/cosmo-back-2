<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Product;

class SizeController extends Controller
{
    public function addSize(Request $request){
        $size= new Size;
        $sizeInput=$request->input('size');
        $quantity=$request->input('quantity');
        $products_id=$request->input('products_id');
        $product= Product::find($products_id);
        $size->size=$sizeInput;
        $size->quantity=$quantity;
        $size->products()->associate($product);
        $size->save();
        return response()->json([
            'message'=>$request->all()
        ]);
    }

    public function getSize(Request $request, $id){
        $size= Size::find($id);
        return response()->json([
            'message'=>$size
        ]);
    }

    public function editSize(Request $request, $id){
        $size= Size::find($id);
        $inputs=$request->except('_method', 'product_id');
        $size->update($inputs);
        if ($request->has('product_id')){
            $product_id=$request->input('product_id');
            $size->products()->associate($product_id);
            $size->save();
        }

        return response()->json([
            'message'=>$size
        ]);
    }

    public function getAllSize(Request $request){
        $size= Size::all();
        return response()->json([
            'message'=>$size
        ]);
    }

    public function deleteSize(Request $request, $id){
        $size= Size::find($id);
        $size->delete();
        return response()->json([
            'message'=>$size
        ]);
    }

    public function getSizeOfProduct(Request $request, $productId) {
        $size = Size::where('products_id', $productId)->get();
        return response()->json(['message' => $size]);
    }
    








}
