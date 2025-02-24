<?php

// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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




Route::get('vendor/dashboard' , [VendorController::class, 'dashboard'])->middleware('auth', 'role:vendor')->name('vendor.dashboard');

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
