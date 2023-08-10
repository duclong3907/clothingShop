<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Product;


class HomeController extends Controller
{
    public function index(){
        $products = Product::where('deleted', 0)
                    ->paginate(6);
        return view('frontend.userpage', compact('products'));
    }

    public function redirect()
    {
        $usertype=Auth::user()->usertype;
        
        if($usertype == '1'){

            return view('admin.home');
        } else{
            $products = Product::where('deleted', 0)
                        ->paginate(6);

            return view('frontend.userpage', compact('products'));
        }

    }

}
