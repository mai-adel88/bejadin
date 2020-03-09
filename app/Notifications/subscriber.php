<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class subscriber extends Notification implements ShouldQueue
{
    use Queueable;
    public $id,$name_en,$name_ar,$created;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id,$name_ar,$name_en,$created)
    {
        $this->id = $id;
        $this->name_en = $name_en;
        $this->name_ar = $name_ar;
        $this->created = $created;
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
            'id' => $this->id,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'created' => $this->created,
        ];
    }
}
