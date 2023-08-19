<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;

route::get('/show_product',[ProductController::class, 'show_product']);

route::get('/view_product',[ProductController::class, 'view_product']);

route::post('/add_product',[ProductController::class, 'add_product']);

route::get('/delete_product/{id}',[ProductController::class, 'delete_product']);

route::get('/searchProduct',[ProductController::class, 'searchProduct']);




