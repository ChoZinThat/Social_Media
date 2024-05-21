<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //get category data
    public function getCategory(){
        $category = Category::select('category_id','title','description')->get();

        return response()->json([
            'category' => $category
        ]);
    }

    //search category
    public function searchCategory(Request $request){
        if($request->id ==""){
            $posts = Post::get();
        }else{
            $posts = Post::where('category_id',$request->id)->get();
        }

        return response()->json([
            'posts' => $posts
        ]);
    }
}
