<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EventAlert extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $EventAlert_title,$EventAlert_time,$EventAlert_location,$EventAlert_id;
    public function __construct($EventAlert_title,$EventAlert_time,$EventAlert_location,$EventAlert_id)
    {
        $this->EventAlert_title=$EventAlert_title;
        $this->EventAlert_time=$EventAlert_time;
        $this->EventAlert_location=$EventAlert_location;
        $this->EventAlert_id=$EventAlert_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'EventAlert_title'=>$this->EventAlert_title,
            'EventAlert_time'=>$this->EventAlert_time,
            'EventAlert_location'=>$this->EventAlert_location,
            'EventAlert_id'=>$this->EventAlert_id,
        ];
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

        ];
    }
}
