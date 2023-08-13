<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Order\OrderController;

route::get('/order',[OrderController::class, 'order']);