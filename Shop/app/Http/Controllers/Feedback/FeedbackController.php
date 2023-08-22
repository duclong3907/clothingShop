<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

use Notification;
use App\Notifications\SendEmailNotification;
use App\Http\Controllers\HomeController;

class FeedbackController extends Controller
{
    protected $homeController;
    public function __construct(HomeController $homeController)
    {
        $this->middleware('auth');
        $this->middleware('checkPermission');
        $this->homeController = $homeController;
    }
    
    public function show_feedback(){
        $dataList=feedback::all();
        $total_feedback = $this->homeController->total_feedback();
        $messages= $this->homeController->message();

        return view('admin.show_feedback', compact('dataList','total_feedback','messages'));
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
        $total_feedback = $this->homeController->total_feedback();
        $messages= $this->homeController->message();

        return view('admin.email_info', compact('contact','total_feedback','messages'));
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

    public function searchFeedback(Request $request){
        $searchText = $request->search;
        $total_feedback = $this->homeController->total_feedback();
        $messages= $this->homeController->message();

        $dataList = feedback::where('fullname', 'LIKE',"%$searchText%")->orwhere('email', 'LIKE',"%$searchText%")
                    ->orwhere('phone', 'LIKE',"%$searchText%")->orwhere('subject_name', 'LIKE',"%$searchText%")->get();

        return view('admin.show_feedback',compact('dataList','total_feedback','messages'));
    }
}
