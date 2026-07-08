<?php

namespace App\Http\Controllers;

use App\Models\UserNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = UserNotification::where('user_id', auth()->id())->latest()->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    public function markRead(UserNotification $notification)
    {
        abort_if($notification->user_id !== auth()->id(), 403);
        $notification->update(['is_read' => true]);
        return response()->json(['status' => 'ok']);
    }

    public function markAllRead()
    {
        UserNotification::where('user_id', auth()->id())->where('is_read', false)->update(['is_read' => true]);
        return redirect()->route('notifications.index')->with('success', 'Semua notifikasi ditandai sudah dibaca');
    }
}
