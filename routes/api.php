<?php

use App\Http\Controllers\API\V1\LoginController;
use App\Http\Controllers\API\V1\LogoutController;
use App\Http\Controllers\API\V1\RegisterController;
use App\Http\Controllers\API\V1\TaskController;

use App\Http\Controllers\API\V2\LoginController as LoginControllerV2;
use App\Http\Controllers\API\V2\LogoutController as LogoutControllerV2;
use App\Http\Controllers\API\V2\RegisterController as RegisterControllerV2;
use App\Http\Controllers\API\V2\TaskController as TaskControllerV2;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->as('v1.')->group(function () {{
    /**tasks*/
    Route::apiResource('tasks',TaskController::class)->middleware('auth:sanctum');
    Route::post('logout' , LogoutController::class)->name('logout')->middleware('auth:sanctum');

    /*register*/
    Route::post('register' , RegisterController::class)->name('register');
    Route::post('login' ,    LoginController::class)->name('login');

}});


Route::prefix('v2')->as('v2.')->group(function () {{
    /**tasks*/
    Route::apiResource('tasks',TaskControllerV2::class)->middleware('auth:sanctum');
    Route::post('logout' , LogoutControllerV2::class)->name('logout')->middleware('auth:sanctum');

    /*register*/
    Route::post('register' , RegisterControllerV2::class)->name('register');
    Route::post('login' ,    LoginControllerV2::class)->name('login');

}});



