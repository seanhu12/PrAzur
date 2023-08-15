<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoServicio extends Model
{
    //
    protected $table = 'tipo_servicios';
    protected $fillable = ['nombre'];

    public function propuestas()
    {
        return $this->hasMany(Propuesta::class)->withTrashed()->get();
    }

    public function get_tipo_servicios()
    {
        $tipoServicios = TipoServicio::orderBy('nombre')->get();

        return $tipoServicios;
    }
    public function get_all_tipo_servicios()
    {
        $tipoServicios = TipoServicio::withTrashed()->orderBy('nombre')->get();

        return $tipoServicios;
    }

    public function get_tipo_servicio($idTipoServicio)
    {
        $tipoServicio = TipoServicio::withTrashed()->where('id', $idTipoServicio)->first();

        return $tipoServicio;
    }
}
