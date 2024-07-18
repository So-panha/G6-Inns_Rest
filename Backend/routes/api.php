<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Api\CommentFeedbackApiController;
use App\Http\Controllers\API\GuestHouseApiController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController as APIUserController;
use App\Http\Controllers\API\RoomAPIController;
use App\Http\Controllers\API\BookingUserRoomAPIController;
use App\Http\Controllers\API\UserNormalController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
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

Route::post('/register', [RegisteredUserController::class, 'registerUser']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::get('/post/list', [PostController::class, 'index'])->middleware('auth:sanctum');


Route::get('/Guest_House', [GuestHouseApiController::class, 'index'])->name('guest_house');
// Route::get('/Show_Guest_House/{id}', [GuestHouseApiController::class, 'showCommentFeedback'])->name('show_guest_house');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');


// -------------Route-UserNormal----------------------------------
Route::get('/user/list', [UserNormalController::class, 'index'])->name('user.list');
Route::post('/user/create', [UserNormalController::class, 'store'])->name('user.create');
Route::get('/user/show/{id}', [UserNormalController::class, 'show'])->name('user.show');
Route::put('/user/update/{id}', [UserNormalController::class, 'update'])->name('user.update');
Route::delete('/user/delete/{id}', [UserNormalController::class, 'destroy'])->name('user.delete');

Route::get('/guest_house/list', [GuestHouseApiController::class, 'index'])->name('guest_house');
Route::get('/room/list', [RoomAPIController::class, 'index'])->name('rooms');





// Create a new booking user room
Route::post('/booking_user_rooms/create', [BookingUserRoomAPIController::class, 'create'])->name('booking_user_rooms.create');

// Get a specific booking user room
Route::get('/booking_user_rooms/{id}', [BookingUserRoomAPIController::class, 'show'])->name('booking_user_rooms.show');

// Update a specific booking user room
Route::put('/booking_user_rooms/{id}', [BookingUserRoomAPIController::class, 'update'])->name('booking_user_rooms.update');

// Delete a specific booking user room
Route::delete('/booking_user_rooms/{id}', [BookingUserRoomAPIController::class, 'destroy'])->name('booking_user_rooms.delete');
Route::get('/guest_house/show/{id}', [GuestHouseApiController::class, 'show'])->name('guest_house.id');
Route::get('/guest_house/show/{id}', [GuestHouseApiController::class, 'show'])->name('rooms');

 //-------------Comment-Feedback-Routes----------------------------------------
 Route::middleware('auth:sanctum')->group(function () {
Route::post('/commentGuestHouse', [CommentFeedbackApiController::class, 'commentGuestHouse']);
Route::put('/updateComment/{id}', [CommentFeedbackApiController::class, 'update']);
Route::delete('/deleteComment/{id}', [CommentFeedbackApiController::class, 'destroy']);

});
// Route::post('/commentGuestHouse', [CommentFeedbackApiController::class, 'commentGuestHouse'])->name('commentGuestHouse');
Route::get('/commentOther', [CommentFeedbackApiController::class, 'index'])->name('commentOther');
// Route::get('/commentOther', [CommentFeedbackApiController::class, 'index'])->name('commentOther');
// -----------------route add like-------------------------------

Route::post('/add-like', [GuestHouseApiController::class, 'addLike'])->name('addLike');
