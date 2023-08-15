<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $motivos = [
            ['nombre' => 'Aspectos Técnicos'],
            ['nombre' => 'Interno Cliente'],
            ['nombre' => 'Interno ADS'],
            ['nombre' => 'Precio'],
        ];

        DB::table('motivos')->insert($motivos); 
    }
}
