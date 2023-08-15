<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //

    protected $fillable = ['nombre'];

    public function user()
    {
        return $this->belongsToMany('App\User')->withTrashed()->get();
    }

    /**
     * Método que retorna todos lo roles existentes.
     *
     * @return Array nombre de los roles.
     */
    public function get_roles()
    {
        $roles = Rol::orderBy('nombre')->get();
        return $roles;
    }
}
