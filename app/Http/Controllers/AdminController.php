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
}
