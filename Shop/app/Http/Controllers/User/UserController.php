<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Feedback;
use App\Models\Comment;
use App\Models\Reply;
use App\Http\Controllers\HomeController;

class UserController extends Controller
{
    protected $homeController;
    public function __construct(HomeController $homeController)
    {
        $this->middleware('auth');
        $this->middleware('checkPermission');
        $this->homeController = $homeController;
    }
    public function show_user(){
        $dataList = User::leftJoin('roles', 'roles.id', '=', 'users.usertype')
        ->select('users.*', 'roles.name as role_name')
        ->get();
        $total_feedback = $this->homeController->total_feedback();
        $messages= $this->homeController->message();

        return view('admin.show_user', compact('dataList','total_feedback','messages'));
    }

    public function view_user(Request $request){
        $roleList = Role::all();
        $user = null;
    
        if ($request->filled('id')) {
            $user = User::find($request->id);
    
            if (!$user) {
                $user = null;
            }
        }
        $total_feedback = $this->homeController->total_feedback();
        $messages= $this->homeController->message();

        return view('admin.view_user', compact('user', 'roleList','total_feedback','messages'));
    }

    public function add_user(Request $request) {
        
        $id = $request->id;

        if (isset($id) && $id > 0) {
            $user = User::find($id);
    
            if (!$user) {
                return redirect('show_user')->with('error', 'User not found.');
            }
    
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->usertype = $request->usertype;
    
            if ($request->has('password') && $request->password !== '') {
                $user->password = Hash::make($request->password);
            }
    
            $user->save();
            return redirect('show_user')->with('message', 'User updated successfully.');
        } else {
            $existingUser = User::where('email', $request->email)->first();
    
            if ($existingUser) {
                return redirect('view_user')->with('error', 'User with this email already exists.');
            }
    
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->usertype =  $request->usertype;
            $user->password = Hash::make($request->password);
                
            $user->save();
            return redirect('show_user')->with('message', 'User added successfully.');
        }
    }

    public function delete_user($id){
        $userId = user::find($id);;
        $feedback = Feedback::where('user_id', $userId->id)->count();
        $comment= Comment::where('user_id', $userId->id)->count();
        $reply = Reply::where('user_id', $userId->id)->count();
            
        if ($feedback > 0 || $comment > 0 || $reply > 0) {
            return redirect()->back()->with('message', 'Cannot delete this account. It has associated feedbacks or comments or reply.');
        }

        $userId ->delete();
        return redirect()->back()->with('message', 'User deleted successfully');
    }

    public function searchUser(Request $request){
        $searchText = $request->search;
        $total_feedback = $this->homeController->total_feedback();
        $messages= $this->homeController->message();

        $dataList = user::where('name', 'LIKE',"%$searchText%")->orwhere('email', 'LIKE',"%$searchText%")
                    ->orwhere('phone', 'LIKE',"%$searchText%")->orwhere('address', 'LIKE',"%$searchText%")->get();

        return view('admin.show_user',compact('dataList','total_feedback','messages'));
    }

}
