<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Participante extends Model
{
    protected $table = 'participantes';
    protected $fillable = [
        'nombre',
        'apellido',
        'rut',
        'correo',
        'faena',
    ];

    public function servicios()
    {
        return $this->belongsToMany('App\Servicio')->get();
    }

    public function get_participantes()
    {
        $participantes = Participante::all();

        return $participantes;
    }

    public function get_participante($idParticipante)
    {
        $participante = Participante::where('id', $idParticipante)->first();

        return $participante;
    }

    public function get_participante_rut($rutParticipante)
    {
        $participante = Participante::where('rut', $rutParticipante)->first();

        return $participante;
    }

    public function get_datos_programa($idPropuesta)
    {
        $participante = ParticipanteServicio::where('participante_id', $this->id)
            ->join('servicios', 'participante_servicio.servicio_id', '=', 'servicios.id')
            ->where('servicios.propuesta_id', $idPropuesta)
            ->join('cursos', 'servicios.curso_id', '=', 'cursos.id')
            ->join('participantes', 'participante_servicio.participante_id', '=', 'participantes.id')
            ->select(DB::raw('participantes.id as participante_id'), DB::raw('servicios.id as servicio_id'))
            ->get();
        return $participante;
    }

    public function get_vigencia()
    {
        $participante = ParticipanteServicio::where('participante_id', $this->id)->first();


        return $participante;
    }

    public function get_evaluacion_participante_tipo($idServicio, $tipo)
    {
        $participantesServicio = ParticipanteServicio::where('servicio_id', $idServicio)
            ->where('participante_id', $this->id)
            ->first();

        $evaluaciones = Evaluacion::where('participante_servicio_id', $participantesServicio->id)
                ->where('tipo', $tipo)
                ->pluck('nota')->toArray();

            return $evaluaciones;


    }

}
