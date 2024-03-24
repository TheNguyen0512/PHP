<?php

use App\Http\Controllers\Auth\OTPController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Customer\Auth\ForgetPasswordController;
use App\Http\Controllers\Customer\IndexController;
use App\Http\Controllers\Customer\Auth\LoginController;

use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    //Login
    Route::get('/', [IndexController::class, 'index'])->middleware('user_page_access')->name('home');
    Route::get('auth', [LoginController::class, 'index'])->middleware('auth_page_access')->name('auth');
    Route::get('forget-password', [ForgetPasswordController::class, 'index'])->name('forget-password');
    Route::get('reset-password/{token}/{email}', [ForgetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.link');
    //Category  
    Route::get('/', [CategoryController::class, 'categories'])->middleware('user_page_access')->name('home');
    Route::get('/c/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/c/{id}/details', [ProductController::class, 'showproduct'])->name('product.show');

});
