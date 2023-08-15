<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendonServicio extends Model
{
    use SoftDeletes;
    protected $table = 'pendon_servicio';
    protected $fillable = [
        'pendon_id',
        'servicio_id'
    ];

    public function pendon()
    {
        return $this->belongsTo(Pendon::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
