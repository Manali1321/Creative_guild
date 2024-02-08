<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function reset_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        // $token = Password::createToken($user);
        // Generate custom token format (2 letters + 3 numbers)
        $token = Str::random(2) . rand(100, 999) . Str::random(2);

        // Set expiry time for the token (24 hours from now)
        $expiresAt = now()->addHours(24);

        // Save the token and expiry time to the password reset tokens table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => now()]
        );

        // Send password reset email
        Mail::to($user->email)->send(new ResetPasswordMail($token));

        // Return success response
        return response()->json(['message' => 'Password reset email sent successfully'], 200);
    }

}

