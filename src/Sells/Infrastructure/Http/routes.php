<?php

use Illuminate\Support\Facades\Route;
use Tray\Sells\Infrastructure\Http\Controller\CreateSellController;

Route::post('/sell', CreateSellController::class);
