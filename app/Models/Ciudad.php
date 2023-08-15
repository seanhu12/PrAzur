<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    //
    protected $table = 'ciudads';
    protected $fillable = ['nombre'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class)->first();
    }

    public function get_ciudades()
    {
        $ciudades = Ciudad::orderBy('nombre')->get();
        return $ciudades;
    }

    public function get_all_ciudades()
    {
        $ciudades = Ciudad::withTrashed()->orderBy('nombre')->get();
        return $ciudades;
    }
}
