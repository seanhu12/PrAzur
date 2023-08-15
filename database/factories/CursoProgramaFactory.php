<?php

use Faker\Generator as Faker;
use App\Curso;
use App\Programa;
$factory->define(App\CursoPrograma::class, function (Faker $faker) {
    return [
        'programa_id' => Programa::all()->random()->id,
        'curso_id' => Curso::all()->random()->id,
    ];
});