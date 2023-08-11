<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Product;
use App\Models\Cart;


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

    public function add_cart(Request $request, $id){
        if(Auth::id()){
            $user = Auth::user();
            $product = Product::find($id);
            $userid = $user->id;

            $product_exist_id = cart::where('product_id','=',$id)->where('user_id','=', $userid)->get('id')->first();

            if($product_exist_id){

                $cart = cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity+$request->quantity;

                if($product->discount_price != null){
                    $cart->price= $product->discount_price;
                } else{
                    $cart->price= $product->price;
                }

                $cart->total_price=$cart->price*$cart->quantity;

                $cart->save();

                return redirect()->back();

            } else{
                $cart = new Cart();
                $cart->name= $user->name;
                $cart->email= $user->email;
                $cart->phone= $user->phone;
                $cart->address= $user->address;
                $cart->user_id= $user->id;
                $cart->product_title= $product->title;
                $cart->image= $product->image;
                if($product->discount_price != null){
                    $cart->price= $product->discount_price;
                } else{
                    $cart->price= $product->price;
                }
                $cart->product_id= $product->id;
                $cart->quantity= $request->quantity;
                $cart->total_price=$cart->price*$request->quantity;
                $cart->save();

                return redirect()->back();

            }

        } else{
            return redirect('login');
        }
    }

}
