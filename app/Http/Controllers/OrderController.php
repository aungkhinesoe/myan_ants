<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = new Order();
        $order->service_id = $request->service_id;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;

        $order->date = $request->date;
        
        $order->save();

        return redirect()->back()->with('success', 'Order placed successfully!');
    }
}
