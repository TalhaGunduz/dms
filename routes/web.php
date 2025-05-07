<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\indexController as DashboardController;
use App\Http\Controllers\Admin\User\indexController as UserController;
use App\Http\Controllers\Admin\Student\indexController as StudentController;
use App\Http\Controllers\Admin\Room\indexController as RoomController;
use App\Http\Controllers\Admin\TransferController;
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\RoomAssetController;
use App\Http\Controllers\Admin\MaintenanceRequestController;
use App\Http\Controllers\Admin\MaintenanceLogController;
use App\Http\Controllers\Admin\indexController as AdminController;



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
    return redirect()->route('login');
});

// Authentication routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Home route (after login)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    
    // User Management
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/data', [UserController::class, 'data'])->name('data');
        Route::post('/user/update-status', [UserController::class, 'updateStatus'])->name('user.updateStatus');
    });

    // Student Management
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/store', [StudentController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [StudentController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [StudentController::class, 'destroy'])->name('destroy');
        Route::get('/show/{id}', [StudentController::class, 'show'])->name('show');
        Route::get('/data', [StudentController::class, 'data'])->name('data');
        Route::post('/user/update-status', [StudentController::class, 'updateStatus'])->name('user.updateStatus');
        Route::get('/rooms/by-block/{blockId}', [StudentController::class, 'getRoomsByBlock'])->name('rooms.by-block');
    });

    // Room Management
    Route::prefix('room')->name('room.')->group(function () {
        Route::get('/', [RoomController::class, 'index'])->name('index');
        Route::get('/create', [RoomController::class, 'create'])->name('create');
        Route::post('/store', [RoomController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [RoomController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [RoomController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [RoomController::class, 'destroy'])->name('destroy');
        Route::get('/show/{id}', [RoomController::class, 'show'])->name('show');
        Route::get('/data', [RoomController::class, 'data'])->name('data');
        Route::get('/get-rooms/{blockId}', [RoomController::class, 'getRoomsByBlock'])->name('get-rooms');
    });

    // Asset Management
    Route::resource('assets', AssetController::class);
    Route::resource('room-assets', RoomAssetController::class);
    Route::resource('maintenance-requests', MaintenanceRequestController::class);
    Route::resource('maintenance-logs', MaintenanceLogController::class);
});




