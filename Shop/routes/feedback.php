<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Feedback\FeedbackController;

route::get('/show_feedback',[FeedbackController::class, 'show_feedback']);

route::get('/markRead/{id}',[FeedbackController::class, 'markRead']);

route::get('/delete_feedback/{id}',[FeedbackController::class, 'delete_feedback']);

route::get('/send_email/{id}',[FeedbackController::class, 'send_email']);

route::post('/send_user_email/{id}',[FeedbackController::class, 'send_user_email']);

route::get('/searchFeedback',[FeedbackController::class, 'searchFeedback']);