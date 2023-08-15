<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantePerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfiles = [
            ['nombre' => 'Gerente'],
            ['nombre' => 'Administrador'],
            ['nombre' => 'Líderes'],
            ['nombre' => 'Supervisores'],
            ['nombre' => 'Asesores'],
            ['nombre' => 'Técnicos'],
            ['nombre' => 'Administrativos'],
        ];

        DB::table('participante_perfils')->insert($perfiles); 
    }
}
