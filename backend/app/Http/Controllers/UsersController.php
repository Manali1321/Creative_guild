<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Mail\SignUpMail;


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
        $user = Auth::user();
        $token = $user->createToken('MyApp')->accessToken;
        $user->tokens()->save($token);
        return response()->json(['token' => $token, 'user' => $user,], 200);
    }


    /**
     * Get the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(Auth::user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
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

        Mail::to($user->email)->send(new SignUpMail($user));

        // Return a success response
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }
}

