<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordNotification extends Mailable
{
    use Queueable, SerializesModels;
    public array $content;

    public function __construct(array $content) {
        $this->content = $content;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->content['subject'],
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.forgetPassword',
            with: [
                'token' => $this->content['token'],
                'email' => $this->content['email'],
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
