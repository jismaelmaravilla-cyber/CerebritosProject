<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('citas', function (Blueprint $table) {
        $table->unsignedBigInteger('id_paciente')->after('id_horario');
    });
}

public function down()
{
    Schema::table('citas', function (Blueprint $table) {
        $table->dropColumn('id_paciente');
    });
}
};