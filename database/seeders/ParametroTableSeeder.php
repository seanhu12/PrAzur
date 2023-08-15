<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParametroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parametros = [
            ['nombre' => 'Fecha Compromiso', 'tiempo_limite' => 2],
            ['nombre' => 'Diplomas Servicio', 'tiempo_limite' => 5],
        ];

        DB::table('parametros')->insert($parametros); 
    }
}
