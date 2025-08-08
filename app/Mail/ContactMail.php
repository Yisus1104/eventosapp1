<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function envelope()
    {
        return new \Illuminate\Mail\Mailables\Envelope(
            subject: 'Nuevo mensaje de contacto',
            // Usar la dirección configurada en MAIL_FROM_ADDRESS
            // from: $this->data['email'], // Elimina esta línea
            replyTo: [$this->data['email']], // Mantén esta línea para poder responder al usuario
        );
    }
    
    public function content()
    {
        return new \Illuminate\Mail\Mailables\Content(
            view: 'emails.contact', // Asegúrate de crear esta vista
        );
    }
}