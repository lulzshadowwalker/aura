<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get("/", [HomeController::class, "index"])->name("home.index");

Route::get("/products", function () {
    throw new Exception("Products page not implemented yet");
})->name("products.index");

Route::get("/collections", function () {
    throw new Exception("Collections page not implemented yet");
})->name("collections.index");
