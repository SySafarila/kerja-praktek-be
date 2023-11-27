<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
|--------------------------------------------------------------------------
| Token abilities middleware
|--------------------------------------------------------------------------
|
| - abilities : Token has both "permission-1" and "permission-2" abilities
| - ability : Token has the "permission-1" or "permission-2" ability
|
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('/user', [AuthController::class, 'user'])->name('api.user');

    Route::post('/register', [AuthController::class, 'register'])->name('api.register');
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::post('/refresh-token', [AuthController::class, 'refresh_token'])->name('api.refresh_token');
});
