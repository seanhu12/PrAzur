<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckAudioIluminacion extends Model
{
    use SoftDeletes;
    protected $table = 'check_audio_iluminacions';
    protected $fillable = [
        'parlantes_aplica',
        'parlantes_listo',
        'parlantes_recepcion',
        'atril_aplica',
        'atril_listo',
        'atril_recepcion',
        'alargador_aplica',
        'alargador_listo',
        'alargador_recepcion',
        'foco_aplica',
        'foco_listo',
        'foco_recepcion',
        'microfono_cintillo_aplica',
        'microfono_cintillo_listo',
        'microfono_cintillo_recepcion',
        'microfono_inalambrico_aplica',
        'microfono_inalambrico_listo',
        'microfono_inalambrico_recepcion',
        /*'proyector_aplica',
        'proyector_listo',
        'proyector_recepcion',*/
        'otros',

    ];

    public function servicio()
    {
        return $this->hasOne(Servicio::class)->withTrashed()->first();
    }
}
