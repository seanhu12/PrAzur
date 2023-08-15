<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoPropuesta extends Model
{
    protected $table =  'documento_propuestas';

    protected $fillable =[
        'file_name',
        'hash_file_name',
        'propuesta_id',
    ];

    public function propuesta()
    {
        return $this->belongsTo(Propuesta::class)->withTrashed()->first();

    }

    public function get_documento($idDocumento)
    {
       $documento =  DocumentoPropuesta::where('id',$idDocumento)->first();

       return $documento;
    }
}
