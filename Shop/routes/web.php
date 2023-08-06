<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/',[HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

route::get('/redirect',[HomeController::class, 'redirect']);

route::get('/show_user',[UserController::class, 'show_user']);

route::get('/view_user',[UserController::class, 'view_user']);

route::post('/add_user',[UserController::class, 'add_user']);

route::get('/delete_user/{id}',[UserController::class, 'delete_user']);
