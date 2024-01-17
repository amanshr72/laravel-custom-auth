<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\QuoteController;
use App\Http\Middleware\APITokenMiddleware;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () { return view('welcome'); });
    
    Route::get('login', [CustomAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [CustomAuthController::class, 'login']);

    Route::get('register', [CustomAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [CustomAuthController::class, 'register']);

    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget-password');
    Route::post('forget-password', [ForgotPasswordController::class, 'sendForgetPasswordLink']);
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset-password-form');
    Route::post('reset-password', [ForgotPasswordController::class, 'forgetPassword'])->name('reset-user-password');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('about', function () { return view('about'); })->name('about');
    Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');
});

Route::middleware([APITokenMiddleware::class])->group(function () {
    Route::get('/api/quotes', [QuoteController::class, 'getQuotes'])->name('get-quote');
});

if (app()->environment('testing')) {
    // Exclude middleware for testing only
    Route::get('/api/quotes', [QuoteController::class, 'getQuotes'])->name('get-quote');
}