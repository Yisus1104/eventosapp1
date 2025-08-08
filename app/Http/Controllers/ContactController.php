<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

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
            Mail::to('laravelpagina@gmail.com')->send(new ContactMail($data));
            return back()->with('success', 'Correo enviado correctamente...');
        } catch (\Exception $e) {
            
            dd($e->getMessage()); 
            return back()->with('error', 'Hubo un error al enviar el correo: ' . $e->getMessage());
        }
    }
    
}
