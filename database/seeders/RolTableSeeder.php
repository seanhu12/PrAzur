<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['nombre' => 'Administrador de Usuarios'],
            //['nombre' => 'Coordinador de Acciones'],
            ['nombre' => 'Gestor de Cursos'],
            ['nombre' => 'Gestor de Empresas'],
            ['nombre' => 'Gestor de Recursos'],
            ['nombre' => 'Gestor de Ventas'],
            ['nombre' => 'Gestor de Servicios'],
            //['nombre' => 'Encargado de Finanzas'],
            ['nombre' => 'Administrador de Servicios'],
            ['nombre' => 'Diseñador Técnico'],
        ];

        DB::table('rols')->insert($roles); // Asumo que el nombre de la tabla es 'rols'. Cambia si es diferente.
    }
}
