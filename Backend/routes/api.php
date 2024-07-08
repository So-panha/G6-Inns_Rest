<?php

use App\Http\Controllers\API\GuestHouseApiController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\RoomAPIController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Front\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| APIRoutes
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

Route::post('/rigister',[AuthController::class, "registerUser"]);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::get('/post/list', [PostController::class, 'index'])->middleware('auth:sanctum');


Route::get('/guest_house/list', [GuestHouseApiController::class, 'index'])->name('guest_house');
Route::get('/guest_house/show/{id}', [GuestHouseApiController::class, 'show'])->name('rooms');
