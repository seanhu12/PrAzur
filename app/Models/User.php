<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @Var array
     */
    protected $fillable = [
        'nombre', 'apellido', 'rut', 'mail', 'password','deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Método que retorna los roles asociadosal User
     *
     * @return
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Rol')->get();
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class)->withTrashed()->get();
    }

    //obtener id roles del user
    public function get_id_roles()
    {
        $idRoles = RolUser::where('user_id', $this->id)->pluck('rol_id')->toArray();
        return $idRoles;
    }

    /**
     * Método que retorna el nombre y apellido del User.
     *
     * @return string nombre y apellido
     */
    public function get_nombre_completo()
    {
        $nombreCompleto = $this->nombre . " " . $this->apellido;
        return ucwords($nombreCompleto);
    }

    /**
     * Método que retorna los Users existentes.
     *
     * @return Collection Users
     */
    public function get_users()
    {
        $users = User::orderBy('nombre')->get();
        return $users;
    }

    public function get_all_users()
    {
        $users = User::withTrashed()->orderBy('nombre')->get();
        return $users;
    }

    public function del_roles()
    {
        //buscar roles antiguos
        $rolesUser = RolUser::where('user_id', $this->id)->get();

        //eliminar roles antiguos
        if ($rolesUser != null) {
            //eliminar roles antiguos
            foreach ($rolesUser as $rol) {
                $rol->delete();
            }
        }
    }


    public function get_user($idUser)
    {
        $user = User::withTrashed()->where('id', $idUser)->first();

        return $user;
    }


    public function get_user_por_rut($rut)
    {
        $user = User::withTrashed()->where('rut', $rut)
            ->whereNotNull('deleted_at')
            ->first();

        return $user;
    }

    public function set_roles($roles)
    {
        $rolesArr = explode(",", $roles);
        $long = count($rolesArr);

        for ($i = 0; $i < $long; $i++) {
            $rolUser = new RolUser([
                'user_id' => $this->id,
                'rol_id' => $rolesArr[$i],
            ]);

            $rolUser->save();
        }
    }

    public function has_rol($rol)
    {
        $rolesUsuario=$this->roles();
        foreach ($rolesUsuario as $rolUsuario){
            if ($rolUsuario->nombre == $rol) {
                return true;
            }
        }
        return false;
    }

    /**
     * Otiene las 7 primeras Notificaciones no borradas del Usuario.
     * @return mixed
     */
    public function get_notificaciones(){
        $notificaciones= Notificacion::orderBy('created_at', 'desc')->where('user_id', $this->id)->take(7)->get();
        return $notificaciones;
    }

    /**
     * Otiene las Notificaciones no borradas del Usuario.
     * @return mixed
     */
    public function get_todas_notificaciones(){
        $notificaciones= Notificacion::orderBy('created_at', 'desc')->where('user_id', $this->id)->get();
        return $notificaciones;
    }

    /**
     * Consulta si alguna de las Notificaciones no borradas no ha sido leída.
     * @return bool
     */
    public function hayNoLeidas(){
        $notificaciones= Notificacion::where('user_id', $this->id)->get();
        foreach ($notificaciones as $notificacion){
            if($notificacion->leido_si_no==0){
                return true;
            }
        }
        return false;
    }




}
