@extends('layouts.app')

@section('titulo', 'Usuarios')
    @section('contenido')

        <div class="card col-lg-12 col-md-12 mx-auto">
            <div class="card-header">
                <div class="col-md-6 col-sm-12">
                    <h3 class="card-title">Usuarios</h3>
                </div>
                <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                    <a href="/usuario/create" class="btn btn-cyan" title="Crear Nuevo Usuario"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-right"> --}}
                            {{-- <label>Mostrar Usuarios Inactivos</label> --}}
                            {{-- <label class="custom-switch">
                                <input id="inactivos" type="checkbox" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Mostrar Usuarios Inactivos</span>
                            </label> --}}
                            {{-- <input id="inactivos" class="form-control" type="checkbox" value="Activo"> --}}
                            {{-- <select id="inactivos" class="form-control">
                                <option value="Inactivo">Si</option>
                                <option value="Activo">No</option>
                            </select> --}}
                        {{-- </div>
                    </div>
                </div> --}}
                {{-- <hr style="margin-top:1rem; margin-bottom:1rem"> --}}
                <div class="row">
                    <div class="col-md-12">
                        <table id="tabla" class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>RUT</th>
                                    <th>Correo Electrónico</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->nombre}}</td>
                                    <td>{{$user->apellido}}</td>
                                    <td>{{$user->rut}}</td>
                                    <td>{{$user->mail}}</td>
                                    <td>@if ($user->deleted_at == null)
                                        Activo
                                    @else
                                        Inactivo
                                    @endif</td>
                                    <td>
                                        <div class="col-md-12 text-center">
                                            <a href="/usuario/show/{{$user->id}}" class="btn  btn-teal btn-sm" title="Detalles"><i class="fas fa-info"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('scripts')
        <script src="/components/dynatable/jquery.dynatable.js"></script>
        <script src="/js/usuario/usuario.js"></script>
    @endsection

    @section('styles')
        <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/dynatable.css">
    @endsection