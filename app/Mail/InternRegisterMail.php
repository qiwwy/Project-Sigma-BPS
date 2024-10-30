<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\InternRegister;

class InternRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $internRegister;

    /**
     * Create a new message instance.
     */
    public function __construct(InternRegister $internRegister)
    {
        $this->internRegister = $internRegister;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Intern Register Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.intern_register_mail',
            with:[
                'name'=> $this->internRegister->name,
                'token'=> $this->internRegister->token
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
