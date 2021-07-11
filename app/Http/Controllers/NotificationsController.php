<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{

    // public function __construct()
    // {
    //     //
    // }

    //
    public static function attachNotificationToView(Type $var = null)
    {
        if (Auth::guard()->check()) {
            $userNotifications = Notification::where('notifiable_id', Auth::guard()->user()->id)->get();

            // dd($userNotifications);
            view()->share('notifications', $userNotifications);
        }
    }


    public function getUserNotifications($limit = 10)
    {

        $userNotificationsNumber = Notification::where('read_at', null)->where('notifiable_id', $this->user())->count();

        $userNotifications = Notification::where('notifiable_id',  $this->user())
            ->orderBy('created_at', 'desc')->limit($limit)
            ->paginate($limit);
            // dd($userNotifications);
            return response()->json([
                'userNotifications' => $userNotifications,
                'unreadNotificationsNumber' => $userNotificationsNumber,
            ]);
    }

    public function markAllAsRead()
    {
        $res = Notification::where('notifiable_id', $this->user()) ->update(['read_at' => Carbon::now()->toDateTimeString()]);
        return response()->json();
    }


    public function getAllNotifications()
    {
        $userNotificationsNumber = Notification::where('read_at', null)->where('notifiable_id', $this->user())->count();

        $userNotifications = Notification::where('notifiable_id',  $this->user())
            ->orderBy('created_at', 'desc')->limit(9)
            ->get();
            // dd($userNotifications[0]->created_at, json_decode($userNotifications[0], true)['created_at']);
            return response()->json([
                'userNotifications' => $userNotifications,
                'unreadNotificationsNumber' => $userNotificationsNumber,
            ]);
    }



    function user()
    {
        return Auth::guard()->user()->id;
    }
}
