<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Actions\Auth\RegisterUserAction;
use App\Actions\Auth\LoginUserAction;
use App\Actions\User\UpdateProfileAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterUserAction $action): JsonResponse
    {
        $token = $action->execute($request->validated());

        return response()->json([
            'user_token' => $token,
        ], 201);
    }

    public function login(LoginRequest $request, LoginUserAction $action): JsonResponse
    {
        $token = $action->execute($request->validated());

        return response()->json([
            'user_token' => $token,
        ], 200);
    }

    public function profile(Request $request): JsonResponse
    {
        return response()->json([
            'user' => new UserResource($request->user()),
        ], 200);
    }

    public function updateProfile(UpdateProfileRequest $request, UpdateProfileAction $action): JsonResponse {
        $action->execute($request->user(), $request->validated());

        return response()->json([
            'message' => 'data updated successfully',
        ], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'logout',
        ], 200);
    }
}
