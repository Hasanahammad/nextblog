<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => ['min:8', 'confirmed']
        ]);

        $user = User::create($validatedData);
        $token = $user->createToken("Token_for_Registration")->accessToken;

        return response()->json(
            [
                'token' => $token,
                'user'  =>$user,
                'messege'=>'User Created Successfull.',
                'status' => 1
            ]
            );
    }
}
