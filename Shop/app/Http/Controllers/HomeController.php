<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Feedback;
use App\Models\Comment;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Stripe;

use Notification;
use App\Notifications\SendEmailNotification;


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
        $products = Product::where('deleted', 0)->paginate(6);

        $cartNum = $this->getCartNum();
        return view('frontend.all_product',compact('products','cartNum'));
   }

    //show product details
    public function product_details($id){
        $product = Product::find($id);
        $productList = Product::where('deleted', 0)
                        ->orderBy('created_at', 'asc')
                        ->paginate(3);

        $cartNum = $this->getCartNum();
        $comment = Comment::leftjoin('users','users.id','=','comments.user_id')
                        ->where('product_id', $id)
                        ->orderby('id', 'desc')
                        ->select('users.image','comments.*')->get();
        return view('frontend.product_details', compact('product', 'productList','cartNum','comment'));
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

                Alert::success('Product added successfully', 'We have added product to cart');

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

                Alert::success('Product added successfully', 'We have added product to cart');

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

    //payment cash
    public function cash_order(Request $request) {
        $user = Auth::user();
        $userId = $user->id;
    
        $cartItems = cart::where('user_id', '=', $userId)->get();
    
        $totalMoney = 0;
        foreach ($cartItems as $cartItem) {
            $totalMoney += $cartItem->total_price;
        }
        if($totalMoney>0){
            $order = new Order();
            $order->name = $request->name;
            $order->email = $user->email;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->user_id = $userId;
            $order->total_money = $totalMoney;
            $order->payment_status = 'Cash';
            $order->delivery_status = 'processing';
            $order->save();
        
            foreach ($cartItems as $cartItem) {
                $orderDetail = new Order_detail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $cartItem->product_id;
                $orderDetail->price = $cartItem->price;
                $orderDetail->num = $cartItem->quantity;
                $orderDetail->total_money = $cartItem->total_price;
                $orderDetail->save();
            }
            $detail=[
                'greeting'=>$request->greeting,
                'firstline'=>$request->firstline,
                'body'=>$request->body,
                'button' => $request->button,
                'lastline'=>$request->lastline,
                'url'=>$request->url,
            ];
            Notification::send($cartItems, new SendEmailNotification($detail));
             // Xóa giỏ hàng của người dùng sau khi đã đặt hàng
            cart::where('user_id', '=', $userId)->delete();
            Alert::success('Payment Successfully', 'You have successfully paid, your order will be delivered as soon as possible');
        } else{
            Alert::warning('Warning', 'The shopping cart is empty. Please add products to cart');
        }
        return redirect()->back();
    }

    //order
    public function show_order(){

        if(Auth::id()){
   
           $user = Auth::user();
           $userid = $user->id;
           $cartNum = $this->getCartNum();

           $order= Order_detail::leftJoin('products', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.user_id', $userid)
            ->where('order_details.deleted',0)
            ->select('order_details.*', 'products.title', 'products.image', 'orders.*')
            ->get();
           return view('frontend.order',compact('order', 'cartNum'));
        } else{
   
           return redirect('login');
        }
    }

    public function cancel_order($id){
        $order = order::find($id);
        $order -> delivery_status = 'Cancelled';
        $order->save();
        return redirect()->back()->with('message', 'Order cancelled successfully');;
   }    

   public function delete_orders($id){
    $order = order::find($id);
    $order_id = $order -> id;

    $order_details = Order_detail::where('order_id', $order_id)->get();

    foreach ($order_details as $detail) {
        $detail->deleted = 1;
        $detail->save();
    }

    return redirect()->back()->with('message', 'Order deleted successfully');
    
   }

   public function stripe($totalmoney){
    $cartNum = $this->getCartNum();

    return view('frontend.stripe', compact('totalmoney','cartNum'));
    }   

    public function stripePost(Request $request, $totalmoney)
    {

        $user=Auth::user();

        $userId=$user->id;

        $cartItems = cart::where('user_id', '=', $userId)->get();
    
        $totalMoney = 0;
        foreach ($cartItems as $cartItem) {
            $totalMoney += $cartItem->total_price;
        }

        if($totalMoney>0){
            $amount = (int) ($totalmoney * 100 / 23000);
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
            Stripe\Charge::create ([
                    "amount" => $amount,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "Thank for payment." 
            ]);

            $order = new Order();
            $order->name = $user->name;
            $order->email = $user->email;
            $order->phone = $user->phone;
            $order->address = $user->address;
            $order->user_id = $userId;
            $order->total_money = $totalMoney;
            $order->payment_status= 'Paid';
            $order->delivery_status= 'processing';
            $order->save();

            foreach ($cartItems as $cartItem) {
                $orderDetail = new Order_detail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $cartItem->product_id;
                $orderDetail->price = $cartItem->price;
                $orderDetail->num = $cartItem->quantity;
                $orderDetail->total_money = $cartItem->total_price;
                $orderDetail->save();
            }
            $detail=[
                'greeting'=>$request->greeting,
                'firstline'=>$request->firstline,
                'body'=>$request->body,
                'button' => $request->button,
                'lastline'=>$request->lastline,
                'url'=>$request->url,
            ];
            Notification::send($cartItems, new SendEmailNotification($detail));
        
            // Xóa giỏ hàng của người dùng sau khi đã đặt hàng
            cart::where('user_id', '=', $userId)->delete();
            Alert::success('Payment Successfully', 'You have successfully paid, your order will be delivered as soon as possible');
            Session::flash('success', 'Payment successful!');
        } else{
            Alert::warning('Warning', 'The shopping cart is empty. Please add products to cart');
        }
              
        return back();
    }

    public function contact(){
        if(Auth::id()){
            $data = feedback::all();
            $cartNum = $this->getCartNum();
            return view('frontend.contact', compact('data','cartNum'));
        }else{
            return redirect('login');
        }

        $data = feedback::all();
        return view('frontend.contact', compact('data'));
    }

    public function add_feedback(Request $request){
        if(Auth::id()){
            $data = new Feedback();
            $data ->fullname =$request->fullname;
            $data ->email =$request->email;
            $data ->phone =$request->phone;
            $data ->subject_name =$request->subject_name;
            $data ->note =$request->note;
    
            $data->save();
            Alert::success('Contact Successfully', 'Thank you for contacting us. We will reply as soon as possible.');
    
            return redirect()->back();
        } else{
            return redirect('login');
        }
    }

    public function view_profile($id){
        $user = user::find($id);
        $cartNum = $this->getCartNum();
        return view('frontend.profile', compact('user','cartNum'));
   }

   public function edit_profile(Request $request){
    $userId = Auth::id();
        $user = User::find($userId);
        $user->name = $request->name;
        $user->image = $request->image;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            if ($request->has('password') && $request->password !== '') {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            Alert::success('Update successfully', 'You updated your profile!!!');
        return redirect()->back();
   }

   public function product_search(Request $request){
        $search = $request->search;
        $cartNum = $this->getCartNum();
        $products = product::leftjoin('categories','categories.id','=','products.category_id')
                ->where('deleted',0)
                ->where('products.title', 'like', "%$search%")->orwhere('categories.name', 'like', "%$search%")
                ->paginate(9);

        return view('frontend.userpage', compact('products','cartNum'));
    }

    public function search_product(Request $request){
        $search = $request->search;
        $cartNum = $this->getCartNum();
        $products = product::leftjoin('categories','categories.id','=','products.category_id')
                    ->where('deleted',0)
                    ->where('products.title', 'like', "%$search%")->orwhere('categories.name', 'like', "%$search%")
                    ->paginate(9);
        
        return view('frontend.all_product', compact('products','cartNum'));
    }

    public function add_comment(Request $request, $id){
        if(Auth::id()){
            $comment = new Comment();
            $comment->name= Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment=$request->comment;
            $comment->product_id = $id;
            $comment->save();
    
            return redirect()->back();
    
        } else{
    
            return redirect('login');
        }
    }
}
