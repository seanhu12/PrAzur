<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetasVenta extends Model
{
    protected $table='metas_ventas';
    protected $fillable=[
        'anio',
        'mes',
        'fecha_reporte',
        'monto_vendido',
        'monto_meta',
        'empresa_id',
    ];


    public function empresa()   
    {
        return $this->belongsTo(Empresa::class)->first();
    }

    public function get_meta($id)
    {
        $meta = MetasVenta::where('id', $id)->first();

        return $meta;
    }

    public function get_monto_acumulado()
    {
        $monto_acumulado = Propuesta::where('empresa_id',$this->empresa_id)
            ->join('estado_propuesta','propuestas.id','estado_propuesta.propuesta_id')
            ->where('estado_propuesta.estado_id', 6)
            ->sum('monto_final');

        return $monto_acumulado;
    }

    public function get_nombre_mes()
    {
        $meses = ["Mes", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre",];
        return $meses[$this->mes];
    }
}
