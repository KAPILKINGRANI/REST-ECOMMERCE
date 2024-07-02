<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('users',\App\Http\Controllers\User\UsersController::class);
Route::apiResource('sellers',\App\Http\Controllers\Seller\SellersController::class);
Route::apiResource('buyers',\App\Http\Controllers\Buyer\BuyersController::class);
Route::apiResource('categories',\App\Http\Controllers\Category\CategoriesController::class);
Route::apiResource('transactions',\App\Http\Controllers\Transaction\TransactionsController::class);
Route::apiResource('products',\App\Http\Controllers\Product\ProductsController::class);


