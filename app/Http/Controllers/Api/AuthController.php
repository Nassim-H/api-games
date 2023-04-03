<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register','logout']]);
    }

    public function register(Request $request) {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'pseudo' => 'required|string|max:255',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'pseudo' => $request->pseudo,
            'valide' => 1,
            'avatar' => 'cc'
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'Adherent created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            "message" => "Adherent logged successfully",
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout() {
        echo(7);
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function me() {
        return response()->json([
            'status' => 'sucess',
            'adhérent' => Auth::user(),
        ]);
    }
}
