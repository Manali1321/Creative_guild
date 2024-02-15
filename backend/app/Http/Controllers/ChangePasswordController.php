<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;


class ChangePasswordController extends Controller
{

    // Method for changing password after receiving token
    public function change_password(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Retrieve token from the password_reset_tokens table based on the user's email
        $tokenRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();


        // Ensure the token exists for the user's email
        if (!$tokenRecord) {
            return response()->json(['message' => 'Token not found'], 404);
        }

        // Check if the provided token matches the token from the password_reset_tokens table
        if ($tokenRecord->token !== $request->token) {
            return response()->json(['message' => 'Invalid token'], 400);
        }

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Ensure the user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Reset the user's password
        $user->password = bcrypt($request->password);
        $user->save();

        // Delete the token from the password_reset_tokens table after successful password reset
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return response()->json(['message' => 'Password reset successfully'], 200);
    }

}
