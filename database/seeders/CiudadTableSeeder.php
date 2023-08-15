<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiudadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
        {
            //
            $ciudades = [
                ['nombre' => 'Alerce', 'comuna' => 'Puerto Montt', 'region' => 'Los Lagos', 'pais' => 'Chile'],
                ['nombre' => 'Algarrobo', 'comuna' => 'Algarrobo', 'region' => 'Valparaíso', 'pais' => 'Chile'],
                ['nombre' => 'Alto Hospicio', 'comuna' => 'Alto Hospicio', 'region' => 'Tarapacá', 'pais' => 'Chile'],
                ['nombre' => 'Alto Jahuel', 'comuna' => 'Buin', 'region' => 'Metropolitana de Santiago', 'pais' => 'Chile'],
                ['nombre' => 'Ancud', 'comuna' => 'Ancud', 'region' => 'Los Lagos', 'pais' => 'Chile'],
                ['nombre' => 'Andacollo', 'comuna' => 'Andacollo', 'region' => 'Coquimbo', 'pais' => 'Chile'],
                ['nombre' => 'Angol', 'comuna' => 'Angol', 'region' => 'La Araucanía', 'pais' => 'Chile'],
                ['nombre' => 'Antofagasta', 'comuna' => 'Antofagasta', 'region' => 'Antofagasta', 'pais' => 'Chile'],
                ['nombre' => 'Arauco', 'comuna' => 'Arauco', 'region' => 'Biobío', 'pais' => 'Chile'],
                ['nombre' => 'Arica', 'comuna' => 'Arica', 'region' => 'Arica y Parinacota', 'pais' => 'Chile'],
                ['nombre' => 'Batuco', 'comuna' => 'Lampa', 'region' => 'Metropolitana de Santiago', 'pais' => 'Chile'],
                ['nombre' => 'Bollenar', 'comuna' => 'Melipilla', 'region' => 'Metropolitana de Santiago', 'pais' => 'Chile'],
                ['nombre' => 'Buin', 'comuna' => 'Buin', 'region' => 'Metropolitana de Santiago', 'pais' => 'Chile'],
                ['nombre' => 'Bulnes', 'comuna' => 'Bulnes', 'region' => 'Ñuble', 'pais' => 'Chile'],
                ['nombre' => 'Cabildo', 'comuna' => 'Cabildo', 'region' => 'Valparaíso', 'pais' => 'Chile']
            ];

            DB::table('ciudads')->insert($ciudades);
        }
}
