<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;


class SendPasswordUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $usuario;
    public $password;
    public $name;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $usuario, $password, $name)
    {
        $this->email = $email;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME')),
            subject: 'AVISO DE CREDENCIALES'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.enviar-credenciales',
            with: [
                'usuario' => $this->usuario,
                'password' => $this->password,
                'name' => $this->name
            ],
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
