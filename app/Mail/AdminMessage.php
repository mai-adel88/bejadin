<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminMessage extends Mailable
{
    use Queueable, SerializesModels;
    public $email,$subject,$message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$subject,$message)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->markdown('emails.admin')->with('subject',$this->subject)->with('email',$this->email)->with('message',$this->message);
    }
}




