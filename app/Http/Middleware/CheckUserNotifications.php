<?php

namespace App\Http\Middleware;

use App\Http\Controllers\NotificationsController;
use App\Models\Notification;
use Closure;
use Illuminate\Http\Request;

class CheckUserNotifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        NotificationsController::attachNotificationToView();
        return $next($request);
    }
}
