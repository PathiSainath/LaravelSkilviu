<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class User_masterController extends Controller
{
    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'username' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Attempt to find user with matching credentials
        $user = DB::table('_user_master')
            ->where('username', $request->username)
            ->where('password', $request->password) // ⚠️ Insecure! Use hashed passwords in production.
            ->first();

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'data' => [
                    'user_id' => $user->id,
                    'user_role' => $user->user_role,
                    'username' => $user->username,
                ],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid username or password',
            ], 401);
        }
    }
}
