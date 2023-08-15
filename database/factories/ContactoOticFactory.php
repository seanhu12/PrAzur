<?php

use App\Otic;
use Faker\Generator as Faker;

$factory->define(App\ContactoOtic::class, function (Faker $faker) {
    $otics = Otic::pluck('id')->toArray();
    return [
        'nombre' => $faker->name,
        'apellido' => $faker->lastName,
        'rut' => $faker->unique()->regexify('(\[1-2][0-9]\.[0-9]{3}\.[0-9]{3}-[0-9])'),
        'mail' => $faker->unique()->companyEmail,
        'telefono_fijo' => $faker->unique()->regexify('(\552[5-7][0-9]{5})'),
        'celular' => $faker->unique()->regexify('(\569[7-9][0-9]{7})'),
        'direccion' => $faker->address,
        'area' => $faker->jobTitle,
        'otic_id' => $faker->randomElement($otics)
    ];
});
