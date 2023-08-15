<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relator extends Model
{
    use SoftDeletes;
    protected $table = 'relators';

    protected $fillable = [
        'nombre',
        'apellido',
        'rut',
        'mail',
        'celular',
        'vigencia_sence',
        'ciudad_id',
        'deleted_at'
    ];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class)->first();
    }

    public function servicio()
    {
        return $this->hasMany(Servicio::class)->withTrashed()->get();
    }

    public function documentos_relator()
    {
        return $this->hasMany(DocumentoRelator::class)->get();

    }

    public function get_relator($idRelator)
    {
        $relator = Relator::withTrashed()->where('id', $idRelator)->first();

        return $relator;
    }

    public function get_relator_por_rut($rut)
    {
        $relator = Relator::withTrashed()->where('rut', $rut)
            ->whereNotNull('deleted_at')
            ->first();

        return $relator;
    }

    public  function get_relatores()
    {
        $relatores = Relator::orderBy('nombre')->get();

        return $relatores;
    }

    public  function get_all_relatores()
    {
        $relatores = Relator::withTrashed()->orderBy('nombre')->get();

        return $relatores;
    }

    public function del_documentos()
    {
        $documentosRelator = DocumentoRelator::where('relator_id', $this->id)->get();

        if ($documentosRelator != null) {
            foreach ($documentosRelator as $documentoRelator) {
                unlink(storage_path().'/app/public/documentos/certificados_relatores/'.$documentoRelator->hash_file_name);
                $documentoRelator->forceDelete();
            }
        }
    }

}
