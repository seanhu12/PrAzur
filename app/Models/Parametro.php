<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    protected $table = 'parametros';
    protected $fillable = [
        'nombre',
        'tiempo_limite'
    ];

    public function get_parametros()
    {
        $parametros = Parametro::all();

        return $parametros;
    }

    public function get_parametro($id)
    {
        $parametro = Parametro::where('id', $id)->first();

        return $parametro;
    }
}
