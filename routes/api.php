<?php

use App\Http\Controllers\ResourceController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post("/login", [UserController::class, "login"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::post("/resource_out", [ResourceController::class, "api_resource_out_submit"]);
    Route::post("/resource_in", [ResourceController::class, "api_resource_in_submit"]);
});
