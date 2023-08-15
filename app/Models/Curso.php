<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use SoftDeletes;
    protected $table = 'cursos';

    /**
     * The attributes that are mass assignable.
     *
     * @Var array
     */
    protected $fillable = [
        'nombre_venta',
        'codigo',
        'anio_creacion',
        'cant_horas',
        'cant_horas_practicas',
        'cant_horas_teoricas',
        'cant_participantes',
        'descripcion',
        'file_name_programa',
        'hash_file_name_programa',
        'tematica_id',
        'nombre_sence',
        'codigo_sence',
        'vigencia',
        'deleted_at'
    ];


    public function propuestas()
    {
        return $this->hasMany(Propuesta::class)->withTrashed()->get();
    }

    public function programas()
    {
        return $this->belongsToMany('App\Programa')->withTrashed()->get();
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class)->withTrashed()->get();
    }


    public function tematica()
    {
        return $this->belongsTo(Tematica::class)->withTrashed()->first();
    }

    public function estructuras()
    {
        return $this->hasMany(Estructura::class)->get();
    }

    public function get_cursos()
    {
        $cursos = Curso::orderBy('nombre_venta')->get();

        return $cursos;
    }

    public function get_all_cursos()
    {
        $cursos = Curso::withTrashed()->orderBy('nombre_venta')->get();

        return $cursos;
    }

    public function get_curso($idCurso)
    {
        $curso = Curso::withTrashed()->where('id', $idCurso)->first();

        return $curso;
    }

    public function del_estructuras()
    {
        $estructuras = Estructura::where('curso_id', $this->id)->get();

        if ($estructuras != null) {
            foreach ($estructuras as $estructura) {
                $estructura->delete();
            }
        }
    }


}
