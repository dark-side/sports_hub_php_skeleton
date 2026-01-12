<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::select('id', 'name', 'email', 'created_at', 'updated_at')->get();
        
        return response()->json($users);
    }

    public function show(int $id): JsonResponse
    {
        $user = User::select('id', 'name', 'email', 'created_at', 'updated_at')->find($id);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        
        return response()->json($user);
    }
}
