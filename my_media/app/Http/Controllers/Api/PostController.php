<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //get post data
    public function getPostData(){
        $posts = Post::get();
        return response()->json([
            'post' => $posts,
            'status' => "success"
        ]);
    }

    //search post
    public function searchPost(Request $request){
        $result = Post::where('title', 'LIKE', '%'.$request->key.'%')->get();
        return response()->json([
            'searchData' => $result
        ]);
    }

    //post details
    public function postDetails(Request $request){
        $postDetails = Post::where('post_id',$request->post_id)->first();

        return response()->json([
            'result' => $postDetails
        ]);
    }
}
