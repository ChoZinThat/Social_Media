<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //direct list page
    public function index(){
        $user = User::select('id','name','email','phone','address','gender')->get();
        return view('admin.list.index',compact('user'));
    }

    //delete admin
    public function deleteAdmin($id){
        User::where('id',$id)->delete();
        return back()->with(['success'=>'One Account deleted successfully!']);
    }

    //search admin
    public function searchAdmin(Request $request){
        $user = User::orWhere('name','LIKE','%'.$request->adminSearchKey.'%')
                ->orWhere('email','LIKE','%'.$request->adminSearchKey.'%')
                ->orWhere('phone','LIKE','%'.$request->adminSearchKey.'%')
                ->orWhere('address','LIKE','%'.$request->adminSearchKey.'%')
                ->orWhere('gender','LIKE','%'.$request->adminSearchKey.'%')
                ->get();
        return view('admin.list.index',compact('user'));
    }
}
