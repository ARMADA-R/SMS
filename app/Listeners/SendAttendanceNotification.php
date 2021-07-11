<?php

namespace App\Listeners;

use App\Events\AttendanceRegistered;
use App\Jobs\SendStudentsAttendanceNotification;
use App\Jobs\SendUserNotification;
use App\Models\User;
use App\Notifications\broadcastNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendAttendanceNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AttendanceRegistered  $event
     * @return void
     */
    public function handle(AttendanceRegistered $event)
    {
        $studentId = $event->studentId;
        $user = User::select('users.*')
        ->join('students', 'users.id', '=', 'students.user_id')
        ->where('students.id', $studentId)
        ->get()->first();
        
        if ($user) {
            dispatch((new SendStudentsAttendanceNotification($user)));
        }
    }
}
