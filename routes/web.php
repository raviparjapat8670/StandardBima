<?php

use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dash');
});

// admin routes start here
Route::prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
});


// admin routes end here