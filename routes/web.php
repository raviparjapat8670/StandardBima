<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dash');
});

// admin routes start here
Route::prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/dash', [DashboardController::class, 'index'])->name('admin.dash');
    Route::get('/logout', [UserController::class, 'logout'])->name('admin.logout');


    Route::match(['get','post'],'/', [UserController::class, 'login'])->name('admin.login');

});
// admin routes end here


Route::prefix('test')->group(function () {
    Route::get('/makepassword/{password}', [TestController::class, 'makepassword']);
});