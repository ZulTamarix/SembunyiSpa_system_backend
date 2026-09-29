<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\RosterController;
use App\Http\Controllers\VoucherController;

Route::apiResource('room', RoomController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('package', PackageController::class);
Route::apiResource('membership', MembershipController::class);
Route::apiResource('roster', RosterController::class);
Route::apiResource('voucher', VoucherController::class);
