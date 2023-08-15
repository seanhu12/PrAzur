<?php

use Faker\Generator as Faker;

$factory->define(App\Notebook::class, function (Faker $faker) {
    return [
        'fecha_adquisicion' => $faker->date(),
        'codigo'=>$faker->unique()->postcode,
        'marca' =>'Lenovo',
        'file_name' => 'test',
        'hash_file_name' => 'test'
    ];
});
