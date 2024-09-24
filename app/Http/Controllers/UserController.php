<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            "email" => "required|email|unique:users,email",
            "username" => "required|unique:users,username",
            "password" => "required"
        ]);

        $user = User::create([
            "email" => $request->email,
            "username" => $request->username,
            "password" => $request->password,
            "name" => $request->username,
        ]);
        return response($user);
    }

    public function login(Request $request)
    {
        $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        $user = User::where("username", $request->username)->first();

        if (!$user) {
            abort(401);
        }
        Hash::check($request->password, $user->password);

        $token = $user->createToken('token', []);
        return response($token);
    }
}
