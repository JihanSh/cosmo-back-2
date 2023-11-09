<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
class TagController extends Controller
{
    public function addTag(Request $request){
        $tag= new Tag;
        $tagName=$request->input('tagName');
        $tag->tagName=$tagName;
        $tag->save();
        return response()->json([
            'message'=>$request->all()
        ]);
    }

    public function getTag(Request $request, $id){
        $tag= Tag::find($id);
        return response()->json([
            'message'=>$tag
        ]);
    }

    public function editTag(Request $request, $id){
        $tag= Tag::find($id);
        $inputs=$request->except('_method');
        $tag->update($inputs);

        return response()->json([
            'message'=>$tag
        ]);
    }

    public function getAllTag(Request $request){
        $tag= Tag::all();
        return response()->json([
            'message'=>$tag
        ]);
    }
    public function deleteTag(Request $request, $id){
        $tag= Tag::find($id);
        $tag->delete();
        return response()->json([
            'message'=>$tag
        ]);
    }




}
