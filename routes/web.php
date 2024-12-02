<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\OccupationController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CheckLoggedIn;
use Illuminate\Support\Facades\Route;




Route::match(['get', 'post'], 'admin', [UserController::class, 'login'])->name('admin.login');
Route::middleware([CheckLoggedIn::class])->group(function () {
    // admin routes start here
    Route::get('/', function () {
        return view('admin.dash');
    });
    Route::prefix('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::match(['get', 'post'], '/add-user', [UserController::class, 'CreateUser'])->name('admin.add-user');
        Route::match(['get', 'post'], '/edit-user/{id?}', [UserController::class, 'EditUser'])->name('admin.edit-user');
        Route::get('/dash', [DashboardController::class, 'index'])->name('admin.dash');
        Route::get('/logout', [UserController::class, 'logout'])->name('admin.logout');
        // occupations start
        Route::get('/occupations', [OccupationController::class, 'index'])->name('admin.occupations');
        Route::match(['get', 'post'], '/add-occupation', [OccupationController::class, 'CreateOccupation'])->name('admin.add-occupation');
        Route::match(['get', 'post'], '/edit-occupation/{id?}', [OccupationController::class, 'EditOccupation'])->name('admin.edit-occupation');

        // occutaions end




    });

    // admin routes end here


    Route::prefix('test')->group(function () {
        Route::get('/makepassword/{password}', [TestController::class, 'makepassword']);
    });
});
