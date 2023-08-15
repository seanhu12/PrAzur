<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolUser extends Model
{
    protected $table = 'rol_user';
    /**
     * The attributes that are mass assignable
     *
     * @Var array
     */
    protected $fillable =[
        'rol_id', 'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
}
