<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show_user(){
        $dataList = User::leftJoin('roles', 'roles.id', '=', 'users.usertype')
        ->select('users.*', 'roles.name as role_name')
        ->get();

        return view('admin.show_user', compact('dataList'));
    }
}
