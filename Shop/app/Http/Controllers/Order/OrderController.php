<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_detail;   
use PDF;
use App\Http\Controllers\HomeController;


class OrderController extends Controller
{
    protected $homeController;
    public function __construct(HomeController $homeController)
    {
        $this->middleware('auth');
        $this->middleware('checkPermission');
        $this->homeController = $homeController;
    }
    
    public function order(){
        $order = Order::orderBy('created_at', 'DESC')->get();
        $total_feedback = $this->homeController->total_feedback();
        $messages= $this->homeController->message();

        return view('admin.order', compact('order','total_feedback','messages'));
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

        $total_feedback = $this->homeController->total_feedback();
        $messages= $this->homeController->message();
            
        return view('admin.order_detail', compact('orderId', 'itemList','total_feedback','messages'));
    }

    public function print_pdf($id){
        $order = order::find($id);
        $order_detail = Order_detail::leftJoin('products', 'products.id', '=', 'order_details.product_id')
        ->where('order_details.order_id', $order->id)
        ->select('order_details.*', 'products.title', 'products.image')
        ->get();
        $name = $order->name;

        $pdf = PDF::loadView('admin.pdf',compact('order','order_detail'));

        return $pdf->download('Order-'.$order->id.'.pdf');
    }

    public function searchOrder(Request $request){
        $searchText = $request->search;
        $total_feedback = $this->homeController->total_feedback();
        $messages= $this->homeController->message();

        $order = order::where('name', 'LIKE',"%$searchText%")->orwhere('email', 'LIKE',"%$searchText%")
                    ->orwhere('phone', 'LIKE',"%$searchText%")->orwhere('address', 'LIKE',"%$searchText%")
                    ->orwhere('payment_status', 'LIKE',"%$searchText%")
                    ->orwhere('delivery_status', 'LIKE',"%$searchText%")->get();

        return view('admin.order',compact('order','total_feedback','messages'));
    }
}
