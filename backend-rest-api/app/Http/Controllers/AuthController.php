<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function doRegister(Request $request)
    {
        $name = $request->input("name");
        $password = $request->input("password");

        if(empty($name) ||empty($password) ) {
            return response()->json([
                "status" =>  401,
                "message" => "Input nama dan password tidak boleh kosong"
            ], 401);
        }

        $user = $request->validate([
            "name" => "required",
            "password" => "required",
            "token"
        ]);

        $user["token"] = Str::random(30);
        $user["password"] = Hash::make($user["password"]);

        $users = User::create($user);

        if(!$users) {
            return response()->json([
                "status" =>  401,
                "message" => "Input nama dan password tidak boleh kosong"
            ], 401);
        } else {
            return response()->json([
                "status" =>  200,
                "message" => "Berhasil Register",
                "data" =>  $users
            ], 200);
        }
    }

    public function doLogin(Request $request)
    {
        $name = $request->input("name");
        $password = $request->input("password");

        if(empty($name) ||empty($password) ) {
            return response()->json([
                "status" =>  401,
                "message" => "Input nama dan password tidak boleh kosong"
            ], 401);
        }

        $isExist = User::where("name", $name)->first();

        if($isExist) {
            if(Hash::check($password, $isExist->password)) {
                // Auth::attempt($isExist);
                // $request->session()->regenerate();
                
                $isExist->update([
                    "token" => Str::random(30)
                ]);

                return response()->json([
                    "status" => 200,
                    "message" => "berhasil login",
                    "data" => $isExist,
                ], 200);
            } else {
                return response()->json([
                    "status" => 401,
                    "message" => "name atau password salah"
                ], 401);
            }
        } else {
            return response()->json([
                "status" => 401,
                "message" => "name atau password salah"
            ], 401);
        }
    }
}
