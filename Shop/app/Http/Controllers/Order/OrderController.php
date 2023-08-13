<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_detail;   


class OrderController extends Controller
{
    public function order(){
        $order = Order::all();
        return view('admin.order', compact('order'));
    }

    public function delete_order($id){
        $order = order::find($id);
        $order_id = $order -> id;

        $order_detail = Order_detail::where('order_id', $order_id);
        $order_detail->delete();
        $order ->delete();

        return redirect()->back()->with('message', 'Order deleted successfully');
    }

    public function delivered( $id){
        $order = order::find($id);
        
        $order->delivery_status = "Delivered";
        $order->payment_status = "Paid";
        $order->save();
        return redirect()->back()->with('message', 'Order delivered successfully');
    }
}
