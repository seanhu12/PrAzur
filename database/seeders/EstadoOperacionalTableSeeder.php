<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoOperacionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadosOperacionales = [
            ['nombre' => 'A tiempo'],
            ['nombre' => 'Atrasado'],
            ['nombre' => 'Detenido por cliente'],
            ['nombre' => 'Terminado'],
            ['nombre' => 'Cancelado']
        ];

        DB::table('estado_operacionals')->insert($estadosOperacionales);
    }
}
