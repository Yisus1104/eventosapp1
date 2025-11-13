<?php
namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class NotificationService
{
    private static ?self $instance = null;

    private function __construct() {} // Evitar instanciación directa

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function sendContactEmail(array $data)
    {
        Mail::to('laravelpagina@gmail.com')->send(new ContactMail($data));
    }
}
