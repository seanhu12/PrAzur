<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoContacto extends Model
{
    use SoftDeletes;
    protected $table = 'tipo_contactos';
    protected $fillable = ['nombre'];

    public function contacto_empresa_propuesta()
    {
        return $this->hasMany(ContactoEmpresaPropuesta::class)->get();
    }

    public function get_tipos()
    {
        $tiposContacto = TipoContacto::orderBy('nombre')->get();

        return $tiposContacto;
    }

    public function get_tipo($idTipoContacto)
    {
        $tipoContacto = TipoContacto::withTrashed()->where('id',$idTipoContacto)->first();

        return $tipoContacto;
    }

}
