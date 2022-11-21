<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResendEmailVerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserAuthenticationController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Here is where you can register authentication routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function() {
    Route::get('login', [UserAuthenticationController::class,'create'])->name('login');
    Route::post('login', [UserAuthenticationController::class,'store'])->name('login.auth');

    Route::get('password/forgot', [ForgotPasswordController::class,'create'])->name('password.request');
    Route::post('password/forgot', [ForgotPasswordController::class,'store'])->name('password.email');

    Route::get('password/reset/{token}', [ResetPasswordController::class,'edit'])->name('password.reset');
    Route::put('password/reset', [ResetPasswordController::class,'update'])->name('password.update');
});

Route::middleware('auth')->group(function() {
    Route::get('email/verify', function() {
        if(request()->user()->hasVerifiedEmail()) {
            return redirect('/');
        }
        return view('pages.auth.email-verify');
    })->name('verification.notice');
    
    Route::get('email/verify/{id}/{hash}', VerifyEmailController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('email/verification/resend', ResendEmailVerificationController::class)
        ->middleware('throttle:6, 1')
        ->name('verification.send');

    Route::post('logout', [UserAuthenticationController::class,'destroy'])->name('logout');
});