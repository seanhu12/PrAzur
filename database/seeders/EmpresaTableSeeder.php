<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empresas = [
            [
                'nombre' => 'Distribuidora Cummins Chile S.A',
                'rut' => '96.843.140-4',
                'telefono_fijo' => '',
                'celular' => '961405627',
                'mail' => 'ronald.tovar@ccc.cl',
                'direccion' => 'Av. Americo Vespucio 0631',
                'ciudad_id' => 1
            ],
            [
                'nombre' => 'Minera Escondida Limitada',
                'rut' => '79.587.210-8',
                'telefono_fijo' => '',
                'celular' => '',
                'mail' => 'Jose.JA.Tapia@bhpbilliton.com',
                'direccion' => 'Cerro el Plomo 6000 P 15',
                'ciudad_id' => 1
            ],
            // ... (y así sucesivamente con todos los otros registros)
        ];

        DB::table('empresas')->insert($empresas);
    }
}
