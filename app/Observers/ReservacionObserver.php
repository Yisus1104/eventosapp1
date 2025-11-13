<?php
namespace App\Observers;

use App\Models\Reservacion;
use App\Services\NotificationService;

class ReservacionObserver
{
    public function updated(Reservacion $reservacion)
    {
        if ($reservacion->isDirty('estado') && $reservacion->estado === 'confirmada') {
            $user = $reservacion->user;
            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'message' => "Tu reservación para {$reservacion->evento->nombre} ha sido confirmada."
            ];
            
            NotificationService::getInstance()->sendContactEmail($data);
        }
    }
}
