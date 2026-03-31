<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Customer API
Route::get("/list",[CustomerController::class,'allshow']);
Route::post("/addcustomer",[CustomerController::class,'add']);

// Product API
Route::get("/product",[ProductController::class,'allshow']);
Route::post("/addproduct",[ProductController::class,'add']);

