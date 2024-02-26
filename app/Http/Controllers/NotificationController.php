<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function list(): View
    {
        $notifications = Notification::query()->where('user_id', backpack_user()->id)->orderBy('created_at', 'DESC')->get();

        return view('history', [
            'notifications' => $notifications
        ]);
    }
}
