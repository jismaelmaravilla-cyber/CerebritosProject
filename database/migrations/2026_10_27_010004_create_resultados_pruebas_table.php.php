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
            $table->integer('puntaje_total')->nullable();
            $table->text('disclaimer_prediagnostico');
            $table->text('observaciones_preliminares')->nullable();
            $table->boolean('completada')->default(0);
            $table->dateTime('fecha_aplicacion');
            

            $table->timestamps();

            $table->foreign('id_prueba')->references('id_prueba')->on('pruebas')->onDelete('cascade');


           
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
