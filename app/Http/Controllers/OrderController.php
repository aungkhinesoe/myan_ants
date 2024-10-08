<?php

namespace App\Http\Controllers;

use App\Events\NewOrderCreated;
use App\Events\NotificationEvent;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function confirm_order(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'service_id' => 'required|exists:services,id', // Ensure service ID exists
        ]);

        // Create the new order
        $order = new Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->user_id = Auth::id(); // Get the logged-in user ID
        $order->service_id = $request->service_id; // Passed from the form

        // Save the order to the database
        $order->save();

        // Log::info("'Order created:', ['order' => $order]");

        // Broadcast the event to notify the admin
        // broadcast(new NewOrderCreated($order))->toOthers();

        // Notify admin users
        $adminUsers = User::where('usertype', 'admin')->get();
        Notification::send($adminUsers, new NewOrderNotification($order));

        // Return a JSON response for the AJAX call
        // return response()->json(['message' => 'Your order has been successfully placed!']);

        return redirect()->back()->with('success', 'Your order has been successfully placed!');

    }

    public function view_orders()
    {
        $orders = Order::all();

        return view('admin.orders' ,compact('orders'));
    }

    public function my_orders()
    {
    $orders = Order::where('user_id', Auth::id())->get();
    return view('home.order', compact('orders'));
    }


}
