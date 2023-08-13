<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Order\OrderController;

route::get('/order',[OrderController::class, 'order']);

route::get('/delete_order/{id}',[OrderController::class, 'delete_order']);

route::get('/delivered/{id}',[OrderController::class, 'delivered']);