<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TematicaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tematicas = [
            ['nombre' => 'Trabajo en Equipo'],
            ['nombre' => 'Liderazgo'],
            ['nombre' => 'Comunicación Efectiva'],
            ['nombre' => 'Psicoprevención'],
            ['nombre' => 'Coaching'],
            ['nombre' => 'Establecimientos Educacionales'],
            ['nombre' => 'Instituciones Públicas'],
            ['nombre' => 'No Aplica'],
        ];

        DB::table('tematicas')->insert($tematicas);
    }
}
