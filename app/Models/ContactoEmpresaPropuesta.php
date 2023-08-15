<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactoEmpresaPropuesta extends Model
{

    protected $table = 'contacto_empresa_propuesta';
    /**
     * The attributes that are mass assignable
     *
     * @Var array
     */
    protected $fillable =[
        'contacto_empresa_id',
        'propuesta_id',
        'tipo_contacto_id'
    ];


    public function contacto_empresa()
    {
        return $this->belongsTo(ContactoEmpresa::class)->first();
    }

    public function propuesta()
    {
        return $this->belongsTo(Propuesta::class)->first();
    }

    public function tipo_contacto()
    {
        return $this->belongsTo(TipoContacto::class)->first();
    }
}
