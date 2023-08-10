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

    //Show product view
    public function products(){
        $product = Product::all()->where('deleted', 0);
        return view('frontend.all_product',compact('product'));
   }

    //show product details
    public function product_details($id){
        $product = Product::find($id);
        $productList = Product::where('deleted', 0)
                        ->orderBy('created_at', 'asc')
                        ->paginate(3);
        return view('frontend.product_details', compact('product', 'productList'));
    }

}
