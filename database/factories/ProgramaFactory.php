<?php

use Faker\Generator as Faker;

$factory->define(App\Programa::class, function (Faker $faker) {
    return [
        'nombre' => 'Programa-'.$faker->unique()->word,
    ];
});
