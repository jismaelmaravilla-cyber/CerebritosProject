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
        Schema::create('expendiente', function (Blueprint $table) {
    $table->id('id_expediente');
    $table->foreignId("id_paciente")
        ->constrained("pacientes", "id_paciente")
        ->onDelete("cascade");
    $table->text("antecedentes")->nullable();
    $table->text("criterios_diagnostico")->nullable();
    $table->text("diagnostico_oficial");
    $table->text("notas_consulta");
    $table->text("plan_tratamiento");
    $table->dateTime("fecha_registro");
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expendiente');
    }
};
