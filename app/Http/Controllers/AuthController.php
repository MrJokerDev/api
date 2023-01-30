<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $userRequest)
    {
        $user = User::create($userRequest->all());
        
        return response()->json([
            'status' => true,
            'message' => 'User success registered',
            'token' => $user->createToken("API TOKEN")->plainTextToken,
            'data' => $user,
        ],200);
    }

    public function login(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => 'User Logged in success.',
                'errors' => $validate->errors()
            ],401);
        }

        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match with our record.'
            ],401);
        }


        $user = User::where([
            'email' => $request->email,
            'password' => $request->password
        ])->first();
        
        return response()->json([
            'status' => true,
            'message' => 'User Logged in success.',
            'token' => $user->createToken("API TOKEN")->plainTextToken,
            'data' => $user,
        ],200);
    }
}