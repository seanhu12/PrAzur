<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumentoChecklist extends Model
{
    protected $table = 'tipo_documento_checklists';
    protected $fillable = [
        'nombre',
        'nombre_snake',
    ];

    public function documentos_checklist()
    {
        $this->hasMany(DocumentoChecklist::class)->get();
    }

    public function get_tipos_documentos()
    {
        $tipos = TipoDocumentoChecklist::orderBy('nombre')->get();

        return $tipos;
    }

    /*public function get_all_tipos_documentos()
    {
        $tipos = TipoDocumento::withTrashed()->orderBy('nombre')->get();

        return $tipos;
    }*/
}
