<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pendon extends Model
{
    use SoftDeletes;

    protected $table = 'pendons';
    protected $fillable = [
        'nombre',
        'codigo',
        'file_name',
        'hash_file_name',
        'deleted_at'
    ];

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class)->withTrashed()->get();
    }

    public function tematicas()
    {
        return $this->belongsToMany('App\Tematica')->withTrashed()->get();
    }

    public function get_pendones()
    {
        $pendones = Pendon::orderBy('id')->get();

        return $pendones;
    }

    //obtener id tematicas del pendon
    public function get_id_tematicas()
    {
        $idTematicas = PendonTematica::where('pendon_id', $this->id)->pluck('tematica_id')->toArray();
        return $idTematicas;
    }

    public function get_all_pedones()
    {
        $pendones = Pendon::withTrashed()->orderBy('id')->get();

        return $pendones;
    }

    public function get_pendon($idPedon)
    {
        $pendon = Pendon::withTrashed()->where('id', $idPedon)->first();

        return $pendon;
    }

    public function set_tematicas($tematicas)
    {
        $tematicaArr = explode(",", $tematicas);
        $long = count($tematicaArr);

        //force delete temáticas del pendon
        $pendonTematica = PendonTematica::where('pendon_id', $this->id)->get();

        foreach ($pendonTematica as $tematica) {
            $tematica->forceDelete();
        }

        //asignar nueva temática al pendon
        for ($i = 0; $i < $long; $i++) {
            $pendonTematica = new PendonTematica([
                'pendon_id' => $this->id,
                'tematica_id' => $tematicaArr[$i],
            ]);

            $pendonTematica->save();
        }
    }

    public function del_tematicas()
    {
        $pendonTematica = PendonTematica::where('pendon_id', $this->id)->get();

        foreach ($pendonTematica as $pendon) {
            $pendon->delete();
        }
    }


}
