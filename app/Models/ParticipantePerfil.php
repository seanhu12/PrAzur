<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantePerfil extends Model
{
    protected $table = 'participante_perfils';
    protected $fillable = ['nombre'];

    public function propuestas()
    {
        return $this->belongsToMany('App\Propuesta')->get();
    }

    public function get_participante_perfiles()
    {
        $perfiles = ParticipantePerfil::all();

        return $perfiles;
    }

    public function get_nombres_participante_perfiles()
    {
        $perfiles = ParticipantePerfil::all()->pluck('nombre')->toArray();

        return $perfiles;
    }

    public function get_participante_perfil($idPerfil)
    {
        $perfil = ParticipantePerfil::where('id', $idPerfil)->first();

        return $perfil;
    }
}
