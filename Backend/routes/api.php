<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Api\CommentFeedbackApiController;
use App\Http\Controllers\api\GetTiketController;
use App\Http\Controllers\API\GuestHouseApiController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\api\QRCodeController;
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
Route::get('/Guest_House/show/{id}', [GuestHouseApiController::class, 'show'])->name('show_guest_house');
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
Route::post('/booking_user_rooms/search', [BookingUserRoomAPIController::class, 'search'])->name('booking_user_rooms.search');
Route::get('/booking_user_rooms/available-rooms', [BookingUserRoomAPIController::class, 'getNumberRooms'])->name('booking_user_rooms.Number_Room');
Route::get('/booking_user_rooms/views', [BookingUserRoomAPIController::class, 'getAllUser'])->name('booking_user_rooms.view');

// Get a specific booking user room
Route::get('/booking_user_rooms/{id}', [BookingUserRoomAPIController::class, 'show'])->name('booking_user_rooms.show');

// Update a specific booking user room
Route::put('/booking_user_rooms/{id}', [BookingUserRoomAPIController::class, 'update'])->name('booking_user_rooms.update');

// Delete a specific booking user room
Route::delete('/booking_user_rooms/{id}', [BookingUserRoomAPIController::class, 'destroy'])->name('booking_user_rooms.delete');
Route::get('/guest_house/show/{id}', [GuestHouseApiController::class, 'show'])->name('guest_house.id');
Route::get('/guest_house/show/{id}', [GuestHouseApiController::class, 'show'])->name('rooms');

 //-------------Comment-Feedback-Routes----------------------------------------

// Route::get('commentOther/{guestHouseId}', [CommentFeedbackApiController::class, 'getCommentsByGuestHouse'])->name('commentOther');

// Route::get('/comments/{id}', [CommentFeedbackApiController::class, 'getCommentsForGuestHouse'])->name('comments');
Route::put('/updateComment/{id}', [CommentFeedbackApiController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/deleteComment/{id}', [CommentFeedbackApiController::class, 'destroy'])->name('deleteComment');
Route::post('/commentGuestHouse', [CommentFeedbackApiController::class, 'commentGuestHouse'])->middleware('auth:sanctum');
Route::get('/commentOther', [CommentFeedbackApiController::class, 'index'])->name('commentOther');

Route::get('/comment/show/{id}', [CommentFeedbackApiController::class, 'showComments'])->name('showComments');

// -----------------route add like-------------------------------
Route::post('/addLike', [RoomAPIController::class, 'addLike']);
Route::delete('/guesthouse/delete/{id}', [RoomAPIController::class, 'removeLikes']);

Route::get('/QR-code/show/{id}', [QRCodeController::class,'show'])->name('showQRCode');
Route::get('/like/{id}', [GuestHouseApiController::class, 'getlikeRoomFromGuesthouses']);
Route::get('/isLike/{id}', [GuestHouseApiController::class, 'getLikeUser']);

Route::get('/tickets/{id}', [GetTiketController::class, 'ticketList'])->name('ticketList');
Route::delete('/cancel-ticket/{id}', [GetTiketController::class, 'cancelTicket'])->name('cancelTicket');
