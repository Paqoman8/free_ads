<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\ProfileController;

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

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Ads
Route::resource('ads', AdController::class);

// Auth
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'store']);
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'create'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'store']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Profile (Placeholders)
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
