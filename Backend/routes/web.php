<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegisterToUser;

use App\Http\Controllers\Admin\{
    ApproveUserController,
    ProfileController,
    MailSettingController,
    GuestHousesController,
    PaymentController,
    TransactionController
};
// use App\Http\Controllers\Traits\MediaUploadingTrait;


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


// require DIR . '/front_auth.php';

// Admin routes
Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('admin.dashboard');

require __DIR__ . '/auth.php';

Route::
        namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')
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
        Route::resource('request-account-service', 'RequestAccountServiceController');
        Route::resource('approve-user', 'ApproveUserController');

        // Alert when user request account to the admin
        Route::get('/alert-booking', 'CheckBookingController@alertBooking')->name('alert.booking');
        Route::get('/alert-request', 'ApproveUserController@alertRequest')->name('alert.request');
        Route::post('guestHouses/media', 'GuestHousesController@storeMedia')->name('guestHouses.storeMedia');
        Route::post('edit/guestHouses/media', 'GuestHousesController@editStoreMedia')->name('guestHouses.storeMedia.edit');
        Route::post('rooms/media', 'RoomController@storeMedia')->name('rooms.storeMedia');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/mail', [MailSettingController::class, 'index'])->name('mail.index');
        Route::put('/mail-update/{mailsetting}', [MailSettingController::class, 'update'])->name('mail.update');
        Route::get('/payment', [PaymentController::class, 'showPaymentForm']);
        // Route::post('/payment', 'PaymentController@createStripePaymentIntent')->name('stripe.paymentIntent.create');
        Route::post('/process-payment', [PaymentController::class, 'createStripePaymentIntent'])->name('stripe.paymentIntent.create');
        Route::post('/paid-guestHouse', [PaymentController::class, 'paid'])->name('paid.guestHouse');
        Route::post('/update-real-time-guestHouse', [PaymentController::class, 'update'])->name('update.time.guestHouse');
        Route::post('/unactive-guest-house', [PaymentController::class, 'unactivate'])->name('unactive.guestHouse');

        // Table Payment
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

        // Approve user services
        Route::put('/approve-user', [ApproveUserController::class, 'approve'])->name('approve.user.service');
        Route::put('/reject-user', [ApproveUserController::class, 'reject'])->name('reject.user.service');

        // Route of dashboard admin
        Route::get('/get-total-users-service',[DashboardAdminController::class,'getTotalUsersService'])->name('all.users.service');
        Route::get('/get-total-users-normal',[DashboardAdminController::class,'getTotalUsersNormal'])->name('all.users.normal');
        Route::get('/get-total-profit',[DashboardAdminController::class,'getTotalProfit'])->name('all.total.profit');
    });


Route::middleware('auth')->group(function () {

    Route::middleware('auth')->group(function () {
        Route::get('/chat/{query}', Chat::class)->name('chat');

        Route::get('/users', Users::class)->name('users');

        Route::get('/users', Users::class)->name('users');

        Route::get('/chat', Index::class)->name('chat.index');
    });
});


Route::namespace('App\Http\Controllers\Auth')->name('auth.')->prefix('auth')
->group(function () {
    Route::resource('register', 'RegisteredUserController');
    Route::resource('register-account', 'RegisterUserServiceController');
});


// Route::post('/emails-sendings', )

// Social Login with google
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'redirectToGoogleCallback']);
;
