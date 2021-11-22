<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function user()
    {
        if(!$user = Auth::user()){
            return \response([
                'error' => 'Unauthorized Access',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $user;

    }

    public function register(Request $request)
    {
        $user = User::where('email', 'like', $request->input('email'))->first();

        if($user){
            return ['error' => 'User Already Exist'];
        }
        
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60 * 24); // 1 day

        return response([
            'token' => $token
        ])->withCookie($cookie);
    }

}
