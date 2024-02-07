<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\UsersController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Login
Route::post('/login', [UsersController::class, 'login'])->middleware('guest');
Route::get('/user/{user}', [AlbumsController::class, 'profile']);

// Signup
Route::post('/signup', [UsersController::class, 'signup'])->middleware('guest');

// Reset_password
Route::post('/reset_password', [ResetPasswordController::class, 'reset_password'])->middleware('guest');

// Change_password
Route::post('/change_password', [ChangePasswordController::class, 'change_password'])->middleware('guest');

