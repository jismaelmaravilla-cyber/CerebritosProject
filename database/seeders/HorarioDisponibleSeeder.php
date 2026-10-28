<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorarioDisponibleSeeder extends Seeder
{
    public function run()
    {
        DB::table('horarios_disponibles')->insert([
            ['dia_semana' => 'Jueves', 'hora_inicio' => '10:00:00', 'hora_fin' => '11:00:00', 'status' => 1],
            ['dia_semana' => 'Jueves', 'hora_inicio' => '11:30:00', 'hora_fin' => '12:30:00', 'status' => 1],
            ['dia_semana' => 'Jueves', 'hora_inicio' => '13:00:00', 'hora_fin' => '14:00:00', 'status' => 1],
            ['dia_semana' => 'Jueves', 'hora_inicio' => '15:30:00', 'hora_fin' => '16:30:00', 'status' => 1],
            ['dia_semana' => 'Jueves', 'hora_inicio' => '18:00:00', 'hora_fin' => '19:00:00', 'status' => 1],
        ]);
    }
}