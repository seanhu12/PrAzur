<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckMaterialParticipante extends Model
{
    use SoftDeletes;
    protected $table = 'check_material_participantes';
    protected $fillable = [
        'gafete_aplica',
        'gafete_listo',
        'bitacora_aplica',
        'bitacora_listo',
        'carpeta_ads_aplica',
        'carpeta_ads_listo',
        'lapices_aplica',
        'lapices_listo',
        'velobind_aplica',
        'velobind_listo',
    ];

    public function servicio()
    {
        return $this->hasOne(Servicio::class)->withTrashed()->first();
    }

}
