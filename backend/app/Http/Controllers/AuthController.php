<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'bio' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            'profile_picture' => 'nullable|https://creativeguidbackend.s3.ca-central-1.amazonaws.com/profile/profile.jpeg', // Example validation for image upload
        ]);

        $user = new User();
        $user->name = $attributes['name'];
        $user->email = $attributes['email'];
        $user->phone = $attributes['phone'];
        $user->bio = $attributes['bio'];
        $user->password = $attributes['password'];
        $user->profile_picture = $attributes['profile_picture'];
        $user->save();

        return response()->json(['message' => 'User registered successfully'], 201);

        // Log::info('Request Data:', $request->all()); // Log request data

        // try {
        //     // Validate the request data
        //     $request->validate([
        //         'name' => 'required|string',
        //         'email' => 'required|email|unique:users',
        //         'phone' => 'required|string',
        //         'bio' => 'required|string',
        //         'password' => 'required|string|min:6|confirmed',
        //         'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for image upload
        //     ]);

        //     // Set default profile picture link
        //     $defaultProfilePicture = 'https://creativeguidbackend.s3.ca-central-1.amazonaws.com/profile/profile.jpeg';

        //     // Handle profile picture upload
        //     $profilePicturePath = $request->hasFile('profile_picture') ? $request->file('profile_picture')->store('profile_pictures') : $defaultProfilePicture;

        //     // Create and store the user
        //     $user = User::create([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'phone' => $request->phone,
        //         'bio' => $request->bio,
        //         'password' => Hash::make($request->password),
        //         'profile_picture' => $profilePicturePath,
        //     ]);

        //     // Optionally, you can return a response or redirect the user
        //     return response()->json(['message' => 'User registered successfully'], 201);
        // } catch (\Exception $e) {
        //     Log::error('Failed to register user: ' . $e->getMessage());
        //     return response()->json(['message' => 'Failed to register user. Please try again later.'], 500);
        // }
    }
}
