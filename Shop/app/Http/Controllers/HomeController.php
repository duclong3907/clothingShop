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

        $cartNum = $this->getCartNum();
        return view('frontend.userpage', compact('products','cartNum'));
    }

    public function redirect()
    {
        $usertype=Auth::user()->usertype;
        
        if($usertype == '1'){

            return view('admin.home');
        } else{
            $products = Product::where('deleted', 0)
                        ->paginate(6);
            $cartNum = $this->getCartNum();

            return view('frontend.userpage', compact('products','cartNum'));
        }

    }

    //Show product view
    public function products(){
        $product = Product::all()->where('deleted', 0);

        $cartNum = $this->getCartNum();
        return view('frontend.all_product',compact('product','cartNum'));
   }

    //show product details
    public function product_details($id){
        $product = Product::find($id);
        $productList = Product::where('deleted', 0)
                        ->orderBy('created_at', 'asc')
                        ->paginate(3);

        $cartNum = $this->getCartNum();
        return view('frontend.product_details', compact('product', 'productList','cartNum'));
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

    //Show quantity 
    private function getCartNum(){
        if(isset(Auth::user()->id)) {
            $id = Auth::user()->id;
            $cart = cart::where('user_id','=',$id)->get();
            $num = 0;
            foreach ($cart as $item) {
                $num += $item->quantity;
            }
            return $num;
        } else {
            return 0;
        }
    }

    //cart
    public function show_cart(){
        if(Auth::id()){
            $id=Auth::user()->id;
            $cart = cart::where('user_id','=',$id)->get();
            $cartNum = $this->getCartNum();
            $user = Auth::user();

            return view('frontend.showcart',compact('cart', 'cartNum','user'));
        }else{
            return redirect('login');
        }
    }

    public function update_cart(Request $request,$id){
        $cart = cart::find($id);
        $quantity = $request->quantity;
        if($quantity >0){
            $cart->quantity= $quantity;
            $cart->total_price= $cart->price*$request->quantity;
            $cart ->save();
        } else{
            $cart->delete();
        }
        
        return redirect()->back();
    }

    public function delete_cart($id){
        $cart=cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

}
