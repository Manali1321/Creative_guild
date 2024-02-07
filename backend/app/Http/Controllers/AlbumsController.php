<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    //
    public function profile(User $user): JsonResponse
    {
        // Eager load the albums relationship
        $user->load('albums');

        // Return the user's profile along with their albums
        return response()->json(['user' => $user]);
    }
}
