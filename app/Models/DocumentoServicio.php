<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoServicio extends Model
{
    protected $table = 'documento_servicio';
    protected $fillable = [
        'documento_id',
        'servicio_id'
    ];

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function get_documento()
    {
        $documentos = DocumentoServicio::orderBy('id')->get();

        return $documentos;
    }
}
