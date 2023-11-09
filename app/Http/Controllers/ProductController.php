<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Collection;
class ProductController extends Controller
{
    public function addProduct(Request $request){
        $product= new Product;
        $title= $request->input('title');
        $design= $request->input('design');
        $visible= $request->input('visible');
        $price= $request->input('price');
        $description= $request->input('description');
        $name= $request->input('name');
        $country= $request->input('country');
        $washing= $request->input('washing');
        $color= $request->input('color');
        $fabric= $request->input('fabric');
        $sku= $request->input('sku');
        $sale= $request->input('sale');
        $quantity= $request->input('quantity');
        $currency= $request->input('currency');
        $shipping= $request->input('shipping');
        if ($request->hasFile('media1')) {
            $media1 = $request->file('media1')->store('images', 'public');
            } else {
            $media1 = null; 
            }
        if ($request->hasFile('media2')) {
        $media2 = $request->file('media2')->store('images', 'public');
        } else {
        $media2 = null; 
        }
         if ($request->hasFile('media3')) {
        $media3 = $request->file('media3')->store('images', 'public');
        } else {
        $media3 = null; 
        }
         if ($request->hasFile('media4')) {
        $media4 = $request->file('media4')->store('images', 'public');
        } else {
        $media4 = null; 
        }
         if ($request->hasFile('media5')) {
        $media5 = $request->file('media5')->store('images', 'public');
        } else {
        $media5 = null; 
        }
        $product->media1=$media1;
        $product->media2=$media2;
        $product->media3=$media3;
        $product->media4=$media4;
        $product->media5=$media5;
        $allowPurchase= $request->input('allowPurchase');
        $chargeTaxes= $request->input('chargeTaxes');
        $wearing= $request->input('wearing');
        $tags=json_decode($request->input('tag_id'));
        $collection=json_decode($request->input('collection_id'));
        $subcategory=json_decode($request->input('subcategory_id'));
        $brand_id=$request->input('brand_id');
        $brand= Brand::find($brand_id);
        $product->brand()->associate($brand);
        $product->productTitle=$title;
        $product->productVisible=$visible;
        $product->productDesign=$design;
        $product->productPrice=$price;
        $product->productDescription=$description;
        $product->productName=$name;
        $product->productCountry=$country;
        $product->productWashing=$washing;
        $product->productColor=$color;
        $product->productFabric=$fabric;
        $product->productSKU=$sku;
        $product->productSale=$sale;
        $product->productQuantity=$quantity;
        $product->productCurrency=$currency;
        $product->productShipping=$shipping;
        $product->productAllowPurchase=$allowPurchase;
        $product->productChargetaxes=$chargeTaxes;
        $product->productwearing=$wearing;
        $product->media1=$media1;
        $product->media2=$media2;
        $product->media3=$media3;
        $product->media4=$media4;
        $product->media5=$media5;
        $product->save();
        $product->tags()->sync($tags);
        $product->collections()->sync($collection);
        $product->subcategory()->sync($subcategory);

        return response()->json([
            'message'=>$request->all()
        ]);
    }

    public function getProduct(Request $request, $id){
        $product= Product::find($id);
        return response()->json([
            'message'=>$product
        ]);
    }


     public function getProductBySubcategory(Request $request, $subcategoryId) {
    $subcategory = Subcategory::find($subcategoryId);
    
    if (!$subcategory) {
        return response()->json(['message' => 'Subcategory not found'], 404);
    }
    
    $products = $subcategory->products;

    return response()->json(['message' => $products]);
}


 public function getProductsForCollection(Request $request, $collectionId) {
    $collection = Collection::find($collectionId);
    
    if (!$collection) {
        return response()->json(['message' => 'Collection not found'], 404);
    }
    
    $products = $collection->products;

    return response()->json(['message' => $products]);
}







public function getProductByCollection(Request $request, $productId)
{
    $product = Product::find($productId);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    // Get the collections associated with the product
    $collections = $product->collections;

    if ($collections->isEmpty()) {
        return response()->json(['message' => 'No collections found for the product'], 404);
    }

    // Get all products associated with the same collection
    $productsInCollection = [];

    foreach ($collections as $collection) {
        $productsInCollection = array_merge($productsInCollection, $collection->products->all());
    }

    return response()->json(['message' => $productsInCollection]);
}



    public function editProduct(Request $request, $id){
        $product= Product::find($id);
        $inputs=$request->except('_method', 'subcategory_id', 'tag_id', 'brand_id', 'collection_id', 'media1');
        $product->update($inputs);
        if ($request->has('subcategory_id')){
            $product->subcategory()->sync(json_decode($request->input('subcategory_id')));
        }
        if ($request->has('brand_id')){
            $brand_id=$request->input('brand_id');
            $product->brand()->associate($brand_id);
          
        }
         if ($request->hasFile('media1')) {
        $media1 = $request->file('media1')->store('images', 'public');
        $product->media1 = $media1;
    }

        if ($request->has('tag_id')){
            $product->tags()->sync(json_decode($request->input('tag_id')));
        }
        if ($request->has('collection_id')){
            $product->collections()->sync(json_decode($request->input('collection_id')));
        }

        $product->save();

        return response()->json([
            'message'=>$product
        ]);
    }

    public function getAllProduct(Request $request){
        $product= Product::all();
        return response()->json([
            'message'=>$product
        ]);
    }

    public function deleteProduct(Request $request, $id){
        $product= Product::find($id);
        $product->delete();
        return response()->json([
            'message'=>$product
        ]);
    }


    public function getlatestProducts(Request $request){
    $products = Product::take(10)->orderBy('id', 'desc')->get(); 
    return response()->json([
        'message' => $products
    ]);
}


















  
}
