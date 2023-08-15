<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoServicioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposServicio = [
            ['nombre' => 'Programa'],
            ['nombre' => 'Curso']
        ];

        DB::table('tipo_servicios')->insert($tiposServicio);
    }
}
