<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Factory as Auth;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
   // Register API - POST (name, email, password)
    public function register(Request $request)
{
    // Validation
    $request->validate([
        "nom" => "required|string",
        "prenom" => "required|string",
        "tel" => "required|string",
        "adresse" => "required|string",
        "email" => "required|string|email|unique:users",
        "password" => "required|confirmed" // password_confirmation
    ]);

    // Création de l'utilisateur
    $user = User::create([
        "nom" => $request->nom,
        "prenom" => $request->prenom,
        "tel" => $request->tel,
        "adresse" => $request->adresse,
        "email" => $request->email,
        "password" => bcrypt($request->password)
    ]);

    // 🎯 Assignation du rôle "owner"
    $user->assignRole('owner');

    return response()->json([
        "status" => true,
        "message" => "User registered successfully with role 'owner'",
        
    ]);
}


    // Login API - POST (email, password)
    public function login(Request $request){

        // Validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $token = auth()->attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if(!$token){

            return response()->json([
                "status" => false,
                "message" => "Invalid login details"
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "User logged in succcessfully",
            "token" => $token,
            //"expires_in" => auth()->factory()->getTTL() * 60
        ]);

    }

    // Profile API - GET (JWT Auth Token)
    public function profile(){

        //$userData = auth()->user();
        $userData = request()->user();

        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userData,
            //"user_id" => request()->user()->id,
            //"email" => request()->user()->email
        ]);
    }

    // Refresh Token API - GET (JWT Auth Token)
    public function refreshToken(){

        $token = auth()->refresh();

        return response()->json([
            "status" => true,
            "message" => "New access token",
            "token" => $token,
            //"expires_in" => auth()->factory()->getTTL() * 60
        ]);
    }

    // Logout API - GET (JWT Auth Token)
    public function logout(){

        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => "User logged out successfully"
        ]);
    }
}
