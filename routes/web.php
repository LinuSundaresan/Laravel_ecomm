<?php

// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard' , [AdminController::class, 'dashboard'])->middleware('auth', 'role:admin')->name('admin.dashboard');

Route::get('admin/profile' , [ProfileController::class, 'index'])->middleware('auth', 'role:admin')->name('admin.profile');
Route::post('admin/profile/update' , [ProfileController::class, 'profileUpdate'])->middleware('auth', 'role:admin')->name('admin.profile.update');
Route::post('admin/password/update' , [ProfileController::class, 'passwordUpdate'])->middleware('auth', 'role:admin')->name('admin.password.update');


Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user' , 'as'=>'.user'], function(){
    Route::get('dashboard' , [UserDashboardController::class, 'index'])->name('dashboard');
});

Route::get('vendor/dashboard' , [VendorController::class, 'dashboard'])->middleware('auth', 'role:vendor')->name('vendor.dashboard');

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
