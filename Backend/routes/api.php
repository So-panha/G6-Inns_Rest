<?php

use App\Http\Controllers\API\GuestHouseApiController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController as APIUserController;
use App\Http\Controllers\API\RoomAPIController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Front\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'registerUser']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::get('/post/list', [PostController::class, 'index'])->middleware('auth:sanctum');


Route::get('/Guest_House', [GuestHouseApiController::class, 'index'])->name('guest_house');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');


// -------------Route-UserNormal----------------------------------
Route::get('/user/list', [APIUserController::class, 'index'])->name('user.list');
Route::post('/user/create', [APIUserController::class, 'store'])->name('user.create');
Route::get('/user/show/{id}', [APIUserController::class, 'show'])->name('user.show');
Route::put('/user/update/{id}', [APIUserController::class, 'update'])->name('user.update');
Route::delete('/user/delete/{id}', [APIUserController::class, 'destroy'])->name('user.delete');
Route::get('/guest_house/list', [GuestHouseApiController::class, 'index'])->name('guest_house');
Route::get('/guest_house/show/{id}', [GuestHouseApiController::class, 'show'])->name('rooms');
