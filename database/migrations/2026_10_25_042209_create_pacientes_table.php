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
        Schema::create('pacientes', function (Blueprint $table) {
          $table->id('id_paciente');
            $table->integer('id_tutor_usuario');
            $table->string('nombre', 100);
            $table->string('apellido_paterno', 50);
            $table->string('apellido_materno', 50);
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->string('escolaridad', 50);
            $table->integer('grado');
            $table->string('parentesco_tutor', 50);

           
            $table->foreign('id_tutor_usuario', 'fk_Pacientes_Usuarios')
                  ->references('id_usuario')
                  ->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
