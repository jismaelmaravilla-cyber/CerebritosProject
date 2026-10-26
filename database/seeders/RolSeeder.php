<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id_rol' => 1, 'nombre_rol' => 'Doctora'],
            ['id_rol' => 2, 'nombre_rol' => 'Recepcionista'],
            ['id_rol' => 3, 'nombre_rol' => 'Tutor'],
        ]);
    }
}