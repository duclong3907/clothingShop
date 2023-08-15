<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Feedback\FeedbackController;

route::get('/show_feedback',[FeedbackController::class, 'show_feedback']);
