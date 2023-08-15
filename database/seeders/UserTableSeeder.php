<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
 public function run()
    {
        //
      /*  $user = new User([
            'nombre' => 'admin',
            'apellido' => 'sistema',
            'rut'=> '77.934.650-1',
            'mail' => '',
            'password' => bcrypt(123456),
        ]);
        $user->save();*/
        DB::table('users')->insert([
            'id' => '1',
            'nombre' => 'admin',
            'apellido' => 'sistema',
            'rut'=> '77.934.650-1',
            'mail' => '',
            'password' => bcrypt(123456),
        ]);

    }
}
