<?php

use Faker\Generator as Faker;

$factory->define(App\MetasVenta::class, function (Faker $faker) {
    return [
        'anio' => 2019,
        'monto_meta' => $faker->numberBetween($min = 4000000, $max = 1500000),
        //'monto_vendido' => $faker->numberBetween($min = 500000, $max = 3500000),
    ];
});