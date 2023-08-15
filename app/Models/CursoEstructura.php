<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CursoEstructura extends Model
{
    use SoftDeletes;
    protected $table = 'curso_estructura';
    protected $fillable = [
        'curso_id',
        'estructura_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function estructura()
    {
        return $this->belongsTo(Estructura::class);
    }
}
