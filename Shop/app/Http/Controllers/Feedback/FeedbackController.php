<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function show_feedback(){
        $dataList=feedback::all();
        return view('admin.show_feedback', compact('dataList'));
    }
}
