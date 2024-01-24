<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAllAsRead()
    {
        $userId = Auth::id();
        Notification::where('receiver_id', $userId)
            ->where('status', 'unread')
            ->update(['status' => 'read']);

        return response()->json(['success' => true]);
    }

    public function getNotification(Request $request)
    {
        $userId = Auth::id();
        $notify = Notification::where('receiver_id', $userId)->orderBy('created_at', 'desc')->limit(10)->get();
        $unreadCount = $notify->where('status', 'unread')->count();
        return view('admin.notification', compact('notify','unreadCount'))->render();
    }

    public function getUnreadNotificationCount()
    {
        $unreadCount = Notification::where('receiver_id', Auth::user()->id)
            ->where('status', 'unread')
            ->count();

        return response()->json(['unreadCount' => $unreadCount]);
    }
}
