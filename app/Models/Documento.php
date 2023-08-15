<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documento extends Model
{
    use SoftDeletes;
    protected $table = 'documentos';
    protected $fillable = [
        'nombre',
        'codigo',
        'file_name',
        'hash_file_name',
        'tematica_id',
        'tipo_documento_id',
        'deleted_at'
    ];

    public function tipo_documento()
    {
        return $this->belongsTo(TipoDocumento::class)->first();

    }

    public function servicios()
    {
        return $this->belongsToMany('App\Servicio')->withTrashed()->get();
    }

    public function tematica()
    {
        return $this->belongsTo(Tematica::class)->withTrashed()->first();
    }

    public function get_documentos()
    {
        $documentos = Documento::orderBy('id')->get();

        return $documentos;
    }

    public function get_documento($id)
    {
        $documento = Documento::withTrashed()->where('id', $id)->first();

        return $documento;
    }

    public function get_documentos_tipo($tipo)
    {
        $documentos = Documento::orderBy('id')->where('tipo_documento_id', $tipo)->get();

        return $documentos;
    }

    public function get_encuestas_adicionales()
    {
        $documentos = Documento::orderBy('id')
        ->where('tipo_documento_id', 4)
        ->orWhere('tipo_documento_id', 7)->get();

        return $documentos;
    }

    public function del_documento($id)
    {
        $documento = $this->get_documento($id);
        $tipo=$documento->tipo_documento();
        $nombreTipo=$tipo->nombre_snake;;

        if (DocumentoServicio::where('documento_id',$id)->exists()) {
            // soft delete
            $documento->delete();

        }else{
            //borrar permanente
            unlink(storage_path().'/app/public/documentos/documentos_servicio/'.$nombreTipo.'/'.$documento->hash_file_name);
            $documento->forceDelete();
        }

    }

}