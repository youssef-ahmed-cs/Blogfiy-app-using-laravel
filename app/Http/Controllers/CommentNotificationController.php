<?php

namespace App\Http\Controllers;

use App\Notifications\CommentNotification;
use Illuminate\Http\Request;

class CommentNotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $notifications = $user->notifications()->get();
        return view('notifications.index', ['notifications' => $notifications]);
    }
}
