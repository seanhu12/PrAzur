<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoPropuesta extends Model
{
    protected $table = 'estado_propuesta';
    /**
     * The attributes that are mass assignable
     *
     * @Var array
     */
    protected $fillable =[
        'estado_id',
        'propuesta_id',
        'motivo_id'
    ];


    public function estado()
    {
        return $this->belongsTo(Estado::class)->first();
    }

    public function propuesta()
    {
        return $this->belongsTo(Propuesta::class)->first();
    }

    public function motivo()
    {
        // return $this->belongsTo(Motivo::class)->withTrashed()->first();
        return $this->belongsTo(Motivo::class)->first();
    }
}
