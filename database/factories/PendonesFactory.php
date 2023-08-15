<?php

use Faker\Generator as Faker;

$factory->define(App\Pendon::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->unique()->word,
        'codigo'=>$faker->unique()->postcode,
        'file_name' => 'test',
        'hash_file_name' => 'test'
    ];
});
