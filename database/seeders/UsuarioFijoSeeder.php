<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioFijoSeeder extends Seeder
{
    public function run(): void
    {
        // Cuenta única de la Doctora
        Usuario::firstOrCreate(
            ['telefono' => '8711111111'], // Teléfono único de la doctora
            [
                'id_rol' => 1, // Rol Doctora
                'nombre' => 'Mayela Monserrat',
                'apellido' => 'Treviño Ibarra',
                'contraseña_hash' => Hash::make('doctora123'),
                'estatus' => true,
            ]
        );

        // Cuenta única de la Recepcionista
        Usuario::firstOrCreate(
            ['telefono' => '8712222222'], 
            [
                'id_rol' => 2, // Rol Recepcionista
                'nombre' => 'Recepcionista',
                'apellido' => 'Cerebritos',
                'contraseña_hash' => Hash::make('recepcion123'),
                'estatus' => true,
            ]
        );
    }
}