<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class, 'loginPage'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage']);
Route::post('/registration', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm']);
Route::post('/password/forgot', [ForgotPasswordController::class, 'sendResetLink']);
Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/password/reset', [ForgotPasswordController::class, 'resetPassword']);

Route::middleware('auth.jwt')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::post('/create-admin/{id}', [AdminController::class, 'makeAdmin']);
    Route::post('/remove-admin/{id}', [AdminController::class, 'removeAdmin']);
});
