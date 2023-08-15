<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposDocumento = [
            [
                'nombre' => 'Manual Participantes',
                'nombre_snake' => 'manual_participantes'
            ],
            [
                'nombre' => 'Guía',
                'nombre_snake' => 'guia'
            ],
            [
                'nombre' => 'Prueba',
                'nombre_snake' => 'prueba'
            ],
            [
                'nombre' => 'Encuesta Diagnóstica',
                'nombre_snake' => 'encuesta_diagnostica'
            ],
            [
                'nombre' => 'Encuesta ADS',
                'nombre_snake' => 'encuesta_ads'
            ],
            [
                'nombre' => 'Encuesta Empresa',
                'nombre_snake' => 'encuesta_empresa'
            ],
            [
                'nombre' => 'Encuesta Cierre Programa',
                'nombre_snake' => 'encuesta_cierre_programa'
            ],
        ];

        DB::table('tipo_documentos')->insert($tiposDocumento);
    }
}
