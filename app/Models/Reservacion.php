<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservacion extends Model
{
    use HasFactory;

    protected $table = 'reservaciones';
    
    protected $fillable = [
        'user_id',
        'evento_id',
        'fecha_reserva',
        'hora_inicio',
        'hora_fin',
        'estado',
        'notas'
    ];
    
    // Mutator para formatear la fecha al guardarse
    public function setFechaReservaAttribute($value)
    {
        $this->attributes['fecha_reserva'] = Carbon::parse($value)->format('Y-m-d');
    }
    
    // Comprueba si la reserva se solapa con otra existente
    public function seSolapaConExistente()
    {
        return Reservacion::where('evento_id', $this->evento_id)
            ->where('fecha_reserva', $this->fecha_reserva)
            ->where('id', '!=', $this->id)
            ->where('estado', '!=', 'cancelada')
            ->where(function($query) {
                $query->where(function($q) {
                    // Hora inicio está entre inicio y fin de otra reserva
                    $q->where('hora_inicio', '<=', $this->hora_inicio)
                      ->where('hora_fin', '>', $this->hora_inicio);
                })->orWhere(function($q) {
                    // Hora fin está entre inicio y fin de otra reserva
                    $q->where('hora_inicio', '<', $this->hora_fin)
                      ->where('hora_fin', '>=', $this->hora_fin);
                })->orWhere(function($q) {
                    // Nueva reserva engloba una existente
                    $q->where('hora_inicio', '>=', $this->hora_inicio)
                      ->where('hora_fin', '<=', $this->hora_fin);
                });
            })
            ->exists();
    }
    
    // Accessor para mostrar estado formateado
    public function getEstadoFormateadoAttribute()
    {
        $estados = [
            'pendiente' => 'Pendiente',
            'confirmada' => 'Confirmada',
            'cancelada' => 'Cancelada',
            'completada' => 'Completada'
        ];
        
        return $estados[$this->estado] ?? ucfirst($this->estado);
    }
    
    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}