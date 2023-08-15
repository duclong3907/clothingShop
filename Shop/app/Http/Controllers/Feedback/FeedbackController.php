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

    public function markRead( $id){
        $feedback = feedback::find($id);
        
        $feedback->status = "Read";
        $feedback->save();
        return redirect()->back();
    }

    public function delete_feedback($id){
        $feedback = feedback::find($id);

        $feedback ->delete();
        return redirect()->back()->with('message', 'Feedback deleted successfully');
    }
}
