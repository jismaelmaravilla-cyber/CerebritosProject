<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

   
        DB::table('pruebas')->insert([
       ['id_prueba' => 1, 'titulo' => 'Escala Conners', 'descripcion' => 'Evaluación de atención, Impusltividad y autoregulación emocional', 'tipo_prueba' => 'Diagnostico', 'enfoque_edad' => '3 a 17 años'],
       ['id_prueba' => 2, 'titulo' => 'Inventario de depresión infantil', 'descripcion' => 'Cuestionario para evaluar cambios en el estado de ánimo', 'tipo_prueba' => 'Diagnostico', 'enfoque_edad' => '7 de 17 años'],
       ['id_prueba' => 3, 'titulo' => 'Escala de ansiedad infantil de Spence', 'descripcion' => 'Mide manifestaciones de ansiedad y miedos intensos', 'tipo_prueba' => 'Paliativa', 'enfoque_edad' => '8 a 15 años']
        ]);

        DB::table('preguntas')->insert([
        ['id_pregunta' => 1, 'id_prueba' => 1, 'texto_pregunta' => '¿Con que frecuencia tengo dificultad para prestar atención en clase?'],
        ['id_pregunta' =>2, 'id_prueba' => 1, 'texto_pregunta' => '¿Con que frecuencia se me dificulta esperar mi turno?'],
        ['id_pregunta' => 3, 'id_prueba' => 2, 'texto_pregunta' => '¿Me he sentido triste o desánimado en las últimas semanas?'],
            ['id_pregunta' => 4, 'id_prueba' => 3, 'texto_pregunta' => '¿Prefiero evitar las situaciones que me ponen nervioso?']
        ]);

        DB::table('opciones_respuesta')->insert([
            ['id_pregunta' => 1, 'texto_opcion' => 'Nunca', 'valor_puntos' => 0],
            ['id_pregunta' => 1, 'texto_opcion' => 'A veces', 'valor_puntos' => 1],
            ['id_pregunta' => 1, 'texto_opcion' => 'Siempre', 'valor_puntos' => 2],
            ['id_pregunta' => 2, 'texto_opcion' => 'Nunca', 'valor_puntos' => 0],
            ['id_pregunta' => 2, 'texto_opcion' => 'A veces', 'valor_puntos' => 1],
            ['id_pregunta' => 2, 'texto_opcion' => 'Siempre', 'valor_puntos' => 2],
            ['id_pregunta' => 3, 'texto_opcion' => 'Nunca', 'valor_puntos' => 0],
            ['id_pregunta' => 3, 'texto_opcion' => 'A veces', 'valor_puntos' => 1],
            ['id_pregunta' => 3, 'texto_opcion' => 'Siempre', 'valor_puntos' => 2],
            ['id_pregunta' => 4, 'texto_opcion' => 'Nunca', 'valor_puntos' => 0],
            ['id_pregunta' => 4, 'texto_opcion' => 'A veces', 'valor_puntos' => 1],
            ['id_pregunta' => 4, 'texto_opcion' => 'Siempre', 'valor_puntos' => 2]
        ]);

        
    }

}
