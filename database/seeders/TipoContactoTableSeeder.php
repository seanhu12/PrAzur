<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoContactoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposContacto = [
            ['nombre' => 'Venta'],
            ['nombre' => 'Coordinación'],
            ['nombre' => 'Administración y Finanzas'],
        ];

        DB::table('tipo_contactos')->insert($tiposContacto);
    }
}
