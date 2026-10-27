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
        Schema::create('resultados_pruebas', function (Blueprint $table) {
          $table->id('id_resultado');
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_prueba');
            $table->date('fecha_aplicacion');
            $table->integer('puntaje_total');
            $table->text('interpretacion')->nullable();

           
            $table->foreign('id_paciente', 'fk_Resultados_Pacientes')
                  ->references('id_paciente')
                  ->on('pacientes')
                  ->onDelete('cascade');

            $table->foreign('id_prueba', 'fk_Resultados_Pruebas')
                  ->references('id_prueba')
                  ->on('pruebas')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados_pruebas');
    }
};
