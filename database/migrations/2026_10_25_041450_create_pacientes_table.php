<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id('id_paciente'); // Llave primaria
            $table->unsignedBigInteger('id_tutor_usuario'); // Llave foránea que conecta con el tutor
            
            // Datos del paciente
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable(); // Opcional
            $table->date('fecha_nacimiento');
            $table->integer('edad')->nullable();
            $table->string('escolaridad')->nullable();
            $table->string('grado')->nullable();
            $table->string('parentesco_tutor')->nullable();
            
            $table->timestamps();

            // Definición de la relación con la tabla usuarios (el tutor)
            $table->foreign('id_tutor_usuario')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};