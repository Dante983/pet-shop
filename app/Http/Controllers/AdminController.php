<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\JWTToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Services\JwtService;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $jwtService;

    public function __construct(JwtService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function index()
    {
        return response()->json(['message' => 'Hello, Admin!']);
    }

    public function create(Request $request)
    {
        // $this->authorizeAdmin($request->user);

        try {
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|string|same:password',
                'address' => 'required|string',
                'phone_number' => 'required|string|max:15',
                'avatar' => 'required|image|max:2048',
            ]);

            $user = new User([
                'uuid' => (string) Str::uuid(),
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'is_admin' => true,
                'address' => $validatedData['address'],
                'phone_number' => $validatedData['phone_number'],
            ]);

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $path = $file->store('avatars', 'public');

                $fileRecord = File::create([
                    'uuid' => (string) Str::uuid(),
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'type' => $file->getClientOriginalExtension(),
                    'mime_type' => $file->getMimeType(),
                ]);

                $user->avatar = $fileRecord->uuid;
            }

            $user->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

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

        $user->update(['last_login_at' => now()]);

        $jwt = $this->jwtService->createToken($user);

        return $this->respondWithToken($jwt);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        if ($token) {
            try {
                $jwt = $this->jwtService->parseToken($token);

                // Delete the token from the database
                $tokenId = $jwt->claims()->get('jti');
                JWTToken::where('unique_id', $tokenId)->delete();
            } catch (\Exception $e) {
                return response()->json(['error' => 'Invalid token'], 403);
            }
        }

        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    private function authorizeAdmin($user)
    {
        dd($user);
        if (!$user->is_admin) {
            abort(403, 'Unauthorized action.');
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3600
        ]);
    }
}
