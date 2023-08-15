@extends('layouts.app')

@section('titulo', 'Generar Diplomas')
@section('contenido')

    <div class="card col-lg-12 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-12 col-sm-12">
                <h3 class="card-title">Generar diplomas para el servicio: {{$servicio->nombre}}, impartido {{$fecha}}</h3>
            </div>
        </div>
        <div id="mensaje-validacion" class="row" hidden>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    No hay participantes calificados para generar diplomas.
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Nombre Curso*</label>
                        <div class="input-group">
                            <select class="form-control" id="nombre-curso">
                                <option value="{{$curso->nombre_venta}}">{{$curso->nombre_venta}}</option>
                                @if($curso->nombre_sence!="")
                                    <option value="{{$curso->nombre_sence}}">{{$curso->nombre_sence}}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Tipo Fondo Diploma*</label>
                        <div class="input-group">
                            <select class="form-control" id="tipo-fondo">
                                <option value="1">Aves</option>
                                <option value="2">Piedras</option>
                                <option value="3">Horizontal</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Leyenda</label>
                        <input id="leyenda"   type="text" class="form-control" name="leyenda" placeholder="tiempo, lugar, etc..." maxlength="191" >
                        <div id="leyenda-alert" class="invalid-feedback">Debe ingresar una leyenda que tenga máximo 191 caracteres.</div>
                    </div>
                </div>
            </div>
            <table id="tabla" class="table table-striped table-bordered text-center">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>RUT</th>
                    <th>Porcentaje de Asistencia</th>
                    <th>Promedio</th>
                    <th>Estado Actual</th>
                    <th>Estado Impresión</th>
                </thead>
                <tbody>
                <div id="participantes" data-data="{{$datosJsonParticipantes}}"></div>
                <div id="fecha" data-fecha="{{$fecha}}"></div>
                @foreach ($datosParticipantes as $key=>$participante)
                    <tr>
                        <td>{{$participante->nombre}}</td>
                        <td>{{$participante->rut}}</td>
                        <td>{{$participante->asistencia}}%</td>
                        <td>{{$participante->avg_nota}}</td>
                        <td>{{$participante->estado}}</td>
                        <td>
                            <select  class="form-control" id="estado-impresion-{{$participante->rut}}">
                                @if($participante->estado=="Aprobación con Distinción")
                                    <option value="Aprobación">Aprobación</option>
                                    <option selected value="Aprobación con Distinción">Aprobación con Distinción</option>
                                    <option value="Participación">Participación</option>
                                    <option value="Reprobación">Reprobación</option>
                                @else
                                    @if($participante->estado=="Aprobación")
                                        <option value="Reprobación">Reprobación</option>
                                        <option value="Aprobación con Distinción">Aprobación con Distinción</option>
                                        <option selected value="Aprobación">Aprobación</option>
                                        <option value="Participación">Participación</option>
                                    @else
                                        @if($participante->estado=="Participación")
                                            <option value="Reprobación">Reprobación</option>
                                            <option value="Aprobación con Distinción">Aprobación con Distinción</option>
                                            <option value="Aprobación">Aprobación</option>
                                            <option selected value="Participación">Participación</option>
                                            @else
                                                <option selected value="Reprobación">Reprobación</option>
                                                <option value="Aprobación con Distinción">Aprobación con Distinción</option>
                                                <option value="Aprobación">Aprobación</option>
                                                <option value="Participación">Participación</option>
                                            @endif
                                    @endif
                                @endif
                            </select>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="card-footer row">
                <div class="col-md-6 col-sm-12">
                    <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                </div>
                <div class="col-md-3 col-sm-12 text-right">
                    <button type="button" onclick="enviarDatos(1);" id="button-generar-con" class="btn btn-primary" >Generar Diplomas con fondo</button>
                </div>
                <div class="col-md-3 col-sm-12 text-right">
                    <button type="button" onclick="enviarDatos(0);" id="button-generar-sin" class="btn btn-primary" >Generar Diplomas sin fondo</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
            <script src="/components/dynatable/jquery.dynatable.js"></script>
            <script src="/js/validaciones/validacion_no_nulo.js"></script>
            <script src="/js/servicio/diplomas/diploma_servicio.js"></script>
@endsection

@section('styles')
            <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
            <link rel="stylesheet" href="/css/dynatable.css">
@endsection