<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AccountExpiration extends Notification implements ShouldQueue
{
    use Queueable;
    public $name_ar,$name_en,$end;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name_ar,$name_en,$end)
    {
        $this->name_en = $name_en;
        $this->name_ar = $name_ar;
        $this->end = $end;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'end' => $this->end,
        ];
    }
}
