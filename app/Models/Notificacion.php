<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notificacion extends Model
{
    use SoftDeletes;
    protected $table = 'notificacions';

    protected $fillable = [
        'mensaje',
        'direccion',
        'tipo',
        'leido_si_no',
        'user_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class)->withTrashed()->first();
    }


    public function get_notificaciones()
    {
        $notificaciones = Notificacion::orderBy('created_at')->get();

        return $notificaciones;
    }

    public function get_notificacion($idNotificacion)
    {
        $notificacion = Notificacion::where('id', $idNotificacion)->first();

        return $notificacion;
    }
}
