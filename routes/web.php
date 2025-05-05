<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\indexController as DashboardController;
use App\Http\Controllers\Admin\User\indexController as UserController;
use App\Http\Controllers\Admin\Student\indexController as StudentController;
use App\Http\Controllers\Admin\Room\indexController as RoomController;



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





//----------------------------------------------------------------------------------------------------------------------------





Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {

    // Admin dashboard route
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // User management routes
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/data', [UserController::class, 'data'])->name('data');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::post('/user/update-status', [UserController::class, 'updateUserStatus'])->name('user.updateStatus');
    });

// Student management routes
Route::group(['prefix' => 'student', 'as' => 'student.'], function () {
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('/data', [StudentController::class, 'data'])->name('data');
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    Route::get('/destroy/{id}', [StudentController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('edit');
    Route::get('/show/{id}', [StudentController::class, 'show'])->name('show');
    Route::post('/update/{id}', [StudentController::class, 'update'])->name('update');
    Route::post('/store', [StudentController::class, 'store'])->name('store');
    Route::post('/user/update-status', [StudentController::class, 'updateUserStatus'])->name('user.updateStatus');
    Route::get('admin/students/data', [StudentController::class, 'getData'])->name('students.getData');
    Route::get('/rooms/by-block/{blockId}', [StudentController::class, 'getRoomsByBlock'])->name('rooms.by-block');
    
});



    // Room management routes
    Route::group(['prefix' => 'room', 'as' => 'room.'], function () {
        Route::get('/', [RoomController::class, 'index'])->name('index');
        Route::get('/data', [RoomController::class, 'data'])->name('data');
        Route::get('/create', [RoomController::class, 'create'])->name('create');
        Route::post('/store', [RoomController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [RoomController::class, 'edit'])->name('edit');
        // Blok ID'sine göre odaları alacak route
Route::get('/get-rooms/{blockId}', [RoomController::class, 'getRoomsByBlock']);

        Route::post('/update/{id}', [RoomController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [RoomController::class, 'destroy'])->name('destroy');
    });

});




