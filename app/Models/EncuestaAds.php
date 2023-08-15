<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EncuestaAds extends Model
{
    protected $table = 'encuesta_ads';
    protected $fillable = [
        'respuesta_1',
        'respuesta_2',
        'respuesta_3',
        'respuesta_4',
        'respuesta_5',
        'respuesta_6',
        'respuesta_7',
        'servicio_id',
        
    ];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class)->first();
    }
    
}
