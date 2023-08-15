<?php

namespace App\Models;

use App\Models\CursoPrograma;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Programa extends Model
{
    use SoftDeletes;
    protected $table = 'programas';
    protected $fillable = ['nombre','deleted_at'];

    public function propuestas()
    {
        return $this->hasMany(Propuesta::class)->withTrashed()->get();
    }

    public function cursos()
    {
        return $this->belongsToMany('App\Models\Curso')->withTrashed()->get();
    }

    //obtener id cursos del programa
    public function get_id_cursos()
    {
        $idCursos = CursoPrograma::where('programa_id', $this->id)->pluck('curso_id')->toArray();
        return $idCursos;
    }

    public function get_programas()
    {
        $programas = Programa::orderBy('nombre')->get();

        return $programas;
    }

    public function get_all_programas()
    {
        $programas = Programa::withTrashed()->orderBy('nombre')->get();

        return $programas;
    }

    public function get_programa($idPragrama)
    {
        $programa = Programa::withTrashed()->where('id', $idPragrama)->first();

        return $programa;
    }

    public function set_cursos($cursos)
    {
        $cursosArr = explode(",", $cursos);
        $long = count($cursosArr);

        //force delete cursos del programa
        $cursosPrograma = CursoPrograma::where('programa_id', $this->id)->get();

        foreach ($cursosPrograma as $curso) {
            $curso->forceDelete();
        }

        //asignar nuevo cursos al programa
        for ($i = 0; $i < $long; $i++) {
            $cursoPrograma = new CursoPrograma([
                'programa_id' => $this->id,
                'curso_id' => $cursosArr[$i],
            ]);

            $cursoPrograma->save();
        }
    }

    public function del_cursos()
    {
        //buscar cursos antiguos
        $cursosPrograma = CursoPrograma::where('programa_id', $this->id)->get();

        //eliminar cursos antiguos
        foreach ($cursosPrograma as $curso) {
            $curso->delete();
        }
    }
}
