<?php

use Faker\Generator as Faker;

$factory->define(App\Otic::class, function (Faker $faker) {
    return [
        'nombre' => $faker->company,
        'rut' => $faker->unique()->regexify('(\[1-2][0-9]\.[0-9]{3}\.[0-9]{3}-[0-9])'),
        'telefono_fijo' => $faker->unique()->regexify('(\552[5-7][0-9]{5})'),
        'celular' => $faker->unique()->regexify('(\569[7-9][0-9]{7})'),
        'mail' => $faker->unique()->freeEmail,
        'direccion' => $faker->address,
    ];
});
