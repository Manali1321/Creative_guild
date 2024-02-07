<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $disk = 'profile';
    $filename = 'hero.jpg';
    $heroImage = $filename;

    Storage::disk($disk)->put($filename, $heroImage);

    return Storage::disk($disk)->url($filename);
});

// Define routes that require CORS headers within this group
Route::post('/login', [UsersController::class, 'login'])->middleware('guest');
Route::post('/signup', [UsersController::class, 'signup'])->middleware('guest');
Route::get('/user/{user}', [AlbumsController::class, 'profile'])->middleware('guest');


