<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tematica extends Model
{
    use SoftDeletes;

    protected $table = 'tematicas';
    protected $fillable = ['nombre', 'deleted_at'];

    public function cursos()
    {
        return $this->hasMany(Curso::class)->withTrashed()->get();
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class)->withTrashed()->get();
    }

    public function pendones()
    {
        return $this->hasMany('App\Pendon')->withTrashed()->get();
    }

    public function get_tematicas()
    {
        $tematicas = Tematica::orderBy('nombre')->get();

        return $tematicas;
    }

    public function get_all_tematicas()
    {
        $tematicas = Tematica::withTrashed()->orderBy('nombre')->get();

        return $tematicas;
    }

    public function get_tematica($idTematica)
    {
        $tematica = Tematica::withTrashed()->where('id', $idTematica)->first();

        return $tematica;
    }

    public function get_tematica_por_nombre($nombreTematica)
    {
        $tematica = Tematica::withTrashed()
            ->where('nombre', $nombreTematica)
            ->whereNotNull('deleted_at')
            ->first();

        return $tematica;
    }
}
