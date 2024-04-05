<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     */

    protected $verificationLink;
    protected $nomComplet;
    public function __construct($verificationLink,$nomComplet)
    {
        $this->verificationLink = $verificationLink;
        $this->nomComplet = $nomComplet;
        $this->subject = "Vérifier Votre E-mail";
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'auth.verifyemail',
            with: ['verificationLink' => $this->verificationLink, 'nomComplet'=>$this->nomComplet]
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
