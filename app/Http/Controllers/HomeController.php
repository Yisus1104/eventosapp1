<?php
namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener 3 eventos populares (puedes ajustar la lógica de "popular" según tus necesidades)
        // Por ejemplo, podrías ordenarlos por número de reservaciones, por precio, etc.
        $eventosPopulares = Evento::latest()->take(3)->get();
        
        return view('home', compact('eventosPopulares'));
    }
}