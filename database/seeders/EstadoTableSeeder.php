<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            ['nombre' => 'No Enviada'],
            ['nombre' => 'Enviada'],
            ['nombre' => 'Cancelada'],
            ['nombre' => 'Aceptada'],
            ['nombre' => 'Rechazada'],
            ['nombre' => 'Servicio Confirmado'],
            ['nombre' => 'Eliminada']
        ];

        DB::table('estados')->insert($estados);
    }
}
