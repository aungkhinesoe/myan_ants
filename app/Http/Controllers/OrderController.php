<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Send notification to admin(s)
        // $admin = User::where('role', 'admin')->first(); // Assuming you have a role-based system
        // if ($admin) {
        //     $admin->notify(new NewOrderNotification($order));
        // }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your order has been successfully placed!');
    }

    public function view_orders()
    {
        $orders = Order::all();

        return view('admin.orders' ,compact('orders'));
    }
}
