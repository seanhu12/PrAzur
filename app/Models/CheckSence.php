<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckSence extends Model
{
    use SoftDeletes;
    protected $table = 'check_sences';
    protected $fillable = [
        'sence_id_cargado_aplica',
        'sence_id_cargado_listo',
        'verificar_lector_bio_aplica',
        'verificar_lector_bio_listo',
        'verificar_lector_bio_recepcion',
        'reglamento_sence_aplica',
        'reglamento_sence_listo',
    ];

    public function servicio()
    {
        return $this->hasOne(Servicio::class)->withTrashed()->first();
    }

}
