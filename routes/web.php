<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\MemberTypeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Member\MemberController;

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
    return view('auth/login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/membership/payment', [GuestController::class, 'membership'])->name('membership.pay');
    Route::patch('/change/membership', [GuestController::class, 'changeMembership'])->name('change.membership');

    Route::get('/pay-member/callback', [GuestController::class, 'handleGatewayCallback']);
    Route::post('/pay-membership', [GuestController::class, 'redirectToGateway'])->name('pay.membership');
    Route::get('reciept', [GuestController::class, 'reciept'])->name('reciept');

    Route::get('/add-biodata', [MemberController::class, 'biodata'])->name('index.biodata');
    Route::post('/create-profile', [MemberController::class,'createProfile'])->name('create.profile');
    Route::get('/api/get-lgas/{state_id}', [MemberController::class,'getLgas']);


    Route::get('/payment/callback', [MemberController::class, 'handleGatewayCallback']);
    Route::post('/pay', [MemberController::class, 'redirectToGateway'])->name('pay');


    Route::controller(PaymentController::class)->group(function () {
        Route::get('/receipt/{id}', 'receipt')->name('receipt.view');
    });
    Route::resource('/member_types', MemberTypeController::class);
    Route::resource('/settings', SettingsController::class);

});



Route::middleware(['auth','membership','verify.profile'])->group(function () {

    Route::middleware(['role.dashboard'])->group(function () {
            Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboards');
            Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('dashboards');
        });

    Route::get('/profile', [AdminController::class, 'profile'])->name('profile.index');
    Route::patch('/change-password', [AdminController::class, 'changePassword'])->name('change.password');
    Route::patch('upload/avatar', [MemberController::class, 'uploadAvatar'])->name('upload.avatar');


    Route::controller(AdminController::class)->group(function () {

        Route::get('upcoming-events', 'event')->name('event.index');
        Route::get('past-events', 'pastEvent')->name('past.events');
    });


    Route::controller(AdminController::class)->prefix('admin')->group(function () {
        Route::middleware(['role:admin'])->group(function () {

            Route::get('reminder','reminder')->name('reminder');

            Route::get('payments', 'payment')->name('payments.index');
            Route::get('members', 'users')->name('user.list');
            Route::delete('delete-member', 'deleteUser')->name('delete.members');

            Route::post('/event/notify','sendNotification')->name('event.notify');

            Route::get('/event-payment/{id}', 'eventPaymentList')->name('event.pay-list');
            Route::post('evnet/add','createEvent')->name('create.event');

            Route::get('event-edit/{id}','edit')->name('edit.event');
            Route::put('update-event/{id}','updateEvent')->name('update.event');

            Route::get('/roles','role')->name('role');
            Route::post('/role/add', 'createRole')->name('create.role');

            Route::get('/permissions','permissions')->name('permission');
            Route::post('/permission/add', 'createPermission')->name('create.permission');
            Route::post('/assign/permission', 'assignPermission')->name('assign.permission');
            Route::post('/assign/role', 'assignRoleToUser')->name('assign.role');
        });
    });

    Route::controller(MemberController::class)->prefix('member')->group(function () {
        Route::post('/make-payment', 'storePayment')->name('make.payment');
        Route::patch('/update-profile', 'updateProfile')->name('update.profile');
        // Route::get('/biodata/{id}', 'findProfile')->name('find.profile');
        // Route::delete('/delete-biodata', 'deleteProfile')->name('delete.profile');
    });
    Route::get('show/user/{id}', [MemberController::class,'show'])->name('user.show');

});


Route::get('test', function () {
    return view('/nhs/page');
});

require __DIR__.'/auth.php';



// Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
