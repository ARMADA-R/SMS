<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class AbsenceAttendanceNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            'mail',
            'database',
            'broadcast'
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(trans('app.attendance.student.absent-alert'))
            ->line(trans('app.attendance.student.status-registered-as-absent'))
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => '',
            'content' => '',
            'status' => '',
            'URL' => '',
        ];
    }



    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'invoice_id' => '$this->invoice->id',
            'amount' => '$this->invoice->amount',
        ]);
    }

    // /**
    //  * Get the Vonage / SMS representation of the notification.
    //  *
    //  * @param  mixed  $notifiable
    //  * @return NexmoMessage
    //  */
    // public function toNexmo($notifiable)
    // {
    //     return (new NexmoMessage)
    //         ->content('Your SMS message content')
    //         ->from('15554443333');
    // }
}
