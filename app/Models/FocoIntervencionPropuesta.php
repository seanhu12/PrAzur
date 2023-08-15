<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FocoIntervencionPropuesta extends Model
{
    protected $table = 'foco_intervencion_propuesta';
    /**
     * The attributes that are mass assignable
     *
     * @Var array
     */
    protected $fillable =[
        'propuesta_id',
        'foco_intervencion_id'
    ];


    public function foco_intervencion()
    {
        return $this->belongsTo(FocoIntervencion::class);
    }

    public function propuesta()
    {
        return $this->belongsTo(Propuesta::class);
    }

}
