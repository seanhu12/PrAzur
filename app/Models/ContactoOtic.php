<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactoOtic extends Model
{
    use SoftDeletes;

    protected $table = 'contacto_otics';

    protected $fillable = [
        'nombre',
        'apellido',
        'rut',
        'mail',
        'telefono_fijo',
        'celular',
        'direccion',
        'area',
        'otic_id',
        'deleted_at'
    ];

    //obtener empresa asociada al contacto
    public function otic()
    {
        return $this->belongsTo(Otic::class)->first();
    }

    //obtener datos del contacto
    public function get_contacto($idContacto)
    {
        $contacto = ContactoOtic::withTrashed()->where('id', $idContacto)->first();

        return $contacto;
    }

    //obtener todos los contactos existentes
    public function get_contactos()
    {
        $contactos = ContactoOtic::orderBy('nombre')->get();

        return $contactos;
    }

    public function get_all_contactos()
    {
        $contactos = ContactoOtic::withTrashed()->orderBy('nombre')->get();

        return $contactos;
    }

}
