<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category\CategoryController;


route::get('/view_category',[CategoryController::class, 'view_category']);

route::post('/add_category',[CategoryController::class, 'add_category']);

route::get('/delete_category/{id}',[CategoryController::class, 'delete_category']);
