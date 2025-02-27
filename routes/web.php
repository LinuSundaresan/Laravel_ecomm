<?php

// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
//     Route::get('admin/dashboard' , [AdminController::class, 'dashboard'])->middleware('auth', 'role:admin')->name('admin.dashboard');

//     Route::get('admin/profile' , [ProfileController::class, 'index'])->middleware('auth', 'role:admin')->name('admin.profile');
//     Route::post('admin/profile/update' , [ProfileController::class, 'profileUpdate'])->middleware('auth', 'role:admin')->name('admin.profile.update');
//     Route::post('admin/password/update' , [ProfileController::class, 'passwordUpdate'])->middleware('auth', 'role:admin')->name('admin.password.update');
// });

/**Admin Routes */

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('dashboard' , [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('profile' , [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/update' , [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('password/update' , [ProfileController::class, 'passwordUpdate'])->name('password.update');
    //slider routes
    Route::resource('slider', SliderController::class);
});

/**Admin Routes */


// Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user' , 'as'=>'.user'], function(){
//     Route::get('dashboard' , [UserDashboardController::class, 'index'])->name('dashboard');
//     Route::get('profile' , [UserProfileController::class, 'index'])->name('profile');
// });

Route::prefix('user')->middleware(['auth', 'verified'])->name('user.')->group(function () {
    Route::get('dashboard' , [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile' , [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile' , [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile' , [UserProfileController::class, 'updatePassword'])->name('profile.update.password');
});

// Route::get('vendor/dashboard' , [VendorController::class, 'dashboard'])->middleware('auth', 'role:vendor')->name('vendor.dashboard');

Route::prefix('vendor')->middleware('auth', 'role:vendor')->name('vendor.')->group(function(){
    Route::get('dashboard' , [VendorController::class, 'dashboard'])->name('dashboard');
    Route::get('profile' , [VendorProfileController::class, 'index'])->name('profile');
    Route::put('profile' , [VendorProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile' , [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');
});

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
