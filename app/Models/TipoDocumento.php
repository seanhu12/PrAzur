<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipo_documentos';
    protected $fillable = [
        'nombre',
        'nombre_snake',
    ];

    public function documentos()
    {
        $this->hasMany(Documento::class)->withTrashed()->get();
    }

    public function get_tipos_documentos()
    {
        $tipos = TipoDocumento::orderBy('nombre')->get();

        return $tipos;
    }
    public function get_all_tipos_documentos()
    {
        $tipos = TipoDocumento::withTrashed()->orderBy('nombre')->get();

        return $tipos;
    }
}
