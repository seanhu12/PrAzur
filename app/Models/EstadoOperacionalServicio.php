<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoOperacionalServicio extends Model
{
    use SoftDeletes;
    protected $table = 'estado_operacional_servicio';
    protected $fillable = [
        'estado_operacional_id',
        'servicio_id'
    ];

    public function estado_operacional()
    {
        return $this->belongsTo(EstadoOperacional::class)->first();
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class)->first();
    }

}
