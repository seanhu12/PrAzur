<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Urgencia extends Model
{
    protected $table = 'urgencias';
    protected $fillable = ['nombre'];

    public function propuestas()
    {
        return $this->hasMany(Propuesta::class)->get();
    }

    public function get_urgencias()
    {
        $urgencias = Urgencia::all();

        return $urgencias;
    }

   public function get_urgencia($idUrgencia)
    {
        $area = Urgencia::where('id', $idUrgencia)->first();

        return $area;
    }
}
