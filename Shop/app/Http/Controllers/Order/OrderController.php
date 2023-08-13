<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    public function order(){
        $order = Order::all();
        return view('admin.order', compact('order'));
    }
}
