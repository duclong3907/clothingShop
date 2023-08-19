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

route::get('/redirect',[HomeController::class, 'redirect'])->middleware('auth','verified');

// customer interface
route::get('/products',[HomeController::class, 'products']);

route::get('/product_details/{id}',[HomeController::class, 'product_details']);

route::post('/add_cart/{id}',[HomeController::class, 'add_cart']);

route::get('/show_cart',[HomeController::class, 'show_cart']);

route::post('/update_cart/{id}',[HomeController::class, 'update_cart']);

route::get('/delete_cart/{id}',[HomeController::class, 'delete_cart']);

route::post('/cash_order',[HomeController::class, 'cash_order']);

route::get('/show_order',[HomeController::class, 'show_order']);

route::get('/cancel_order/{id}',[HomeController::class, 'cancel_order']);

route::get('/delete_orders/{id}',[HomeController::class, 'delete_orders']);

route::get('/stripe/{totalmoney}',[HomeController::class, 'stripe']);

Route::post('stripe/{totalmoney}', [HomeController::class, 'stripePost'])->name('stripe.post');

route::get('/contact',[HomeController::class, 'contact']);

route::post('/add_feedback',[HomeController::class, 'add_feedback']);

route::get('/view_profile/{id}',[HomeController::class, 'view_profile']);

route::post('/edit_profile',[HomeController::class, 'edit_profile']);

route::get('/product_search',[HomeController::class, 'product_search']);

route::get('/search_product',[HomeController::class, 'search_product']);

