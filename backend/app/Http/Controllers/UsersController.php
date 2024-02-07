<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{
    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Retrieve credentials from the request
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (!Auth::attempt($credentials)) {

            // If authentication fails, return an error response
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        //  else {
        //     return response()->json([
        //         'message' => 'authorized'
        //     ]);
        // }

        $user = $request->user();

        // Return a response indicating successful authentication
        return response()->json([
            'message' => 'Authenticated',
            'user' => $user,
        ]);

        // Retrieve the authenticated user
        // $user = $request->user();

        // // Generate a token for the authenticated user
        // $tokenResult = $user->createToken('Personal Access Token');

        // // Retrieve the generated token
        // $accessToken = $tokenResult->accessToken;

        // // Determine token expiration based on the 'remember_me' option
        // $expiresAt = $request->remember_me ?
        //     Carbon::now()->addWeeks(1) : // Token expires in one week if 'remember_me' is true
        //     $tokenResult->token->expires_at; // Otherwise, use the default expiration time

        // // Save the token
        // $tokenResult->token->save();

        // // Return a response with the access token, token type, expiration time, and user ID
        // return response()->json([
        //     'access_token' => $accessToken,
        //     'token_type' => 'Bearer',
        //     'expires_at' => Carbon::parse($expiresAt)->toDateTimeString(),
        //     'user_id' => $user->id,
        // ]);
    }




    public function signup(Request $request)
    {

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'digits_between:10,15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'bio' => ['required', 'string'],
            'profile_picture' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // If validation fails, return the error response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create a new user record
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'bio' => $request->bio,
            'profile_picture' => $request->profile_picture,
            'password' => Hash::make($request->password),
        ]);

        // Return a success response
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }
}

