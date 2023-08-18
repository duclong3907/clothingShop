<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_detail;   
use PDF;



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

    public function order_detail($id){
        $orderId = order::find($id);

        $order_id = $orderId -> id;


        $created_at = $orderId->created_at->format('Y-m-d H:i:s'); // Định dạng theo ngày-tháng-năm giờ:phút:giây

        $itemList = Order_detail::leftJoin('products', 'products.id', '=', 'order_details.product_id')
            ->where('order_details.order_id', $order_id)
            ->where('order_details.created_at', $created_at)
            ->select('order_details.*', 'products.title', 'products.image')
            ->get();
            
            return view('admin.order_detail', compact('orderId', 'itemList'));
    }

    public function print_pdf($id){
        $order = order::find($id);
        $order_detail = Order_detail::leftJoin('products', 'products.id', '=', 'order_details.product_id')
        ->where('order_details.order_id', $order->id)
        ->select('order_details.*', 'products.title', 'products.image')
        ->get();
        // dd($order_detail);
        $name = $order->name;

        $pdf = PDF::loadView('admin.pdf',compact('order','order_detail'));

        return $pdf->download('Order-'.$order->id.'.pdf');
    }
}
