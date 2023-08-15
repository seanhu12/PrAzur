<?php

use Faker\Generator as Faker;

$factory->define(App\Relator::class, function (Faker $faker) {
    $ciudades = \App\Ciudad::pluck('id')->toArray();
    return [
        'nombre' => $faker->name,
        'apellido' => $faker->lastName,
        'rut' => $faker->unique()->regexify('(\[1-2][0-9]\.[0-9]{3}\.[0-9]{3}-[0-9])'),
        'mail' => $faker->unique()->companyEmail,
        'celular' => $faker->unique()->regexify('(\569[7-9][0-9]{7})'),
        'vigencia_sence' => $faker->date(),
        'ciudad_id' => $faker->randomElement($ciudades),
    ];
});
