<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoRelator extends Model
{
    protected $table =  'documento_relators';

    protected $fillable =[
        'file_name',
        'hash_file_name',
        'relator_id',
    ];

    public function relator()
    {
        return $this->belongsTo(Relator::class)->withTrashed()->first();

    }

    public function get_documento($idDocumento)
    {
        $documento =  DocumentoRelator::where('id',$idDocumento)->first();

        return $documento;
    }
}
