<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\MembershipController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('room', RoomController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('package', PackageController::class);
Route::apiResource('membership', MembershipController::class);
Route::apiResource('membership', MembershipController::class);
