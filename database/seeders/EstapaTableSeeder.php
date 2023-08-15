<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstapaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etapas = [
            ['nombre' => 'Diseño', 'tiempo_limite' => 10],
            ['nombre' => 'Logística', 'tiempo_limite' => 5],
            ['nombre' => 'Preparado', 'tiempo_limite' => 0],
            ['nombre' => 'Ejecución', 'tiempo_limite' => 0],
            ['nombre' => 'Cierre', 'tiempo_limite' => 35],
            ['nombre' => 'Cerrado', 'tiempo_limite' => 0]
        ];

        DB::table('etapas')->insert($etapas);
    }
}
