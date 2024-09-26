<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\SetLocale;

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Auth::routes();

// Language switcher route
Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'el'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('language');

// Protected routes
Route::middleware(['auth', SetLocale::class])->group(function () {
    // Home route
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // User management routes
    Route::resource('users', UserController::class);

    // Role management routes
    Route::resource('roles', RoleController::class);
});