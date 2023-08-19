<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Order\OrderController;

route::get('/order',[OrderController::class, 'order']);

route::get('/delete_order/{id}',[OrderController::class, 'delete_order']);

route::get('/delivered/{id}',[OrderController::class, 'delivered']);

route::get('/order_detail/{id}',[OrderController::class, 'order_detail']);

route::get('/print_pdf/{id}',[OrderController::class, 'print_pdf']);

route::get('/searchOrder',[OrderController::class, 'searchOrder']);