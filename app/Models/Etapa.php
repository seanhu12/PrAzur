<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    protected $table = 'etapas';
    protected $fillable = [
        'nombre',
        'tiempo_limite'
    ];

    public function servicio()
    {
        return $this->belongsToMany('App\Servicio')->withTrashed()->get();
    }

    public function get_etapas()
    {
        $etapa = Etapa::all();

        return $etapa;
    }

    public function get_etapa($id)
    {
        $etapa = Etapa::where('id', $id)->first();

        return $etapa;
    }

}
