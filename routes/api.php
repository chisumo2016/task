<?php

use App\Http\Controllers\API\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->as('v1.')->group(function () {{
    /**tasks*/
    Route::apiResource('tasks', TaskController::class);

}});
