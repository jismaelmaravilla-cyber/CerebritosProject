<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol; // <--- Importa esta línea

class RolSeeder extends Seeder
{
    public function run(): void
    {
        Rol::firstOrCreate(['nombre_rol' => 'Administrador']);
        Rol::firstOrCreate(['nombre_rol' => 'Recepcionista']);
        Rol::firstOrCreate(['nombre_rol' => 'Tutor']);
    }
}