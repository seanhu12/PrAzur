<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactoEmpresa extends Model
{
    use SoftDeletes;

    protected $table = 'contacto_empresas';

    protected $fillable = [
        'nombre',
        'apellido',
        'rut',
        'mail',
        'telefono_fijo',
        'celular',
        'direccion',
        'area',
        'cargo',
        'empresa_id',
        'deleted_at'
    ];

    //obtener empresa asociada al contacto
    public function empresa()
    {
        return $this->belongsTo(Empresa::class)->withTrashed()->first();
    }

    public function propuestas()
    {
        return $this->belongsToMany('App\Propuesta')->withTrashed()->get();
    }

    //obtener datos del concontacto_empresa_idtacto
    public function get_contacto($idContacto)
    {
        $contacto = ContactoEmpresa::withTrashed()->where('id', $idContacto)->first();

        return $contacto;
    }

    //obtener todos los contactos existentes
    public function get_contactos()
    {
        $contactos = ContactoEmpresa::orderBy('nombre')->get();

        return $contactos;
    }

    public function get_all_contactos()
    {
        $contactos = ContactoEmpresa::withTrashed()->orderBy('nombre')->get();

        return $contactos;
    }

}
