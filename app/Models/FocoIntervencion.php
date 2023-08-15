<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FocoIntervencion extends Model
{

    protected $table = 'foco_intervencions';
    protected $fillable = ['nombre'];

    public function propuestas()
    {
        return $this->belongsToMany('App\Propuesta')->get();
    }

    public function get_foco_intervenvion()
    {
        $foco = FocoIntervencion::all();

        return $foco;
    }

    public function get_foco_intervencion($idFoco)
    {
        $foco = FocoIntervencion::where('id', $idFoco)->first();

        return $foco;
    }
}
