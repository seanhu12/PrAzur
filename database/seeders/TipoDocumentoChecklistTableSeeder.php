<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocumentoChecklistTableSeeder extends Seeder
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
                'nombre' => 'Libro Asistencia',
                'nombre_snake' => 'libro_asistencia'
            ],
            [
                'nombre' => 'Certificado Sence',
                'nombre_snake' => 'certificado_sence'
            ],
            [
                'nombre' => 'Encuesta',
                'nombre_snake' => 'encuesta'
            ],
            [
                'nombre' => 'Otros',
                'nombre_snake' => 'otros'
            ],
        ];

        DB::table('tipo_documento_checklists')->insert($tiposDocumento); 
    }
}
