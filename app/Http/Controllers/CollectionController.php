<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;

class CollectionController extends Controller
{
    public function addCollection(Request $request){
        $collection= new Collection;
        $collectionName=$request->input('collectionName');
        $collectionVisible=$request->input('collectionVisible');
         if ($request->hasFile('collectionImage')) {
            $collectionImage = $request->file('collectionImage')->store('images', 'public');
            } else {
            $collectionImage = null; 
            }
            $collection->collectionImage=$collectionImage;
        $collection->collectionName=$collectionName;
        $collection->collectionVisible=$collectionVisible;
        $collection->save();
        return response()->json([
            'message'=>$request->all()
        ]);
    }

    public function getcollection(Request $request, $id){
        $collection= Collection::find($id);
        return response()->json([
            'message'=>$collection
        ]);
    }

    public function editCollection(Request $request, $id){
        $collection= Collection::find($id);
        $inputs=$request->except('_method', 'media1');
        $collection->update($inputs);

         if ($request->hasFile('collectionImage')) {
        $collectionImage = $request->file('collectionImage')->store('images', 'public');
        $collection->collectionImage = $collectionImage;
    }
    $collection->save();


        return response()->json([
            'message'=>$collection
        ]);
    }


    public function getAllCollection(Request $request){
        $collection= Collection::all();
        return response()->json([
            'message'=>$collection
        ]);
    }

    public function deleteCollection(Request $request, $id){
        $collection= Collection::find($id);
        $collection->delete();
        return response()->json([
            'message'=>$collection
        ]);
    }
}
