<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendonTematica extends Model
{
    use SoftDeletes;
    protected $table='pendon_tematica';
    protected $fillable=[
      'pendon_id',
      'tematica_id',
    ];

    public function pendon()
    {
        return $this->belongsTo(Pendon::class);
    }

    public function tematica()
    {
        return $this->belongsTo(Tematica::class);
    }

}
