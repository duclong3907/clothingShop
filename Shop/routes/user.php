<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;


route::get('/show_user',[UserController::class, 'show_user']);

route::get('/view_user',[UserController::class, 'view_user']);

route::post('/add_user',[UserController::class, 'add_user']);

route::get('/delete_user/{id}',[UserController::class, 'delete_user']);
