<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Servicio;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use App\Models\RolUser;
use App\Http\Controllers\Servicios\Comun;
use App\Http\Requests\createUserRequest;

class UsuarioController extends Controller
{


    /**
     * Desplegar lista de Usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtener todos los users
        $user = new User();
        // $users = $user->get_all_users();
        $users = $user->get_users();

        return view('usuario.index')
            ->with(compact('users'));
    }

    /**
     * Crear un Usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //obtener roles
        $rol = new Rol;
        $roles = $rol->get_roles();
        $rolesJson = json_encode($roles);

        return view('usuario.create')
            ->with(compact('rolesJson'));
    }

    /**
     * Guardar un Usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Verificar si usario fue eliminado
        $user = new User();
        $user = $user->get_user_por_rut($request->input('rut'));
        if ($user != null) {
            //validación usuario
            $this->validate($request, [
                'mail' => 'required|unique:users,mail,' . $user->id,
                'rut' => 'required',
            ]);
            //Almacenar usuario
            $user->update([
                'nombre' => $request->input('nombre'),
                'apellido' => $request->input('apellido'),
                'password' => bcrypt($request->input('password')),
                'mail' => $request->input('mail'),
                'deleted_at' => null
            ]);
        } else {
            //validación usuario
            $this->validate($request, [
                'mail' => 'required|unique:users,mail',
                'rut' => 'required|unique:users,rut',
            ]);
            //Almacenar usuario
            $user = new User([
                'nombre' => $request->input('nombre'),
                'apellido' => $request->input('apellido'),
                'rut' => $request->input('rut'),
                'password' => bcrypt($request->input('password')),
                'mail' => $request->input('mail'),
            ]);
            $user->save();
        }

        //Asignar roles
        $roles = $request->input('roles');
        $user->set_roles($roles);
    }


    /**
     * Mostrar datos de un Usuario.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = new User();
        $user = $user->get_user($id);
        $rolesUser = $user->roles();
        return view('usuario.show')
            ->with(compact('user'))
            ->with(compact('rolesUser'));
    }

    /**
     * Editar datos de un Usuario.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener roles
        $rol = new Rol;
        $roles = $rol->get_roles();
        $rolesJson = json_encode($roles);

        //Obtener usuario
        $user = new User();
        $user = $user->get_user($id);
        $rolesUser = $user->get_id_roles();

        $rolesUserArray = json_encode($rolesUser);

        return view('usuario.edit')
            ->with(compact('rolesJson'))
            ->with(compact('user'))
            ->with(compact('rolesUserArray'));
    }

    /**
     * Actualizar datos de un Usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validación mail
        $this->validate($request, [
            'mail' => 'required|unique:users,mail,' . $id,
        ]);

        //Obtener user
        $user = new User();
        $user = $user->get_user($id);

        //Actulizar datos del user
        $user->update([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'mail' => $request->input('mail')
        ]);

        //eliminar roles antiguos
        $user->del_roles();

        //Asignar nuevos roles
        $roles = $request->input('roles');
        $user->set_roles($roles);
    }

    /**
     * Editar contrasenia de un Usuario.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function cambiarPassword($id)
    {
        //Obtener usuario
        $user = new User();
        $user = $user->get_user($id);

        return view('usuario.cambiar_password')
            ->with(compact('user'));
    }

    /**
     * Actualizar contrasenia de un Usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function actualizarPassword(Request $request, $id)
    {
        //Obtener user
        $user = new User();
        $user = $user->get_user($id);

        //Actulizar datos del user
        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);
    }

    /**
     * Eliminar un Usuario.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        //obtener user
        $user = new User();
        $user = $user->get_user($id);

        //eliminar roles antiguos
        $user->del_roles();

        //eliminar user
        $user->delete();
    }

    /**
     * Comprueba si tiene notificaciones para el usuario.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function comprobarNotificacionesNuevas($id)
    {

    }

    /**
     * Obtener notificaciones para el usuario.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function ObtenerNotificaciones($id)
    {

    }


    /**
     * Marca como leído una notificacion para el Usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function leerNotificacion(Request $request)
    {
        $id=$request->input("id");
        $notificacion= new Notificacion();
        $notificacion=$notificacion->get_notificacion($id);
        $notificacion->update([
            "leido_si_no" => 1,
        ]);
    }

    /**
     * Marca como leído todas las notificaciones para el Usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function leerVariasNotificaciones(Request $request)
    {
        $id=$request->input("id");
        $usuario= new User();
        $usuario=$usuario->get_user($id);
        $notificaciones=$usuario->get_notificaciones();
        foreach ($notificaciones as $notificacion){
            $notificacion->update([
                "leido_si_no" => 1,
            ]);
        }
    }

    /**
     * Marca como leído todas las notificaciones para el Usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function leerTodasNotificaciones(Request $request)
    {
        $id=$request->input("id");
        $usuario= new User();
        $usuario=$usuario->get_user($id);
        $notificaciones=$usuario->get_todas_notificaciones();
        foreach ($notificaciones as $notificacion){
            $notificacion->update([
                "leido_si_no" => 1,
            ]);
        }
    }

    /**
     * Elimina una notificacion para el Usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyNotificacion(Request $request)
    {
        $id=$request->input("id");
        $notificacion= new Notificacion();
        $notificacion=$notificacion->get_notificacion($id);
        $notificacion->delete();
    }

    /**
     * Desplegar las notificaciones del usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function mostrarNotificaciones($id)
    {
        //Obtener todos los users
        $user = new User();
        // $users = $user->get_all_users();
        $user = $user->get_user($id);

        $notificaciones = $user->get_todas_notificaciones();

        return view('usuario.notificaciones')
            ->with(compact('notificaciones'));
    }
}
