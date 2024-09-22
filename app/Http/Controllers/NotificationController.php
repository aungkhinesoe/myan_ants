<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        if (Auth::check()) {
            $notification = Auth::user()->notifications()->find($id);

            if ($notification) {
                $notification->delete(); // Delete the notification
                return redirect()->back();
            }
        }

        return redirect()->back()->with('error', 'Notification not found or user not authenticated.');
    }

    public function getNotifications()
    {
        if (Auth::check()) {
            $notifications = Auth::user()->notifications()->where('read_at', null)->get();
            return response()->json($notifications);
        }

    return response()->json([]);
    }

    public function getCount()
{
    if (Auth::check()) {
        $count = Auth::user()->notifications()->where('read_at', null)->count();
        return response()->json(['count' => $count]);
    }

    return response()->json(['count' => 0]);
}

}
