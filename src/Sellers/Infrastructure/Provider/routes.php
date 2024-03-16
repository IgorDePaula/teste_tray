<?php

use Illuminate\Support\Facades\Route;
use Tray\Sellers\Infrastructure\Http\Controller\CreateSellerController;

Route::post('/sellers', CreateSellerController::class);
