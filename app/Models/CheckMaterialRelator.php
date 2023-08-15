<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckMaterialRelator extends Model
{
    use SoftDeletes;
    protected $table = 'check_material_relators';
    protected $fillable = [
        'libro_asistencia_listo',
        'libro_asistencia_recepcion',
        'encuesta_ads_listo',
        'encuesta_ads_recepcion',
        'encuesta_empresa_aplica',
        'encuesta_empresa_listo',
        'encuesta_empresa_recepcion',
        'pendones_listo',
        'pendones_recepcion',
        'proyector_aplica',
        'proyector_listo',
        'proyector_recepcion',
        'preparar_guia_aplica',
        'preparar_guia_listo',
        'preparar_guia_recepcion',
        'preparar_prueba_aplica',
        'preparar_prueba_listo',
        'preparar_prueba_recepcion',
        'plumones_aplica',
        'plumones_listo',
        'plumones_recepcion',
        'notebook_aplica',
        'notebook_listo',
        'notebook_recepcion',
        'encuesta_adicional_aplica',
        'encuesta_adicional_listo',
        'encuesta_adicional_recepcion',
    ];

    public function servicio()
    {
        return $this->hasOne(Servicio::class)->withTrashed()->first();
    }
}
