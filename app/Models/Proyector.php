<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyector extends Model
{
    use SoftDeletes;

    protected $table = 'proyectors';
    protected $fillable = [
        'codigo',
        'fecha_adquisicion',
        'file_name',
        'hash_file_name',
        'deleted_at'
    ];

    public function servicios()
    {
        return $this->hasMany(Servicio::class)->withTrashed()->get();
    }

    public function get_proyectors()
    {
        $proyector= Proyector::orderBy('id')->get();

        return $proyector;
    }
    public function get_all_proyectors()
    {
        $proyector= Proyector::withTrashed()->orderBy('id')->get();

        return $proyector;
    }

    public function get_proyector($idProyector)
    {
        $proyector = Proyector::withTrashed()->where('id',$idProyector)->first();

        return $proyector;
    }
}
