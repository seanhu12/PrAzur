@extends('layouts.app')

@section('titulo', 'Información Usuario')
    @section('contenido')

        <div class="card col-lg-7 col-md-12 mx-auto">
            <div class="card-header">
                <div class="col-md-4 col-sm-12">
                    <h3 class="card-title">Información Usuario</h3>
                </div>
                @if ($user->deleted_at == null)
                <div class="col-md-8 col-sm-12 card-title text-right" style="color: white">
                    @if(Auth::user()->has_rol('Administrador de Usuarios'))
                        <a href="/usuario/cambiar_password/{{$user->id}}" class="btn  btn-cyan" title="Cambiar contraseña" style="width: 45px"><i class="fas fa-key"></i></a>
                        <a href="/usuario/edit/{{$user->id}}" class="btn  btn-blue" title="Editar Usuario" style="width: 45px"><i class="fas fa-edit"></i></a>
                        <button id="button_deshabilitar" onclick="eliminarUsuario({{$user->id}});"class="btn btn-indigo" title="Eliminar Usuario" style="width: 45px"><i class="fas fa-trash-alt"></i></button>
                    @endif
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Nombre</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{$user->nombre}}</div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Apellido</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{$user->apellido}}</div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Correo Electrónico</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{$user->mail}}</div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">RUT</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{$user->rut}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="form-label">Roles</label>
                                        <hr style="margin-top: 0px; margin-bottom: .375rem">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rolesUser as $rol)
                                <tr>
                                    <td>- {{$rol->nombre}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row card-footer">
                @if(Auth::user()->has_rol('Administrador de Usuarios'))
                    <a href="/usuario" class="btn btn-secondary" role="button">Volver</a>
                @else
                    <a href="javascript:history.back()" class="btn btn-secondary" role="button">Volver</a>
                @endif
            </div>
        </div>

    @endsection

    @section('scripts')
        <script src="/js/usuario/destroy.js"></script>
    @endsection

    @section('styles')
        <link href="/css/label_show.css" rel="stylesheet">
    @endsection
