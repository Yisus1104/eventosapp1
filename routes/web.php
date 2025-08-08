<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('mainp');
Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');
Route::view('/nosotros', 'nosotros')->name('nosotros');
Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::view('/contacto', 'contacto')->name('contacto'); // Cambia a minúsculas
Route::post('/contacto/enviar', [ContactController::class, 'sendEmail'])->name('contact.send');

Route::view('/error', 'Error')->name('error');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Ruta de eventos
    Route::get('/eventos', [EventoController::class, 'index'])->name('eventos');

    // Rutas de reservaciones
    Route::post('/reservaciones', [ReservacionController::class, 'store'])->name('reservaciones.store');
    Route::get('/mis-reservaciones', [ReservacionController::class, 'misReservaciones'])->name('mis-reservaciones');
    Route::put('/reservaciones/{id}', [ReservacionController::class, 'update'])->name('reservaciones.update');
    Route::get('/verificar-disponibilidad', [ReservacionController::class, 'verificarDisponibilidad'])->name('verificar-disponibilidad');

    // Rutas solo para administradores
    Route::middleware(['role:admin'])->group(function () {
        // CRUD de eventos
        Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
        Route::put('/eventos/{id}', [EventoController::class, 'update'])->name('eventos.update');
        Route::delete('/eventos/{id}', [EventoController::class, 'destroy'])->name('eventos.destroy');

        // Administración de reservaciones
        Route::get('reservaciones', [ReservacionController::class, 'todasReservaciones'])->name('reservaciones');

        Route::get('/usuarios', [LoginController::class, 'indexUsuarios'])->name('usuarios');
        Route::post('/usuarios', [LoginController::class, 'storeUsuario'])->name('usuarios.store');
        Route::put('/usuarios/{id}', [LoginController::class, 'updateUsuario'])->name('usuarios.update');
        Route::delete('/usuarios/{id}', [LoginController::class, 'destroyUsuario'])->name('usuarios.destroy');
    });
});