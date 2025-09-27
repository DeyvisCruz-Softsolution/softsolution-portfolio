<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageData;

    public function __construct(Message $message)
    {
        $this->messageData = $message;
    }

    public function build()
    {
        return $this->subject('📩 Nuevo mensaje desde el portafolio')
            ->view('emails.contact_message');
    }
}
