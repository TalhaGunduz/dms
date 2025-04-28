<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\indexController as DashboardController;
use App\Http\Controllers\Admin\User\indexController as UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Main route
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes


// Home route (after login)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Login and Logout routes
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes with authentication (without status check middleware)
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {

    // Admin dashboard route
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // User management routes
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');        // User list
        Route::get('/data', [UserController::class, 'data'])->name('data');      // User data API
        Route::get('/create', [UserController::class, 'create'])->name('create'); // Create user form
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy'); // Delete user
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');   // Edit user form
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update'); // Update user data
        Route::post('/store', [UserController::class, 'store'])->name('store');   // Store new user
        Route::post('/user/update-status', [UserController::class, 'updateUserStatus'])->name('user.updateStatus'); // Update user status
    });

});
