<?php

use App\Empresa;
use Faker\Generator as Faker;

$factory->define(App\ContactoEmpresa::class, function (Faker $faker) {
    $empresas = Empresa::pluck('id')->toArray();

    return [
        'nombre' => $faker->name,
        'apellido' => $faker->lastName,
        'rut' => $faker->unique()->regexify('(\[1-2][0-9]\.[0-9]{3}\.[0-9]{3}-[0-9])'),
        'mail' => $faker->unique()->companyEmail,
        'telefono_fijo' => $faker->unique()->regexify('(\552[5-7][0-9]{5})'),
        'celular' => $faker->unique()->regexify('(\569[7-9][0-9]{7})'),
        'direccion' => $faker->address,
        'area' => $faker->jobTitle,
        'cargo' => 'FakeCargo',
        'empresa_id' => $faker->randomElement($empresas)
    ];
});
