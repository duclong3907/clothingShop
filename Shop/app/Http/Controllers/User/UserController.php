<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkPermission');
    }
    public function show_user(){
        $dataList = User::leftJoin('roles', 'roles.id', '=', 'users.usertype')
        ->select('users.*', 'roles.name as role_name')
        ->get();

        return view('admin.show_user', compact('dataList'));
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
        return view('admin.view_user', compact('user', 'roleList'));
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
        $userId = user::find($id);

        $userId ->delete();
        return redirect()->back()->with('message', 'User deleted successfully');
    }

    public function searchUser(Request $request){
        $searchText = $request->search;
        $dataList = user::where('name', 'LIKE',"%$searchText%")->orwhere('email', 'LIKE',"%$searchText%")
                    ->orwhere('phone', 'LIKE',"%$searchText%")->orwhere('address', 'LIKE',"%$searchText%")->get();

        return view('admin.show_user',compact('dataList'));
    }

}
