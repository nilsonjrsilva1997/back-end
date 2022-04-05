<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            "nickname" => "required|string|max:255|min:3",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed|min:8",
        ]);

        $validatedData['password'] = bcrypt($request->password);
        $user = User::create($validatedData);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            "email" => "required|email",
            "password" => "required|string",
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Dados inválidos'], 422);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
}
