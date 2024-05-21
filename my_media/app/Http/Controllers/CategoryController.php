<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category page
    public function index(){
        $data = Category::get();
        return view('admin.category.index',compact('data'));
    }

    //category add
    public function categoryAdd(Request $request){
        $this->validateCategory($request);
        $add = $this->getData($request);
        Category::create($add);

        $data = Category::get();
        return view('admin.category.index',compact('data'));
    }

    //category delete
    public function categoryDelete($id){
        Category::where('category_id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Category Deleted Successfully']);
    }

    //seach category
    public function searchCategory(Request $request){
        $data = Category::where('title','LIKE','%'.$request->categorySearch.'%')->get();
        return view('admin.category.index',compact('data'));
    }

    //update page
    public function updatePage($id){
        $updateData = Category::where('category_id',$id)->first();
        $data = Category::get();
        return view('admin.category.update',compact('data','updateData'));
    }

    //update
    public function update($id,Request $request){
        $this->validateCategory($request);
        $data = $this->getUpdateData($request);
        Category::where('category_id',$id)->update($data);

        return redirect()->route('admin#category');
    }

    //validation category
    private function validateCategory($request){
        return Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required'
        ])->validate();
    }

    //get data for category add
    private function getData($request){
        return [
            'title' => $request->title,
            'description' => $request->description
        ];
    }

    //get data for category update
    private function getUpdateData($request){
        return [
            'title' => $request->title,
            'description' => $request->description,
            'updated_at' => Carbon::now(),
        ];
    }
}
