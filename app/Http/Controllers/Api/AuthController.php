<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        try {
            $data = $request->validated();
            $user = User::create($data);
            $token = $user->createToken('API Token')->plainTextToken;

            return ApiResponse::sendResponse([
                'user' => $user,
                'token' => $token,
            ], 'User registered successfully.', 201);

        } catch (\Exception $e) {
            return ApiResponse::sendResponse([], "Registration failed. Please try again. " . $e->getMessage(), 500);
        }
    }

    public function login(LoginUserRequest $request)
    {
        try {

            $data = $request->validated();

            if (!auth()->attempt($data)) {
                return ApiResponse::sendResponse([], 'You have entered invalid credentials', 401);
            }

            return ApiResponse::sendResponse([
                'user' => auth()->user(),
                'token' => auth()->user()->createToken('API Token')->plainTextToken
            ], 'User login successfully.');

        } catch (\Exception $e) {
            return ApiResponse::sendResponse([], "Login failed. Please try again. " . $e->getMessage(), 500);
        }
    }

    public function logout()
    {
        try {
            if (!auth()->check()) {
                return ApiResponse::sendResponse([],'No authenticated user found.', 401);
            }

            auth()->user()->tokens()->delete();

            return ApiResponse::sendResponse([], 'User logged out successfully.');

        } catch (\Exception $e) {
            return ApiResponse::sendResponse([],"Logout failed. Please try again. " . $e->getMessage(), 500);
        }
    }
}
