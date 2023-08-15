<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckOutdoor extends Model
{
    use SoftDeletes;
    protected $table = 'check_outdoors';
    protected $fillable = [
        'venda_aplica',
        'venda_listo',
        'venda_recepcion',
        'pvc_aplica',
        'pvc_listo',
        'pvc_recepcion',
        'pelota_aplica',
        'pelota_listo',
        'pelota_recepcion',
        'plumones_aplica',
        'plumones_listo',
        'plumones_recepcion',
        'papel_craf_aplica',
        'papel_craf_listo',
        'papel_craf_recepcion',
        'pechera_aplica',
        'pechera_listo',
        'pechera_recepcion',
        'masquin_listo',
        'masquin_aplica',
        'masquin_recepcion',
        'bolsa_basura_aplica',
        'bolsa_basura_listo',
        'bolsa_basura_recepcion',
        'cono_aplica',
        'cono_listo',
        'cono_recepcion',
        'plato_aplica',
        'plato_listo',
        'plato_recepcion',
        'aro_madera_aplica',
        'aro_madera_listo',
        'aro_madera_recepcion',
        'tijera_aplica',
        'tijera_listo',
        'tijera_recepcion',
        'esqui_aplica',
        'esqui_listo',
        'esqui_recepcion',
        'otros',
    ];

    public function servicio()
    {
        return $this->hasOne(Servicio::class)->withTrashed()->first();
    }
}
