<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    //
    public function reset_password(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email'
        ]);

        // Send the password reset email
        $response = Password::sendResetLink($request->only('email'));

        // Check the response and redirect accordingly
        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', trans($response))
            : back()->withErrors(['email' => trans($response)]);
    }

    public function broker()
    {
        return Password::broker();
    }

}
