<?php

use App\Http\Controllers\Backend\Auth\RegisteredUserController;
use App\Http\Controllers\Backend\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('admin.register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('backend.pages.dashboard');
    })->name('admin.dashboard');

    Route::resource('permissions', 'App\Http\Controllers\Backend\PermissionsController');
    Route::resource('roles', 'App\Http\Controllers\Backend\RolesController');
    Route::resource('admin_users', 'App\Http\Controllers\Backend\AdminUserController');
   

    Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');
});
