<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factura extends Model
{
    use SoftDeletes;
    protected $table = 'facturas';

    protected $fillable = [
        'numero',
        'monto',
        'fecha_emision',
        'fecha_pago',
        'orden_compra_id',
    ];

    public function orden_compra()
    {
        return $this->belongsTo(OrdenCompra::class)->withTrashed()->first();
    }
}
