<?php
namespace App\Http\Controllers;
use App\Models\Reservacion;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservacionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'fecha_reserva' => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'notas' => 'nullable|string',
        ]);

        // Verificar capacidad disponible del evento
        $evento = Evento::findOrFail($request->evento_id);
        
        // Contar reservaciones confirmadas o pendientes para ese evento y fecha
        $reservacionesExistentes = Reservacion::where('evento_id', $request->evento_id)
            ->where('fecha_reserva', $request->fecha_reserva)
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->count();
            
        if ($reservacionesExistentes >= $evento->capacidad) {
            return back()->with('error', 'Lo sentimos, el evento ha alcanzado su capacidad máxima para esta fecha.');
        }

        // Verificar si ya existe una reservación para ese evento y fecha/hora que se solape
        $reservacionSolapada = Reservacion::where('evento_id', $request->evento_id)
            ->where('fecha_reserva', $request->fecha_reserva)
            ->where('estado', '!=', 'cancelada')
            ->where(function($query) use ($request) {
                $query->where(function($q) use ($request) {
                    // Hora inicio está entre inicio y fin de otra reserva
                    $q->where('hora_inicio', '<=', $request->hora_inicio)
                      ->where('hora_fin', '>', $request->hora_inicio);
                })->orWhere(function($q) use ($request) {
                    // Hora fin está entre inicio y fin de otra reserva
                    $q->where('hora_inicio', '<', $request->hora_fin)
                      ->where('hora_fin', '>=', $request->hora_fin);
                })->orWhere(function($q) use ($request) {
                    // Nueva reserva engloba una existente
                    $q->where('hora_inicio', '>=', $request->hora_inicio)
                      ->where('hora_fin', '<=', $request->hora_fin);
                });
            })
            ->exists();

        if ($reservacionSolapada) {
            return back()->with('error', 'El evento ya está reservado para la fecha y horario seleccionados. Por favor, elige otro horario.');
        }

        $reservacion = new Reservacion();
        $reservacion->user_id = Auth::id();
        $reservacion->evento_id = $request->evento_id;
        $reservacion->fecha_reserva = $request->fecha_reserva;
        $reservacion->hora_inicio = $request->hora_inicio;
        $reservacion->hora_fin = $request->hora_fin;
        $reservacion->notas = $request->notas;
        $reservacion->estado = 'pendiente';
        $reservacion->save();

        return redirect()->route('mis-reservaciones')->with('success', 'Reservación creada exitosamente. Espera la confirmación del administrador.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,cancelada,completada',
        ]);
    
        $reservacion = Reservacion::findOrFail($id);
        
        // Verificar si el usuario actual es administrador directamente
        $user = Auth::user();
        
        // Si el usuario no es admin, solo puede cancelar sus propias reservas
        if ($user->role !== 'admin') {
            if (Auth::id() != $reservacion->user_id) {
                return redirect()->back()->with('error', 'No tienes permiso para modificar esta reservación.');
            }
            if ($request->estado != 'cancelada') {
                return redirect()->back()->with('error', 'Solo puedes cancelar tus reservaciones.');
            }
        }
        
        $reservacion->estado = $request->estado;
        $reservacion->save();
    
        $mensaje = 'Estado de reservación actualizado a ' . ucfirst($request->estado) . '.';
        return redirect()->back()->with('success', $mensaje);
    }
    
    public function misReservaciones(Request $request)
    {
        $query = Reservacion::where('user_id', Auth::id())
            ->with('evento');
        
        // Aplicar filtros
        if ($request->has('estado') && $request->estado) {
            $query->where('estado', $request->estado);
        }
        
        if ($request->has('fecha') && $request->fecha) {
            $query->where('fecha_reserva', $request->fecha);
        }
        
        $reservaciones = $query->orderBy('fecha_reserva', 'desc')
            ->paginate(10);

        return view('reservas', compact('reservaciones'));
    }

    public function todasReservaciones(Request $request)
    {
        // Solo los administradores pueden ver todas las reservaciones
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('mis-reservaciones');
        }
    
        $query = Reservacion::with(['evento', 'user']);
        
        // Aplicar filtros
        if ($request->has('estado') && $request->estado) {
            $query->where('estado', $request->estado);
        }
        
        if ($request->has('fecha_desde') && $request->fecha_desde) {
            $query->where('fecha_reserva', '>=', $request->fecha_desde);
        }
        
        if ($request->has('fecha_hasta') && $request->fecha_hasta) {
            $query->where('fecha_reserva', '<=', $request->fecha_hasta);
        }
        
        $reservaciones = $query->orderBy('fecha_reserva', 'desc')
            ->paginate(15);
    
        return view('reservas', compact('reservaciones'));
    }
    
    // Método para ver la disponibilidad de un evento
    public function verificarDisponibilidad(Request $request)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'fecha' => 'required|date|after_or_equal:today',
        ]);
        
        $evento = Evento::findOrFail($request->evento_id);
        
        // Obtener reservaciones para esa fecha
        $reservaciones = Reservacion::where('evento_id', $request->evento_id)
            ->where('fecha_reserva', $request->fecha)
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->get();
            
        $horasReservadas = [];
        
        foreach ($reservaciones as $reserva) {
            $inicio = Carbon::parse($reserva->hora_inicio);
            $fin = Carbon::parse($reserva->hora_fin);
            
            while ($inicio->lt($fin)) {
                $horasReservadas[] = $inicio->format('H:i');
                $inicio->addMinutes(30);
            }
        }
        
        return response()->json([
            'evento' => $evento->nombre,
            'fecha' => $request->fecha,
            'horas_reservadas' => $horasReservadas,
            'capacidad_total' => $evento->capacidad,
            'reservas_actuales' => count($reservaciones),
        ]);
    }
}