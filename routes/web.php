<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DocumentationController;
use App\Http\Controllers\admin\OccupationController;
use App\Http\Controllers\admin\TermPolicyController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CheckLoggedIn;
use App\Http\Middleware\CheckPermission;
use App\Models\Occupation;
use Illuminate\Support\Facades\Route;




Route::match(['get', 'post'], 'admin', [UserController::class, 'login'])->name('admin.login');
Route::middleware([CheckLoggedIn::class])->group(function () {
    // admin routes start here
    Route::get('/', function () {
        return view('admin.dash');
    });
    Route::prefix('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('admin.users')->middleware(CheckPermission::class.':list,User');
        Route::match(['get', 'post'], '/add-user', [UserController::class, 'CreateUser'])->name('admin.add-user')->middleware(CheckPermission::class.':create,User');
        Route::match(['get', 'post'], '/edit-user/{id?}', [UserController::class, 'EditUser'])->name('admin.edit-user')->middleware(CheckPermission::class.':edit,User');
        Route::get('/dash', [DashboardController::class, 'index'])->name('admin.dash');
        Route::get('/logout', [UserController::class, 'logout'])->name('admin.logout');
      
      
        // occupations start
        Route::get('/occupations', [OccupationController::class, 'index'])->name('admin.occupations')->middleware(CheckPermission::class.':list,Occupation');
        Route::match(['get', 'post'], '/add-occupation', [OccupationController::class, 'CreateOccupation'])->name('admin.add-occupation')->middleware(CheckPermission::class.':create,Occupation');
        Route::match(['get', 'post'], '/edit-occupation/{id?}', [OccupationController::class, 'EditOccupation'])->name('admin.edit-occupation')->middleware(CheckPermission::class.':edit,Occupation');

        // occutaions end

        // documentation start
        Route::get('/documentations', [DocumentationController::class, 'index'])->name('admin.documentations')->middleware(CheckPermission::class.':list,Documentation');
        Route::match(['get', 'post'], '/add-documentation', [DocumentationController::class, 'CreateDocumentation'])->name('admin.add-documentation')->middleware(CheckPermission::class.':create,Documentation');
        Route::match(['get', 'post'], '/edit-documentation/{id?}', [DocumentationController::class, 'EditDocumentation'])->name('admin.edit-documentation')->middleware(CheckPermission::class.':edit,Documentation');
        //documentation end


        // terms-policy start
        Route::get('/terms-policy', [TermPolicyController::class, 'index'])->name('admin.terms-policy')->middleware(CheckPermission::class.':list,Documentation');
        Route::match(['get', 'post'], '/add-terms-policy', [TermPolicyController::class, 'CreateTermsPolicy'])->name('admin.add-terms-policy')->middleware(CheckPermission::class.':create,Documentation');
        Route::match(['get', 'post'], '/edit-terms-policy/{id?}', [TermPolicyController::class, 'EditTermsPolicy'])->name('admin.edit-terms-policy')->middleware(CheckPermission::class.':edit,Documentation');
        //terms-policy end


    });

    // admin routes end here


    Route::prefix('test')->group(function () {
        Route::get('/makepassword/{password}', [TestController::class, 'makepassword']);
    });
});
