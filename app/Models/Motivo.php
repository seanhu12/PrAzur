<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motivo extends Model
{
    protected $table = 'motivos';
    protected $fillable = [
        'nombre',
        'observacion'
    ];

    public function estado_propuesta()
    {
        return $this->hasMany(EstadoPropuesta::class)->get();
    }

    public function get_motivos()
    {
        $motivos = Motivo::all();

        return $motivos;
    }

    public function get_motivo($idMotivo)
    {
        $motivo = Motivo::withTrashed()->where('id', $idMotivo)->first();

        return $motivo;
    }
}
