<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (!$user = User::where('email', $request->email)->first()) {
            return response()->json(['errors' => 'User Not Found.'], 422);
        }
 
        if (!\Hash::check($request->password, $user->password)) {
            return response()->json(['errors' => 'The provided credentials are incorrect.'], 422);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token, 'message' =>'success']);
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token, 'message' =>'success']);
    }

    public function loggedOut(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' =>'success']);
    }
}
