<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvoicePaid extends Notification implements ShouldQueue
{
    use Queueable;
    public $name_en,$price,$name_ar,$status,$invoice;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name_en,$name_ar,$price,$status,$invoice)
    {
        $this->name_en = $name_en;
        $this->name_ar = $name_ar;
        $this->price = $price;
        $this->status = $status;
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {


        return (new MailMessage)->markdown('emails.invoice',['name_en'=>$this->name_en,'name_ar'=>$this->name_ar,'invoice'=>$this->invoice]);
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
            'price' => $this->price,
            'status' => $this->status,
            'invoice' => $this->invoice,
        ];
    }
}
