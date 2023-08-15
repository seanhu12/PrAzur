<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    //

    protected $table = 'estados';
    protected $fillable = ['nombre'];

    public function propuestas()
    {
        return $this->belongsToMany('App\Propuesta')->withTrashed()->get();
    }

    public function get_estados()
    {
        $estados = Estado::take(6)->get();

        return $estados;
    }

    public function get_estado($idEstado)
    {
        $estado = Estado::where('id', $idEstado)->first();

        return $estado;
    }
}
