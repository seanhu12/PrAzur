@extends('layouts.app')

@section('titulo', 'Usuarios')
    @section('contenido')

        <div class="card col-lg-10 col-md-12 mx-auto">
            <div class="card-header">
                <div class="col-md-6">
                    <h3 class="card-title">Notificaciones</h3>
                </div>
                <div class="col-md-6 text-right">
                    <button onclick="leerTodasEnLista({{Auth::user()->id}},'{{Auth::user()->get_notificaciones()}}')" class="btn btn-cyan">Marcar todas como leídas</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="tabla" class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Notificación</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notificaciones as $notificacion)
                                <tr>
                                    <td>{{$notificacion->mensaje}}</td>
                                    <td>{{date("d-m-Y", strtotime($notificacion->created_at))}}</td>
                                    @if ($notificacion->tipo == 'Atraso')
                                        <td>
                                            <div style="color:red">{{$notificacion->tipo}}</div>
                                        </td>
                                    @else
                                        <td>
                                            <div style="color:orange">{{$notificacion->tipo}}</div>
                                        </td>
                                    @endif
                                    @if ($notificacion->leido_si_no == 1)
                                        <td>
                                            <i class="fas fa-envelope-open" title="Leído"></i>
                                        </td>
                                    @else
                                        <td>
                                            <i class="fas fa-envelope" title="No leído"></i>
                                        </td>
                                    @endif
                                    <td>
                                        <div class="col-md-12 text-center">
                                            <a href="{{$notificacion->direccion}}" class="btn btn-cyan btn-sm" title="Ir a"><i class="fas fa-arrow-circle-right"></i></a>
                                            @if ($notificacion->leido_si_no == 0)
                                                <button class="btn btn-cyan btn-sm" onclick="leerEnLista({{$notificacion->id}});" title="Marcar como leído"><i class="fas fa-envelope-open-text"></i></button>
                                            @endif
                                            <button class="btn btn-cyan btn-sm" onclick="deshabilitarNotificacionEnLista({{$notificacion->id}});" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
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
        <script src="/js/usuario/notificaciones.js"></script>
    @endsection

    @section('styles')
        <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/dynatable.css">
    @endsection