<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TransformExpired extends Notification implements ShouldQueue
{
    use Queueable;
    public $fid,$branche,$bus,$date,$schedule,$today;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($fid,$branche,$bus,$date,$schedule,$today)
    {
        $this->fid = $fid;
        $this->branche = $branche;
        $this->bus = $bus;
        $this->date = $date;
        $this->schedule = $schedule;
        $this->today = $today;
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
            'fid'=>$this->fid,
            'branche'=>$this->branche,
            'bus'=>$this->bus,
            'date'=>$this->date,
            'schedule'=>$this->schedule,
            'today'=>$this->today
        ];
    }
}
