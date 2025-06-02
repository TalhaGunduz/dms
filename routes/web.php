<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\indexController as DashboardController;
use App\Http\Controllers\Admin\User\indexController as UserController;
use App\Http\Controllers\Admin\Student\indexController as StudentController;
use App\Http\Controllers\Admin\Room\indexController as RoomController;
use App\Http\Controllers\Admin\TransferController;
use App\Http\Controllers\Admin\indexController as AdminController;
use App\Http\Controllers\Admin\Staff\indexController as StaffController;
use App\Http\Controllers\Admin\Staff\roleController as StaffRoleController;
use App\Http\Controllers\Admin\Staff\attendanceController as StaffAttendanceController;
use App\Http\Controllers\Admin\Staff\scheduleController as StaffScheduleController;
use App\Http\Controllers\Admin\Staff\qualificationController as StaffQualificationController;
use App\Http\Controllers\Admin\Staff\documentController as StaffDocumentController;
use App\Http\Controllers\Admin\Payment\indexController as PaymentController;
use App\Http\Controllers\Admin\Menu\DailyMenuController;
use App\Http\Controllers\Admin\Menu\FoodController;

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
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Home route (after login)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // User profile routes
    Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
    Route::post('/user/profile/avatar', [App\Http\Controllers\UserController::class, 'updateAvatar'])->name('user.profile.avatar');

    // Admin routes
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        
        // Quick Notes
        Route::get('/notes', function () {
            return view('admin.notes');
        })->name('notes');

        // Task Manager
        Route::get('/tasks', function () {
            return view('admin.tasks');
        })->name('tasks');

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

        // Transfer Management
        Route::prefix('transfer')->name('transfer.')->group(function () {
            Route::get('/', [TransferController::class, 'index'])->name('index');
            Route::get('/{student}/edit', [TransferController::class, 'edit'])->name('edit');
            Route::put('/{student}', [TransferController::class, 'update'])->name('update');
            Route::get('/data', [TransferController::class, 'data'])->name('data');
        });

        // Menü Yönetimi
        Route::prefix('menu')->name('menu.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\Menu\DailyMenuController::class, 'dashboard'])->name('dashboard');
            
            // Günlük Menüler
            Route::prefix('daily')->name('daily.')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\Menu\DailyMenuController::class, 'index'])->name('index');
                Route::get('/create', [App\Http\Controllers\Admin\Menu\DailyMenuController::class, 'create'])->name('create');
                Route::post('/', [App\Http\Controllers\Admin\Menu\DailyMenuController::class, 'store'])->name('store');
                Route::get('/{menu}/edit', [App\Http\Controllers\Admin\Menu\DailyMenuController::class, 'edit'])->name('edit');
                Route::put('/{menu}', [App\Http\Controllers\Admin\Menu\DailyMenuController::class, 'update'])->name('update');
                Route::delete('/{menu}', [App\Http\Controllers\Admin\Menu\DailyMenuController::class, 'destroy'])->name('destroy');
            });

            // Yemek Çeşitleri
            Route::prefix('food')->name('food.')->group(function () {
                Route::get('/{type}', [App\Http\Controllers\Admin\Menu\FoodController::class, 'index'])->name('index');
                Route::get('/{type}/create', [App\Http\Controllers\Admin\Menu\FoodController::class, 'create'])->name('create');
                Route::post('/{type}', [App\Http\Controllers\Admin\Menu\FoodController::class, 'store'])->name('store');
                Route::get('/{type}/{food}/edit', [App\Http\Controllers\Admin\Menu\FoodController::class, 'edit'])->name('edit');
                Route::put('/{type}/{food}', [App\Http\Controllers\Admin\Menu\FoodController::class, 'update'])->name('update');
                Route::delete('/{type}/{food}', [App\Http\Controllers\Admin\Menu\FoodController::class, 'destroy'])->name('destroy');
            });
        });

        // Staff Management
        Route::prefix('staff')->name('staff.')->group(function () {
            // Main Staff Routes
            Route::get('/', [StaffController::class, 'index'])->name('index');
            Route::get('/create', [StaffController::class, 'create'])->name('create');
            Route::post('/store', [StaffController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [StaffController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [StaffController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [StaffController::class, 'destroy'])->name('destroy');
            Route::get('/data', [StaffController::class, 'data'])->name('data');

            // Staff Roles
            Route::prefix('roles')->name('roles.')->group(function () {
                Route::get('/', [StaffRoleController::class, 'index'])->name('index');
                Route::get('/create', [StaffRoleController::class, 'create'])->name('create');
                Route::post('/store', [StaffRoleController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [StaffRoleController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [StaffRoleController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [StaffRoleController::class, 'destroy'])->name('destroy');
                Route::get('/data', [StaffRoleController::class, 'data'])->name('data');
            });

            // Staff Attendance
            Route::prefix('attendance')->name('attendance.')->group(function () {
                Route::get('/', [StaffAttendanceController::class, 'index'])->name('index');
                Route::get('/create', [StaffAttendanceController::class, 'create'])->name('create');
                Route::post('/store', [StaffAttendanceController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [StaffAttendanceController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [StaffAttendanceController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [StaffAttendanceController::class, 'destroy'])->name('destroy');
                Route::get('/data', [StaffAttendanceController::class, 'data'])->name('data');
            });

            // Staff Schedules
            Route::prefix('schedules')->name('schedules.')->group(function () {
                Route::get('/', [StaffScheduleController::class, 'index'])->name('index');
                Route::get('/create', [StaffScheduleController::class, 'create'])->name('create');
                Route::post('/store', [StaffScheduleController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [StaffScheduleController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [StaffScheduleController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [StaffScheduleController::class, 'destroy'])->name('destroy');
                Route::get('/data', [StaffScheduleController::class, 'data'])->name('data');
            });

            // Staff Qualifications
            Route::prefix('qualifications')->name('qualifications.')->group(function () {
                Route::get('/', [StaffQualificationController::class, 'index'])->name('index');
                Route::get('/create', [StaffQualificationController::class, 'create'])->name('create');
                Route::post('/store', [StaffQualificationController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [StaffQualificationController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [StaffQualificationController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [StaffQualificationController::class, 'destroy'])->name('destroy');
                Route::get('/data', [StaffQualificationController::class, 'data'])->name('data');
            });

            // Staff Documents
            Route::prefix('documents')->name('documents.')->group(function () {
                Route::get('/', [StaffDocumentController::class, 'index'])->name('index');
                Route::get('/create', [StaffDocumentController::class, 'create'])->name('create');
                Route::post('/store', [StaffDocumentController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [StaffDocumentController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [StaffDocumentController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [StaffDocumentController::class, 'destroy'])->name('destroy');
                Route::get('/data', [StaffDocumentController::class, 'data'])->name('data');
                Route::get('/download/{id}', [StaffDocumentController::class, 'download'])->name('download');
            });
        });

        Route::prefix('payment')->name('payment.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\Payment\indexController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\Payment\indexController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\Admin\Payment\indexController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\Payment\indexController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [App\Http\Controllers\Admin\Payment\indexController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [App\Http\Controllers\Admin\Payment\indexController::class, 'destroy'])->name('destroy');
            Route::get('/get-payers', [App\Http\Controllers\Admin\Payment\indexController::class, 'getPayers'])->name('get-payers');
        });
    });
});




