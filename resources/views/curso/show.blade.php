@extends('layouts.app')

@section('titulo', 'Información Curso')
@section('contenido')

    <div class="card col-lg-10 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Información Curso</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                @if(Auth::user()->has_rol('Diseñador Técnico'))
                    <a href="/estructura/{{$curso->id}}" class="btn btn-cyan" title="Ver Estructuras" style="width: 45px"><i class="far fa-sticky-note"></i></a>
                @endif
                @if(Auth::user()->has_rol('Gestor de Cursos'))
                    <a href="/curso/edit/{{$curso->id}}" class="btn btn-blue" title="Editar" style="width: 45px"><i class="fas fa-edit"></i></a>
                    {{-- <button id="button_deshabilitar" class="btn  btn-indigo" onclick="deshabilitarCurso({{$curso->id}});" title="Eliminar" style="width: 45px"><i class="fas fa-trash-alt"></i></button> --}}
                @endif
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group card-list-group">
                <li class="list-group-item py-5">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Código</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext">{{$curso->codigo}}</div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Nombre de Venta</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext">{{$curso->nombre_venta}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Descripción</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext">{{$curso->descripcion}}</div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item py-5">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Temática</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext">{{$tematica->nombre}}</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Año de Creación</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext">{{$curso->anio_creacion}}</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Cantidad de Participantes</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext" id="participantes">{{$curso->cant_participantes}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Cantidad de Horas Prácticas</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext" id="practicas">{{$curso->cant_horas_practicas}}</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Cantidad de Horas Teóricas</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext" id="teoricas">{{$curso->cant_horas_teoricas}}</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Cantidad de Horas Totales</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext" id="total">{{$curso->cant_horas}}</div>
                            </div>
                        </div>
                    </div>
                </li>
                @if($sence)
                    <li class="list-group-item py-5">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Código SENCE</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{$curso->codigo_sence}}</div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Nombre de SENCE</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{$curso->nombre_sence}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Fecha Vencimiento Vigencia</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{date("d-m-Y", strtotime($curso->vigencia))}}</div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endIf
                {{--<div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Estructura del Curso</label>
                            <a href="download/{{$curso->id}}" class="btn btn-primary pull-left"><i class="icon-download-alt"> </i> Descargar Estructura </a>
                        </div>
                    </div>
                </div>--}}
        </div>
        <div class="row card-footer">
            @if(Auth::user()->has_rol('Gestor de Cursos'))
                <a href="/curso" class="btn btn-secondary" role="button">Volver</a>
            @else
                <a href="javascript:history.back()" class="btn btn-secondary" role="button">Volver</a>
            @endif

        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/curso/destroy.js"></script>
    <script src="/js/formato_numeros.js"></script>
    <script src="/js/curso/show.js"></script>
@endsection

@section('styles')
    <link href="/css/label_show.css" rel="stylesheet">
@endsection