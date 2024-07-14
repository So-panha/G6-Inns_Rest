<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    CreateBranchController,
    ProfileController,
    MailSettingController,
    GuestHousesController,
    PaymentController,
    TransactionController
};

// Social Login with google
use App\Http\Controllers\Auth\LoginController;
use App\Http\Livewire\Chat\Chat;
use App\Http\Livewire\Chat\Index;
use App\Http\Livewire\Users;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


// Route::get('/test-mail',function(){

//     $message = "Testing mail";

//     \Mail::raw('Hi, welcome!', function ($message) {
//       $message->to('ajayydavex@gmail.com')
//         ->subject('Testing mail');
//     });

//     dd('sent');

// });


// Route::get('/dashboard', function () {
//     return view('front.dashboard');
// })->middleware(['front'])->name('dashboard');


require __DIR__ . '/front_auth.php';

// Admin routes
Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('admin.dashboard');

require __DIR__ . '/auth.php';

Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')
    ->group(function () {
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('users', 'UserController');
        Route::resource('posts', 'PostController');
        Route::resource('branchs', 'CreateBranchController');
        Route::resource('dashboard-room', 'DashboardRoomController');
        Route::resource('check-booking', 'CheckBookingController');
        Route::resource('history', 'HistoryController');
        Route::resource('checking-room', 'CheckingRoomController');
        Route::resource('guest-houses', 'GuestHousesController');
        Route::resource('rooms', 'RoomController');

        Route::post('shops/media', 'GuestHousesController@storeMedia')->name('guestHouses.storeMedia');
        Route::post('rooms/media', 'RoomController@storeMedia')->name('rooms.storeMedia');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/mail', [MailSettingController::class, 'index'])->name('mail.index');
        Route::put('/mail-update/{mailsetting}', [MailSettingController::class, 'update'])->name('mail.update');

        // Route Payment(http://127.0.0.1:8000/admin/payment)
        Route::get('/payment', [PaymentController::class, 'showPaymentForm']);
        // Route::post('/payment', 'PaymentController@createStripePaymentIntent')->name('stripe.paymentIntent.create');
        Route::post('/process-payment',[PaymentController::class,'createStripePaymentIntent'])->name('stripe.paymentIntent.create');
        Route::post('/paid-guestHouse',[PaymentController::class,'paid'])->name('paid.guestHouse');
        Route::post('/update-real-time-guestHouse',[PaymentController::class, 'update'])->name('update-time-guestHouse');

        // Table Payment
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    });


Route::middleware('auth')->group(function () {

Route::middleware('auth')->group(function (){
    Route::get('/chat/{query}',Chat::class)->name('chat');

    Route::get('/users',Users::class)->name('users');

    Route::get('/users',Users::class)->name('users');

    Route::get('/chat',Index::class)->name('chat.index');
});


Route::namespace('App\Http\Controllers\Auth')->name('auth.')->prefix('auth')
    ->group(function () {
        Route::resource('register', 'RegisteredUserController');
    });
});

// Route::post('/emails-sendings', )

// Social Login with google
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'redirectToGoogleCallback']);
;
