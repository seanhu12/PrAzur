<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantePerfilPropuesta extends Model
{
    protected $table = 'participante_perfil_propuesta';

    protected $fillable =[
        'propuesta_id',
        'participante_perfil_id',
    ];


    public function participante_perfil()
    {
        return $this->belongsTo(ParticipantePerfil::class);
    }

    public function propuesta()
    {
        return $this->belongsTo(Propuesta::class);
    }
}
