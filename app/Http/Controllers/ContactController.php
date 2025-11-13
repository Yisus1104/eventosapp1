<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotificationService;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        try {
            // Usando el Singleton
            NotificationService::getInstance()->sendContactEmail($data);
            return back()->with('success', 'Correo enviado correctamente...');
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al enviar el correo: ' . $e->getMessage());
        }
    }
}
