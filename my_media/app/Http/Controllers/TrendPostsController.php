<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostsController extends Controller
{
    //direct trend post page
    public function index(){
        $post = ActionLog::select('action_logs.*','posts.*',DB::raw('COUNT(action_logs.post_id) as post_count'))
                ->leftJoin('posts','posts.post_id','action_logs.post_id')
                ->groupBy('action_logs.post_id')
                ->get();


        return view('admin.trendPosts.index',compact('post'));
    }
    //trend post details
    public function postDetails($id){
        $post = Post::where('post_id',$id)->first();
        return view('admin.trendPosts.details',compact('post'));
    }
}
