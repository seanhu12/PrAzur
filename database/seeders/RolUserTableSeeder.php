<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolUsers = [];

        for ($i = 1; $i < 9; $i++) {
            $rolUsers[] = [
                'rol_id' => $i,
                'user_id' => 1
            ];
        }

        DB::table('rol_user')->insert($rolUsers); 
    }
}
