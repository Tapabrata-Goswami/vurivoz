<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;



Route::get('/auth/sign',[AuthController::class,'AdminSigninView'])->name('AdminSigninView');
Route::post('/auth/sign',[AuthController::class,'AdminSigninPost'])->name('AdminSigninPost');
Route::get('/auth/otp-validation', [AuthController::class, 'OtpValidateView'])->name('OtpValidateView');
Route::post('/auth/otp-validation', [AuthController::class, 'OtpValidatePost'])->name('OtpValidatePost');

Route::get('/auth/login', [AuthController::class,'AdminLoginView'])->name('AdminLoginView');
Route::get('/', function () {
    return view('auth.adminLogin');
});

// Authentication --


// Dashboard --
Route::get('/dashboard', function(){
    return view('admin.dashboard');
})->name('AdminDashboard');
