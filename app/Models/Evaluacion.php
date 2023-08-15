<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{

    protected $table = 'evaluacions';

    protected $fillable = [
        'nota',
        'participante_servicio_id',
        'tipo',
    ];

    public function participante_servicio()
    {
        return $this->belongsTo(ParticipanteServicio::class)->first();
    }
}
