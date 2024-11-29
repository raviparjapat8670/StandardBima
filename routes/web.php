<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CheckLoggedIn;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dash');
});


Route::match(['get','post'],'admin', [UserController::class, 'login'])->name('admin.login');
Route::middleware([CheckLoggedIn::class])->group(function () {
// admin routes start here
Route::prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::match(['get','post'],'/add-user', [UserController::class, 'CreateUser'])->name('admin.add-user');
    Route::match(['get','post'],'/edit-user/{id?}', [UserController::class, 'EditUser'])->name('admin.edit-user');

    Route::get('/dash', [DashboardController::class, 'index'])->name('admin.dash');
    Route::get('/logout', [UserController::class, 'logout'])->name('admin.logout');

});

// admin routes end here


Route::prefix('test')->group(function () {
    Route::get('/makepassword/{password}', [TestController::class, 'makepassword']);
});


});