<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Hello, Admin!']);
    }

    public function create(Request $request)
    {
        $this->authorizeAdmin();

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'address' => 'required|string',
            'phone_number' => 'required|numeric',
        ]);

        User::create([
            'uuid' => (string) Str::uuid(),
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'is_admin' => true,
            'address' => $validatedData['address'],
            'phone_number' => $validatedData['phone_number'],
        ]);

        return response()->json(['message' => 'Admin account created successfully'], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth()->user();

        if (!$user->is_admin) {
            auth()->logout();
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    private function authorizeAdmin()
    {
        if (!auth()->user() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
