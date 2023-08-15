<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoChecklist extends Model
{
    protected $table = 'documento_checklists';
    protected $fillable = [
        'codigo',
        'file_name',
        'hash_file_name',
        'servicio_id',
        'tipo_documento_checklist_id',
    ];

    public function tipo_documento_checklist()
    {
        return $this->belongsTo(TipoDocumentoChecklist::class)->first();

    }

    public function servicio()
    {
        $this->belongsTo(Servicio::class)->first();
    }

    public function get_documentos()
    {
        $documentos = DocumentoChecklist::orderBy('id')->get();

        return $documentos;
    }

    public function get_documento($id)
    {
        $documento = DocumentoChecklist::where('id', $id)->first();

        return $documento;
    }

    public function get_documentos_tipo($tipo)
    {
        $documentos = DocumentoChecklist::orderBy('id')->where('tipo_documento_checklist_id', $tipo)->get();

        return $documentos;
    }

    /*public function del_documento($id)
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

    }*/
}
