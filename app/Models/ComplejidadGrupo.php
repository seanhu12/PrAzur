<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplejidadGrupo extends Model
{
    protected $table = 'complejidad_grupos';
    protected $fillable = ['nombre'];

    public function propuestas()
    {
        return $this->hasMany(Propuesta::class)->get();
    }

    public function get_complejidad_grupos()
    {
        $complejidad = ComplejidadGrupo::all();

        return $complejidad;
    }

    public function get_complejidad_grupo($idComplejidad)
    {
        $complejidad = ComplejidadGrupo::where('id', $idComplejidad)->first();

        return $complejidad;
    }
}
