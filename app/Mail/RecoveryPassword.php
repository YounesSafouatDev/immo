<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecoveryPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $password ;
    protected $nomComplet;
    public function __construct($password,$nomComplet)
    {
        $this->password = $password;
        $this->nomComplet = $nomComplet;
        $this->subject = "La Récupération de Mot de Passe";
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'auth.recoveryPassword',
            with: ['password' => $this->password, 'nomComplet'=>$this->nomComplet ]
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
