<?php

use Illuminate\Support\Facades\Route;
use Tray\Sellers\Infrastructure\Http\Controller\{CreateSellerController,
    ListSellersController,
    ListSellSellerController};

Route::post('/sellers', CreateSellerController::class);
Route::get('/sellers', ListSellersController::class);
Route::get('/sellers/{sellerId}/sells', ListSellSellerController::class);
