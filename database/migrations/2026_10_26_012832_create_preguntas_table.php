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
        Schema::create('preguntas', function (Blueprint $table) {
           $table->id('id_pregunta');
            $table->unsignedBigInteger('id_prueba');
            $table->text('texto_pregunta');

            
            $table->foreign('id_prueba', 'fk_Preguntas_Pruebas')
                  ->references('id_prueba')
                  ->on('pruebas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas');
    }
};
