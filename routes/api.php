<?php

use App\Http\Controllers\Cache\CacheController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Customer\Auth\ForgetPasswordController;
use App\Http\Controllers\Customer\Auth\LoginController;
use App\Http\Controllers\Customer\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

// Route::group([
//     "middleware" => ["auth:api"]
// ], function(){
  
//     // Route::get("profile", [ApiController::class, "profile"]);
//     // Route::get("refresh", [ApiController::class, "refreshToken"]);
//     // Route::get("logout", [ApiController::class, "logout"]);
// });
Route::prefix('/')->group(function (){
    Route::post('check-login',  [LoginController::class, 'checkLogin']);
    Route::post('login',  [LoginController::class, 'login']);
    Route::post('check-register',  [RegisterController::class, 'checkRegister']);
    Route::post('register',  [RegisterController::class, 'register']);
    Route::post('cache',  [CacheController::class, 'getCache']);
    Route::post('logout',  [LoginController::class, 'logout']);
    Route::post('forget-password', [ForgetPasswordController::class, 'submitForgetPasswordForm']); 
    Route::post('reset-password', [ForgetPasswordController::class, 'submitResetPasswordForm']);

    Route::get('categories', [CategoryController::class, 'categories']);
    Route::get('show', [CategoryController::class, 'show']);
});
