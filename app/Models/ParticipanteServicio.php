<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipanteServicio extends Model
{
    protected $table = 'participante_servicio';

    protected $fillable =[
        'servicio_id',
        'participante_id',
        'asistencia',
        'vigencia',
        'perfil_participante',
    ];

    public function participante()
    {
        return $this->belongsTo(Participante::class)->first();
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class)->first();
    }

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class)->get();
    }

}
