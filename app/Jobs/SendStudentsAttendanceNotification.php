<?php

namespace App\Jobs;

use App\Notifications\AbsenceAttendanceNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendStudentsAttendanceNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $url;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $url = '/')
    {
        $this->user = $user;
        $this->url = $url;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send($this->user, new AbsenceAttendanceNotification());
    }
}
