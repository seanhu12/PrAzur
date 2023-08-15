<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoOperacional extends Model
{
    use SoftDeletes;
    protected $table = 'estado_operacionals';
    protected $fillable = [
        'nombre'
    ];

    public function servicios()
    {
        return $this->belongsToMany('App\Servicio')->withTrashed()->get();
    }

    public function get_estado_operacional()
    {
        $estados = EstadoOperacional::all();

        return $estados;
    }

    public function get_estado($id)
    {
        $estado = EstadoOperacional::where('id', $id)->first();

        return $estado;
    }

}
