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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id('id_pago');
            $table->foreignId('id_cita')
                ->constrained('citas', 'id_cita')
                ->onDelete('cascade');
            $table->foreignId('id_usuario')
                ->constrained('usuarios', 'id_usuario')
                ->onDelete('cascade');
            $table->decimal('monto', 8, 2);
            $table->string('tipo_pago', 28);
            $table->string('metodo_pago', 20);
            $table->string('estatus_pago', 20);
            $table->string('transaccion_externa_id', 20)->nullable();
            $table->boolean('comprobante_valido')->default(false);
            $table->string('comprobante_imagen_url', 255)->nullable();
            $table->dateTime('fecha_pago');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};