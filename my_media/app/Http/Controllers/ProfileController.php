<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class ProfileController extends Controller
{
    //direct profile
    public function index() {
        $id = Auth::user()->id;
        $user = User::where('id',$id)->select('name','email','phone','address','gender')->first();
        return view('admin.profile.index',compact('user'));
    }

    //admin account update
    public function adminAccountUpdate(Request $request){
        $adminData = $this->adminDataValidate($request);
        $updateData = $this->getUserData($request);

        User::where('id',Auth::user()->id)->update($updateData);
        return back()->with(['updated'=>"Admin's account updated successfully!"]);
    }

    //admin password change page
    public function adminPW_change(){
        return view('admin.profile.changePW');
    }

    //admin change password
    public function changePassword(Request $request){

        $this->passwordValidation($request);
        $data = User::where('id',Auth::user()->id)->first();
        $oldPassword = $data->password;

        if(!Hash::check($request->oldPassword, $oldPassword)){
            return back()->with(['fail'=>"Old Password doesn't match!"]);
        }

        $userInfo = User::find(Auth::user()->id);
        $userInfo->password = Hash::make($request->newPassword);
        $userInfo->save();
        $user = $userInfo;

        return view('admin.profile.index',compact('user'));

    }

    //get data for admin update
    private function getUserData($request){
        return  [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'phone' => $request->adminPhone,
            'address' => $request->adminAddress,
            'gender' => $request->adminGender,
            'updated_at' => Carbon::now(),
        ];
    }

    //admin data validation
    private function adminDataValidate($request){
        Validator::make($request->all(),[
            "adminName" => "required",
            "adminEmail" => "required",
        ])->validate();
    }

    //password change validation
    private function passwordValidation($request){
        Validator::make($request->all(),[
            "oldPassword" => "required",
            "newPassword" => "required|min:6|max:15",
            "confirmPassword" => "required|same:newPassword"
        ],[
            "confirmPassword.same" => "Confirm Password must be the same with the new password!"
        ])->validate();
    }

}
