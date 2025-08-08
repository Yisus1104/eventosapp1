<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Verificar si el rol del usuario está en la lista de roles permitidos
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }
        
        // Si no tiene el rol adecuado, mostrar la página de error personalizada
        return response()->view('Error', [], 403);
    }
}