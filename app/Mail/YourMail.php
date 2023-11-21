<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class YourMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $message;

    public function __construct($email, $message)
    {
        $this->email = $email;
        $this->message = $message;
    }

    public function build()
    {
        return $this->view('emails.your-email-template');
    }
}
