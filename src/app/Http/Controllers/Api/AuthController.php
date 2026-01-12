<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\UserSignupRequest;
use App\Http\Requests\UserUpdateRequest;

class AuthController extends Controller
{
    /**
     * User registration
     * POST /users/registrations
     */
    public function signup(UserSignupRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'] ?? '',
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ]);

        // Return user without token for registration (as per spec)
        return response()->json([
            'id' => $user->id,
            'email' => $user->email,
        ], 201);
    }

    /**
     * User sign in
     * POST /api/auth/sign_in
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            $user = auth('api')->user();
            
            return response()->json([
                'id' => $user->id,
                'email' => $user->email,
                'authentication_token' => $token
            ]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }

    /**
     * Get current user profile
     * GET /api/users/profile
     */
    public function profile()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        $user = auth('api')->user();

        return response()->json(['user' => $user]);
    }

    /**
     * Update current user profile
     * PUT /api/users/profile
     */
    public function update(UserUpdateRequest $request)
    {
        $validatedData = $request->validated();
        $user = auth('api')->user();

        $user->update($validatedData);
        $user->save();

        // regenerate token because it's based on user's data
        $token = auth('api')->login($user);

        return $this->respondWithToken($token);
    }

    /**
     * Refresh token
     * GET /api/users/refresh
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token, $statusCode = 200)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ], $statusCode);
    }

    /**
     * Sign out
     * DELETE /api/auth/sign_out
     */
    public function logout(Request $request)
    {
        auth('api')->logout();

        return response()->json(['message' => 'Signed out successfully']);
    }

    /**
     * Delete current user
     * DELETE /api/users/profile
     */
    public function destroy(Request $request)
    {
        $user = auth('api')->user();

        auth('api')->logout();

        $user->delete();

        return response()->json(['message' => 'Successfully deleted user']);
    }
}
