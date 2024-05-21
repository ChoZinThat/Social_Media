<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //user login
    public function loginUser(Request $request){
        $userData = User::where('email',$request->email)->first();

        if(isset($userData)){
            if(Hash::check($request->password, $userData->password)){
                $data = [
                    'user' => $userData,
                    'token' => $userData->createToken(time())->plainTextToken
                ];
                return response()->json($data);
            }
            else{
                return response()->json([
                    'user'=> null,
                    'token' => null,
                ]);
            }
        }
        else{
            return response()->json([
                'user'=> null,
                'token' => null,
                'message'=>'Email no match']);
        }
    }

    //register user
    public function registerUser(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        User::create($data);

        $user = User::where('email',$request->email)->first();

        return response()->json([
            'user' => $user,
            'token' => $user->createToken(time())->plainTextToken
        ]);

    }

    //get category
    public function getCategory(){
        $categories = Category::get() ;
        return response()->json($categories);
    }
}
