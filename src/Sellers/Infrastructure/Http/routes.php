<?php

use Illuminate\Support\Facades\Route;
use Tray\Sellers\Infrastructure\Http\Controller\{CreateSellerController, ListSellersController};

Route::post('/sellers', CreateSellerController::class);
Route::get('/sellers', ListSellersController::class);
