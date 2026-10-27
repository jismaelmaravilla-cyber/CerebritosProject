<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id(id_cita);
            $table->foreignId("id_usuario")
            ->constrained("usuarios", "id_usuario")
            ->onDelete("cascade");
            $table->foreingId("id_horario")
            ->contrained("horarios_disponibles", "id_horario");
            $table->string("origen");
            $tbale->date("fecha_cita");
            $table->time("hora_inicio");
            $table->time("hora_fin");
            $table->decimal("costo_total", 8,2);
            $table->decimal("monto_anticipo", 8,2);
            $table->decimal("saldo_pendiente" 8,2);
            $table->string("estado_cita");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }z
};
