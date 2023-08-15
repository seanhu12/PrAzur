<?php

use Faker\Generator as Faker;

$factory->define(App\Curso::class, function (Faker $faker) {
    $cant_horas_practicas =$faker->numberBetween($min = 1, $max = 12);
    $cant_horas_teoricas =$faker->numberBetween($min = 1, $max = 12);
    $tematicas = \App\Tematica::pluck('id')->toArray();
    return [
        'nombre_venta' => 'Curso'.$faker->unique()->postcode,
        'codigo' => $faker->postcode,
        'anio_creacion' => $faker->date('Y'),
        'cant_horas' => $cant_horas_teoricas+$cant_horas_practicas ,
        'cant_horas_practicas' => $cant_horas_practicas,
        'cant_horas_teoricas' => $cant_horas_teoricas ,
        'cant_participantes' => $faker->numberBetween($min = 25, $max = 35),
        'descripcion' => $faker->text(200),
        'file_name_programa' => $faker->name,
        'hash_file_name_programa' =>$faker->name,
        'tematica_id' => $faker->randomElement($tematicas),
        'nombre_sence' =>'sence'.$faker->unique()->postcode,
        'codigo_sence' => $faker->unique()->postcode,
        'vigencia' => $faker->date(),

    ];
});
