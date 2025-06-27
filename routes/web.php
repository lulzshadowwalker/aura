<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get("/", [HomeController::class, "index"])->name("home.index");

Route::get("/products", function () {
    throw new Exception("Products page not implemented yet");
})->name("products.index");

Route::get("/collections", function () {
    throw new Exception("Collections page not implemented yet");
})->name("collections.index");

Route::get("/contact", [ContactController::class, "index"])->name(
    "contact.index"
);

Route::post("/contact", [ContactController::class, "store"])->name(
    "contact.store"
);

Route::get("/products/{product}", function ($product) {
    throw new Exception("Product page not implemented yet");
})->name("products.show");

Route::get("/collections/{collection}", function ($collection) {
    throw new Exception("Collection page not implemented yet");
})->name("collections.show");
