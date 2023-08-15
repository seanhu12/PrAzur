<?php

namespace App\Models;

use DemeterChain\C;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Otic extends Model
{
    use softDeletes;
    protected $table = 'otics';

    protected $fillable = [
        'nombre', 'rut', 'telefono_fijo', 'celular', 'mail', 'direccion','deleted_at'
    ];

    //propuestas asociadas a la otic
    public function propuestas()
    {
        return $this->hasMany(Propuesta::class)->withTrashed()->get();
    }

    //contactos asociados a la otic
    public function contactos()
    {
        return $this->hasMany(ContactoOtic::class)->withTrashed()->get();
    }

    //obtener otics existentes
    public function get_otics()
    {
        $otics = Otic::orderBy('nombre')->get();

        return $otics;
    }

    //obtener datos de la otic
    public function get_otic($idOtic)
    {
        $otic = Otic::withTrashed()->where('id', $idOtic)->first();

        return $otic;
    }

    public function get_otic_por_rut($rut)
    {
        $otic = Otic::withTrashed()->where('rut', $rut)
            ->whereNotNull('deleted_at')
            ->first();

        return $otic;
    }

    public function get_all_otics()
    {
        $otic = Otic::withTrashed()->orderBy('nombre')->get();

        return $otic;
    }

    public function del_contactos_otic()
    {
        $contactoOtic = ContactoOtic::where('otic_id',$this->id)->get();

        if ($contactoOtic != null){

            foreach ($contactoOtic as $contacto) {
                $contacto->delete();
            }
        }
    }





}