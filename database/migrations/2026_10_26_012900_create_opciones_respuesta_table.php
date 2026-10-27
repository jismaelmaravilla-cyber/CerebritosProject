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
        Schema::create('opciones_respuesta', function (Blueprint $table) {
           $table->id('id_opcion');
            $table->unsignedBigInteger('id_pregunta');
            $table->string('texto_opcion', 200);
            $table->integer('valor_puntos');

            // Llave foránea hacia la tabla preguntas
            $table->foreign('id_pregunta', 'fk_Opciones_Preguntas')
                  ->references('id_pregunta')
                  ->on('preguntas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opciones_respuesta');
    }
};
