<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    protected $fillable = ['nombre'];

    public function propuestas()
    {
        return $this->hasMany(Propuesta::class)->get();
    }

    public function get_areas()
    {
        $areas = Area::all();

        return $areas;
    }

    public function get_all_areas()
    {
        $areas = Area::all();

        return $areas;
    }

    public function get_area($idArea)
    {
        $area = Area::where('id', $idArea)->first();

        return $area;
    }
}
