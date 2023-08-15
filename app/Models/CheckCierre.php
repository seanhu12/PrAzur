<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckCierre extends Model
{
    use SoftDeletes;
    protected $table = 'check_cierres';
    protected $fillable = [
        'diplomas_aplica',
        'diplomas_listo',
        'nota_listo',
        'orden_compra_listo',
        'certificado_sence_aplica',
        'certificado_sence_listo',
        'libro_asistencia_listo',
        'resultado_encuestas_ads_listo',
    ];

    public function servicio()
    {
        return $this->hasOne(Servicio::class)->withTrashed()->first();
    }
}
