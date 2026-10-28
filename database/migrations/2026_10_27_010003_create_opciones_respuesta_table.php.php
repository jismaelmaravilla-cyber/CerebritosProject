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
            $table->timestamps();

            $table->foreign('id_pregunta')->references('id_pregunta')->on('preguntas')->onDelete('cascade');
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
