<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckCoordinacion extends Model
{
    use SoftDeletes;
    protected $table = 'check_coordinacions';
    protected $fillable = [
        'coordinar_sala_listo',
        'coffee_aplica',
        'coffee_listo',
        'almuerzo_aplica',
        'almuerzo_listo',
        'nomina_participantes_listo',
    ];

    public function servicio()
    {
        return $this->hasOne(Servicio::class)->withTrashed()->first();
    }
}
