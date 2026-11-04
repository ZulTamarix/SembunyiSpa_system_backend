<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\RosterController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobileController;

// public
    Route::apiResource('login', AuthController::class);
    Route::get('/mobile/banner', [MobileController::class, 'getBanner']); // get banner
    Route::get('/mobile/treatment', [MobileController::class, 'getTreatment']); // get treatment list
    Route::post('/mobile/customer', [MobileController::class, 'createUser']); // create user for customer
    
// protected
    Route::middleware('auth:sanctum')->group(function () {

        // authentication
        Route::post('/logout', [AuthController::class, 'logout']);

        // normal
        Route::apiResource('room', RoomController::class);
        Route::apiResource('user', UserController::class);
        Route::apiResource('membership', MembershipController::class);
        Route::apiResource('roster', RosterController::class);
        Route::apiResource('voucher', VoucherController::class);
        Route::apiResource('booking', BookingController::class);
        Route::apiResource('notification', NotificationController::class);
        Route::apiResource('banner', BannerController::class);
        Route::apiResource('package', PackageController::class);
        Route::get('/available/therapist', [BookingController::class, 'getTherapist']); // get total booking


        #region -> for 'mobile'
            Route::get('/mobile/availability/date', [MobileController::class, 'getAvailability_date']); // get availability (date only)
            Route::get('/mobile/availability/dateTime', [MobileController::class, 'getAvailability_dateTime']); // get availability (date + time)
            Route::get('/mobile/membership/{membership_id}', [MobileController::class, 'getMembership']); // get membership for customer
            Route::get('/mobile/voucher/{user_id}', [MobileController::class, 'getVoucher']); // get voucher for customer
            Route::get('/mobile/booking/{user_id}', [MobileController::class, 'getBooking']); // get booking for customer
            
            Route::post('/mobile/booking', [MobileController::class, 'createBooking']); // create booking for customer
            
            Route::put('/mobile/customer/{id}', [MobileController::class, 'updateUser']); // create user for customer
        #endregion
    });
