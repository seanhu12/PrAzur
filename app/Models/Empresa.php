<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;
    protected $table = 'empresas';

    /**
     * The attributes that are mass assignable.
     *
     * @Var array
     */
    protected $fillable = [
        'nombre',
        'rut',
        'telefono_fijo',
        'celular',
        'mail',
        'direccion',
        'ciudad_id',
        'holding_id',
        'deleted_at'
    ];


    public function propuestas()
    {
        return $this->hasMany(Propuesta::class)->withTrashed()->get();
    }



    public function get_empresas()
    {
        $empresas = Empresa::orderBy('nombre')->get();

        return $empresas;
    }

    public function get_all_empresas()
    {
        $empresas = Empresa::withTrashed()->orderBy('nombre')->get();

        return $empresas;
    }
    public function metas_venta()
    {
        return $this->hasMany(MetasVenta::class)->orderBy('anio')->orderBy('mes');
    }
    


    public function get_empresa($id)
    {
        $empresa = Empresa::where('id', $id)->first();

        return $empresa;
    }

    public function get_empresa_por_rut($rut)
    {
        $empresa = Empresa::withTrashed()->where('rut', $rut)
            ->whereNotNull('deleted_at')
            ->first();

        return $empresa;
    }

    // verificar su utilidad
    public function set_ciudad($ciudad_id)
    {
        $this->ciudad_id = $ciudad_id;
        $this->save();
    }

    //retorna la ciudad
    public function get_ciudad()
    {
        $ciudad = Ciudad::where('id', $this->ciudad_id)->first();

        return $ciudad;
    }

    public function get_last_meta()
    {
       $meta = MetasVenta::where('empresa_id', $this->id)
            ->orderBy('created_at','desc')
            ->first();

        return $meta;
    }

    public function del_meta($meta_id)
    {
        $meta = MetasVenta::where('id', $meta_id);
        $meta->delete();
    }

    public function contactos_empresa()
    {
        return $this->hasMany(ContactoEmpresa::class)->get();
    }

    public function del_contactos_empresa()
    {
       $contactoEmpresa = ContactoEmpresa::where('empresa_id',$this->id)->get();

        if ($contactoEmpresa != null){

            foreach ($contactoEmpresa as $contacto) {
                $contacto->delete();
            }
        }
    }

    public function get_meta_venta($anio,$mes)
    {
        $metaVenta = MetasVenta::where('empresa_id',$this->id)
        ->where('anio',$anio)
        ->where('mes',$mes)
        ->first();

        return $metaVenta;
    }



}
