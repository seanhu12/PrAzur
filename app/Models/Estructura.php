<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estructura extends Model
{
    use SoftDeletes;
    protected $table = 'estructuras';
    protected $fillable = [
        'nombre',
        'codigo',
        'file_name',
        'hash_file_name',
        'curso_id',
        'deleted_at'

    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class)->withTrashed()->first();
    }

    public function get_estructuras()
    {
        $estructuras = Estructura::orderBy('id')->get();

        return $estructuras;
    }

    public function get_estructura($id)
    {
        $estructura = Estructura::withTrashed()->where('id', $id)->first();

        return $estructura;
    }

    public function del_estructura($id)
    {
        $estructura = $this->get_estructura($id);

        if (CursoEstructura::where('estructura_id',$id)->exists()) {
            // soft delete
            $estructura->delete();

        }else{
            //borrar permanente
            unlink(storage_path().'/app/public/documentos/estructura_curso/'.$estructura->hash_file_name);
            $estructura->forceDelete();
        }

    }
}
