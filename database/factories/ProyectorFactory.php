<?php

use Faker\Generator as Faker;

$factory->define(App\Proyector::class, function (Faker $faker) {
    return [
        'fecha_adquisicion' => $faker->date(),
        'codigo'=>$faker->unique()->postcode,
        'file_name' => 'test',
        'hash_file_name' => 'test'
    ];
});
