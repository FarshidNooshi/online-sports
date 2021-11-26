<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

//setting the required functionalities for auth.php
Route::get('/register', [RegisteredUserController::class, 'create'])// handled for registering 
                ->middleware('guest')
                ->name('register');


Route::post('/register', [RegisteredUserController::class, 'store']) // for storing 
                ->middleware('guest');


Route::get('/login', [AuthenticatedSessionController::class, 'create']) // for creating in login
                ->middleware('guest')
                ->name('login');


Route::post('/login', [AuthenticatedSessionController::class, 'store'])// for storing 
                ->middleware('guest');


Route::get('/forgot-password', [PasswordResetLinkController::class, 'create']) // forgetting password request
                ->middleware('guest')
                ->name('password.request');


Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])// email, forgetting password
                ->middleware('guest')
                ->name('password.email');


Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])// resetting password and token get
                ->middleware('guest')
                ->name('password.reset');


Route::post('/reset-password', [NewPasswordController::class, 'store'])// resetting password and update post
                ->middleware('guest')
                ->name('password.update');


Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])// validation for email
                ->middleware('auth')
                ->name('verification.notice');


Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])// verification for email, id
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');


Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])// email post
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');


Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])// confirmation for password
                ->middleware('auth')
                ->name('password.confirm');


Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])//posting confirmation of password
                ->middleware('auth');


                
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');//logging out, post

