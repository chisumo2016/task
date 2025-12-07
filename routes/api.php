<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\LogoutController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->as('v1.')->middleware('auth:sanctum')->group(function () {{
    /**tasks*/
    Route::apiResource('tasks', TaskController::class);
    Route::post('logout' , LogoutController::class)->name('logout');

}});

/*register*/
Route::post('register' , RegisterController::class)->name('register');
Route::post('login' , LoginController::class)->name('login');

