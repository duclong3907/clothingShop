<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Google\GoogleController;

route::get('auth/google',[GoogleController::class, 'googlepage']);

route::get('auth/google/callback',[GoogleController::class, 'googlecallback']);