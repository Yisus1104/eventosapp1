<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Modificamos el enum existente para incluir el estado "completada"
        // Primero hay que modificar la columna
        Schema::table('reservaciones', function (Blueprint $table) {
            // En MySQL, hay que hacer esto con DB statements
            DB::statement("ALTER TABLE reservaciones MODIFY COLUMN estado ENUM('pendiente', 'confirmada', 'cancelada', 'completada') DEFAULT 'pendiente'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Si necesitamos revertir, volvemos al enum original
        Schema::table('reservaciones', function (Blueprint $table) {
            DB::statement("ALTER TABLE reservaciones MODIFY COLUMN estado ENUM('pendiente', 'confirmada', 'cancelada') DEFAULT 'pendiente'");
        });
    }
};