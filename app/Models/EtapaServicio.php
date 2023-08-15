<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EtapaServicio extends Model
{
    protected $table = 'etapa_servicio';
    protected $fillable = [
        'etapa_id',
        'servicio_id',
        'end_date'
    ];

    public function etapa()
    {
        return $this->belongsTo(Etapa::class)->first();
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class)->first();
    }

    public function get_etapa_servicio($etapa_id, $servicio_id)
    {
        $etapaServicio = EtapaServicio::where('etapa_id', $etapa_id)
            ->where('servicio_id', $servicio_id)
            ->first();

        return $etapaServicio;
    }

    public function set_end_update()
    {
        //se obiene la penulima etapa del servicio
        $etapaAnterior=EtapaServicio::where('servicio_id', $this->servicio_id)
                ->where('etapa_id','<>',$this->etapa_id)
                ->orderBy('created_at','desc')
                ->first();
        $etapa = $this->etapa_id;

        if ($etapa > 1 and $etapa < 6) {
            //actualizar end_date de etapa_servicio anterior
            $etapaAnterior->update([
                'end_date' => $this->created_at
            ]);

        } elseif ($etapa == 6) {
            //actualizar end_date de etapa_servicio anterior
            $etapaAnterior->update([
                'end_date' => $this->created_at
            ]);

            //actualizar end_date de etapa_servicio actualo (cerrado)
            EtapaServicio::where('servicio_id', $this->servicio_id)
                ->where('etapa_id', $etapa)
                ->update(['end_date' => $this->created_at]);
        }
    }
}
