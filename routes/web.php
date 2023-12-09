<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\ResourceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", [RouteController::class, "login_route"]);
Route::post("/login_post", [UserController::class, "login_post"]);

Route::middleware("auth")->group(function () {
    Route::get("/printer_list", [RouteController::class, "show_printer_list"]);
    Route::get("/resource_list", [RouteController::class, "show_resources_list"]);
    Route::get("/resource_in", [RouteController::class, "show_resource_in"]);
    Route::post("/resource_in_submit", [ResourceController::class, "resource_in_submit"])->name("resource_in.submit");
    Route::get("/resource_out", [RouteController::class, "show_resource_out"]);
    Route::post("/resource_out_get_printers", [ResourceController::class, "resource_out_get_printers"])->name("resource_out.get_printers");
});

/* Protected Routes */
Route::middleware(["admin", "auth"])->group(function () {
    Route::get("/add_printer", [RouteController::class, "add_printer_page"]);
    Route::post("/add_printer_submit", [PrinterController::class, "add_printer_submit"])->name("add_printer.submit");

    Route::get("/add_resource", [RouteController::class, "add_resource_page"]);
    Route::post("/add_resource_submit", [ResourceController::class, "add_resource_submit"])->name("add_resource.submit");
});
