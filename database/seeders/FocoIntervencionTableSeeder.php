<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FocoIntervencionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $focos = [
            ['nombre' => 'Relaciones humanas'],
            ['nombre' => 'Mejorar clima laboral'],
            ['nombre' => 'Construir equipo de trabajo'],
            ['nombre' => 'Alinear equipos'],
            ['nombre' => 'Alinear líderes'],
            ['nombre' => 'Formación básica de liderazgo'],
            ['nombre' => 'Formación de líderes coach'],
            ['nombre' => 'Problemas operativos'],
            ['nombre' => 'Aumento de la motivación'],
            ['nombre' => 'Problemas de comunicación'],
            ['nombre' => 'Problemas de coordinación'],
            ['nombre' => 'Autocuidado y calidad de vida'],
            ['nombre' => 'Resistencia al cambio'],
            ['nombre' => 'Gestión del cambio'],
            ['nombre' => 'Motivación con la seguridad'],
            ['nombre' => 'Mejora en las prácticas de seguridad'],
            ['nombre' => 'Diagnóstico de equipo'],
            ['nombre' => 'Diagnósticos de líderes'],
            ['nombre' => 'Competencias avanzadas de coaching'],
            ['nombre' => 'Inteligencia emocional'],
            ['nombre' => 'Gestión del tiempo'],
            ['nombre' => 'Reconocimiento y feedback'],
            ['nombre' => 'Equipo alto rendimiento'],
            ['nombre' => 'Productividad'],
            ['nombre' => 'Innovación'],
            ['nombre' => 'Otros']
        ];

        DB::table('foco_intervencions')->insert($focos); 
    
    }
}
