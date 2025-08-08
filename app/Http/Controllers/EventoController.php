<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');
        
        if ($busqueda) {
            $eventos = Evento::where('nombre', 'like', "%$busqueda%")
                ->orWhere('descripcion', 'like', "%$busqueda%")
                ->paginate(9);
        } else {
            $eventos = Evento::paginate(9);
        }
        
        return view('eventos', compact('eventos'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:1',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $evento = new Evento($request->except('imagen'));
        
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('eventos', 'public');
            $evento->imagen = $imagenPath;
        }
        
        $evento->save();
        
        return redirect()->route('eventos')->with('success', 'Evento creado exitosamente.');
    }
    
    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);
        
        
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('eventos')->with('error', 'No tienes permisos para editar este evento.');
        }
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:1',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $evento->fill($request->except('imagen'));
    
        if ($request->hasFile('imagen')) {
            if ($evento->imagen) {
                Storage::disk('public')->delete($evento->imagen);
            }
    
            $imagenPath = $request->file('imagen')->store('eventos', 'public');
            $evento->imagen = $imagenPath;
        }
    
        $evento->save();
    
        return redirect()->route('eventos')->with('success', 'Evento actualizado exitosamente.');
    }    
    
    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        
        
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('eventos')->with('error', 'No tienes permisos para eliminar este evento.');
        }
        
        if ($evento->imagen) {
            Storage::disk('public')->delete($evento->imagen);
        }
        
        $evento->delete();
        
        return redirect()->route('eventos')->with('success', 'Evento eliminado exitosamente.');
    }
}