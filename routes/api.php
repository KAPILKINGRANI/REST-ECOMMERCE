<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('users', \App\Http\Controllers\User\UsersController::class);
Route::apiResource('sellers', \App\Http\Controllers\Seller\SellersController::class)->only(['index', 'show']);
Route::apiResource('buyers', \App\Http\Controllers\Buyer\BuyersController::class)->only(['index', 'show']);
Route::apiResource('categories', \App\Http\Controllers\Category\CategoriesController::class);
Route::apiResource('transactions', \App\Http\Controllers\Transaction\TransactionsController::class)->only(['index', 'show']);
Route::apiResource('products', \App\Http\Controllers\Product\ProductsController::class)->only(['index', 'show']);;
Route::apiResource('transactions.categories', \App\Http\Controllers\Transaction\TransactionCategoriesController::class)->only(['index']);
Route::apiResource('transactions.seller', \App\Http\Controllers\Transaction\TransactionSellerController::class)->only(['index']);
Route::apiResource('buyers.transactions', \App\Http\Controllers\Buyer\BuyerTransactionsController::class)->only(['index']);
Route::apiResource('buyers.products', \App\Http\Controllers\Buyer\BuyerProductsController::class)->only(['index']);
Route::apiResource('buyers.sellers', \App\Http\Controllers\Buyer\BuyerSellersController::class)->only(['index']);
Route::apiResource('buyers.categories', \App\Http\Controllers\Buyer\BuyerCategoriesController::class)->only(['index']);

Route::apiResource('categories.products', \App\Http\Controllers\Category\CategoryProductsController::class)->only(['index']);
Route::apiResource('categories.transactions', \App\Http\Controllers\Category\CategoryTransactionsController::class)->only(['index']);
Route::apiResource('categories.buyers', \App\Http\Controllers\Category\CategoryBuyersController::class)->only(['index']);
Route::apiResource('categories.sellers', \App\Http\Controllers\Category\CategorySellersController::class)->only(['index']);
