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
        Schema::create('usuarios', function (Blueprint $table) {
          $table->integer('id_usuario')->primary();
            $table->unsignedInteger('id_rol');
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('telefono', 20);
            $table->string('contraseña_hash', 100);
            $table->date('fecha_registro');
            $table->boolean('estatus')->default(1);

           
            $table->foreign('id_rol', 'fk_Usuarios_Roles')
                  ->references('id_rol')
                  ->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
