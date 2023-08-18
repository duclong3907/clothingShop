<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

use Notification;
use App\Notifications\SendEmailNotification;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkPermission');
    }
    
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

    public function send_email( $id){
        $contact= feedback::find($id);

        return view('admin.email_info', compact('contact'));
    }

    public function send_user_email(Request $request, $id){
        $contact = feedback::find($id);

        $detail=[
            'greeting'=>$request->greeting,
            'firstline'=>$request->firstline,
            'body'=>$request->body,
            'button' => $request->button,
            'lastline'=>$request->lastline,
            'url'=>$request->url,
        ];

        Notification::send($contact, new SendEmailNotification($detail));

        return redirect()->back()->with('message', 'Email sent successfully');
    }
}
