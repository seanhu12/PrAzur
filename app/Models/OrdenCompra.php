<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdenCompra extends Model
{
    //use SoftDeletes;
    protected $table = 'orden_compras';

    protected $fillable = [
        'numero',
        'empresa_id',
        'servicio_id',
    ];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class)->withTrashed()->first();
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class)->withTrashed()->get();
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class)->withTrashed()->first();
    }

    public function get_ordenes()
    {
        $ordenCompra = OrdenCompra::orderBy('created_at')->get();

        return $ordenCompra;
    }

    public function get_orden($idOrden)
    {
        $ordenCompra = OrdenCompra::where('id', $idOrden)->first();

        return $ordenCompra;
    }
}
