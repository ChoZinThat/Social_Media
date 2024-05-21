<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    //direct post page
    public function index(){
        $category = Category::get();
        $posts = Post::get();
        return view('admin.post.index',compact('category','posts'));
    }

    //create post
    public function create(Request $request){
       $this->validateData($request);

        if(empty($request->image)){
            $imageName = NULL;
        }else{
            $file = $request->file('image');
            $imageName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$imageName);
        }

        $data = $this->getPostData($request,$imageName);
        Post::create($data);

        return redirect()->route('admin#post')->with(['success'=>'Your Post created Successfully!']);
    }

    //delete post
    public function deletePost($id){
        $data = Post::where('post_id',$id)->first();
        $imageName = $data->image;

        if(File::exists(public_path().'/postImage/'.$imageName)){
            File::delete(public_path().'/postImage/'.$imageName);
        }

        Post::where('post_id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Your Post deleted Successfully!']);
    }

    //edit post page
    public function editPostPage($id){
        $category = Category::get();
        $posts = Post::get();
        $post = Post::where('post_id',$id)->first();
        return view('admin.post.edit',compact('category','posts','post'));
    }

    //edit post
    public function editPost($id,Request $request){

        $this->validateData($request);
        $updateData = $this->updateData($request);

        if(isset($request->image)){
            //name image
            $image = $request->file('image');
            $imageName = uniqid().'_'.$image->getClientOriginalName();

            //check and delete original image
            $db = Post::where('post_id',$id)->first();
            $dbImage = $db->image;
            if(File::exists(public_path().'/postImage/'.$dbImage)){
                File::delete(public_path().'/postImage/'.$dbImage);
            }

            //store image in public
            $image->move(public_path().'/postImage/',$imageName);

            //add new image to update data
            $updateData['image'] = $imageName;
        }

        Post::where('post_id',$id)->update($updateData);
        return redirect()->route('admin#post');
    }

    //updata data get
    private function updateData($request){
        return [
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category
        ];
    }

    //validate for create
    private function validateData($request){
        return Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'category' => 'required'
        ])->validate();
    }

    //get post  data
    private function getPostData($request,$imageName){
        return [
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category,
            'image' => $imageName
        ];
    }
}
