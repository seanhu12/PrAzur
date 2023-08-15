<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CursoPrograma extends Model
{
    use SoftDeletes;

    protected $table = 'curso_programa';
    /**
     * The attributes that are mass assignable
     *
     * @Var array
     */
    protected $fillable = [
        'programa_id', 'curso_id'
    ];

    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

}