<?php

use Faker\Generator as Faker;

$factory->define(App\Empresa::class, function (Faker $faker) {
    $ciudades = \App\Ciudad::pluck('id')->toArray();
    return [
        'nombre' => $faker->company,
        'rut' => $faker->unique()->regexify('(\7[0-9]\.[0-9]{3}\.[0-9]{3}-[0-9])'),
        'telefono_fijo' => $faker->unique()->regexify('(\552[5-7][0-9]{5})'),
        'celular' => $faker->unique()->regexify('(\569[7-9][0-9]{7})'),
        'mail' => $faker->unique()->companyEmail,
        'direccion' => $faker->address,
        'ciudad_id' => $faker->randomElement($ciudades),
    ];
});
