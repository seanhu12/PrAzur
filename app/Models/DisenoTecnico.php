<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DisenoTecnico extends Model
{
    use SoftDeletes;
    protected $table = 'diseno_tecnicos';
    protected $fillable = [
        'diseno_tecnico_listo',
        'manual_aplica',
        'prueba_aplica',
        'guia_aplica',
        'encuesta_empresa_aplica',
        'encuesta_adicionales_aplica',
        'detalle',
        'estructura_id',
    ];

    public function servicio()
    {
        return $this->hasOne(Servicio::class)->withTrashed()->first();
    }

    public function estructura()
    {
        return $this->belongsTo(Estructura::class)->withTrashed()->first();
    }


}
