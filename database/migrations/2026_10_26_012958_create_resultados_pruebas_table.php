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
        $table->unsignedBigInteger('id_paciente')->nullable();
        $table->unsignedBigInteger('id_prueba');
        $table->integer('puntaje_total')->default(0);
        $table->text('disclaimer_prediagnostico')->nullable();
        $table->text('observaciones_preliminares')->nullable();
        $table->boolean('completada')->default(1);
        $table->timestamp('fecha_aplicacion')->nullable();
        $table->timestamps();
        
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
