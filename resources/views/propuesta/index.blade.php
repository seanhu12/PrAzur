@extends('layouts.app')

@section('titulo', 'Propuestas')
    @section('contenido')

        <div class="card col-lg-12 col-md-12 mx-auto">
            <div class="card-header">
                <div class="col-md-6 col-sm-12">
                    <h3 class="card-title">Propuestas</h3>
                </div>
                <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                    <a href="/propuesta/create" class="btn btn-cyan" title="Crear Nueva Propuesta"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <div id="data-tag-estado" data-data='{{$estadosJson}}'></div>
                            <label class="form-label">Estado</label>
                            <div class="input-group">
                                <select id="select-beast-estado" type="text" tabindex="-1" placeholder="Seleccione un estado..." class="form-control"></select>
                                <span class="input-group-append">
                                    <button class="btn btn-primary" onclick="removerFiltroEstado();" type="button"><i class="fas fa-times"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label class="form-label">idp</label>
                            <div class="input-group">
                                <input id="buscar-idp" type="text" class="form-control" placeholder="Buscar por idp...">
                                <span class="input-group-append">
                                    <button class="btn btn-primary" onclick="removerFiltroOt();" type="button"><i class="fas fa-times"></i></button>
                                </span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-md-4 col-sm-6">
                        <div id="data-tag-fecha" data-data='{{$fechaActual}}'></div>
                        <label class="form-label">Fecha Inicio</label>
                        <div class="input-group">
                            <input id="fecha-inicio" onchange="" type="date" class="form-control" name="fecha-inicio" placeholder="Fecha Inicio">
                            <span class="input-group-append">
                                <button class="btn btn-primary" onclick="removerFiltroFechaInicio();" type="button"><i class="fas fa-times"></i></button>
                            </span>
                        </div>
                        <div id="fecha-inicio-alert" class="invalid-feedback">La fecha ingresada no puede ser futura</div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <label class="form-label">Fecha Termino</label>
                        <div class="input-group">
                            <input id="fecha-termino" onchange="" type="date" class="form-control" name="fecha-termino" placeholder="Fecha Término">
                            <span class="input-group-append">
                                <button class="btn btn-primary" onclick="removerFiltroFechaTermino();" type="button"><i class="fas fa-times"></i></button>
                            </span>
                        </div>
                        <div id="fecha-termino-alert" class="invalid-feedback">La fecha ingresada no puede ser futura</div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <div id="data-tag-empresa" data-data='{{$empresasJson}}'></div>
                            <label class="form-label">Empresa</label>
                            <div class="input-group">
                                <select id="select-beast-empresa" type="text" tabindex="-1" placeholder="Seleccione una empresa..." class="form-control"></select>
                                <span class="input-group-append">
                                    <button class="btn btn-primary" onclick="removerFiltroEmpresa();" type="button"><i class="fas fa-times"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <div id="data-tag-programa" data-data='{{$programasJson}}'></div>
                            <label class="form-label">Programa</label>
                            <div class="input-group">
                                <select id="select-beast-programa" type="text" tabindex="-1" placeholder="Seleccione un programa..." class="form-control"></select>
                                <span class="input-group-append">
                                    <button class="btn btn-primary" onclick="removerFiltroPrograma();" type="button"><i class="fas fa-times"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <div id="data-tag-curso" data-data='{{$cursosJson}}'></div>
                            <label class="form-label">Curso</label>
                            <div class="input-group">
                                <select id="select-beast-curso" type="text" tabindex="-1" placeholder="Seleccione un curso..." class="form-control"></select>
                                <span class="input-group-append">
                                    <button class="btn btn-primary" onclick="removerFiltroCurso();" type="button"><i class="fas fa-times"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div style="overflow-x:auto;">
                            <table id="tabla" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>idP</th>
                                        <th data-dynatable-sorts="fechaSort">Fecha Creación</th>
                                        <th style="display: none">Fecha Sort</th>
                                        <th data-dynatable-sorts="fechaCompromisoSort">Fecha Compromiso</th>
                                        <th style="display: none">Fecha Compromiso Sort</th>
                                        <th>Empresa</th>
                                        <th>Programa Curso</th>
                                        {{-- <th>Monto</th> --}}
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($propuestas as $propuesta)
                                    <tr>
                                        <td>{{$propuesta->idp}}</td>
                                        <td>{{date("d-m-Y", strtotime($propuesta->fecha_propuesta))}}</td>
                                        <td>{{$propuesta->fecha_propuesta}}</td>
                                        <td>{{date("d-m-Y", strtotime($propuesta->fecha_compromiso))}}</td>
                                        <td>{{$propuesta->fecha_compromiso}}</td>
                                        <td>{{$propuesta->empresa()->nombre}}</td>
                                        <td>
                                            @if ($propuesta->programa_id != null)
                                                {{$propuesta->programa()->nombre}}
                                            @endif
                                            @if ($propuesta->curso_id != null)
                                                {{$propuesta->curso()->nombre_venta}}
                                            @endif
                                        </td>
                                        {{-- <td>{{$propuesta->monto}}</td> --}}
                                        <td>{{$propuesta->get_last_estado()->nombre}}</td>
                                        <td>
                                            <div class="col-md-12">
                                                @if ($propuesta->get_last_estado()->nombre == 'No Enviada' || $propuesta->get_last_estado()->nombre == 'Enviada')
                                                    {{-- <button id="btn-estados" class="btn btn-primary btn-sm" onclick="desplegarEstados({{$propuesta->id}},'{{$propuesta->get_last_estado()->nombre}}');">Actualizar Estado</button> --}}
                                                    <button id="btn-estados" class="btn btn-teal btn-sm" onclick="desplegarEstados({{$propuesta}},'{{$propuesta->get_last_estado()->nombre}}');" title="Actualizar Estado"><i class="fas fa-history"></i></button>
                                                @endif
                                                @if ($propuesta->get_last_estado()->nombre == 'Aceptada')
                                                    {{-- <a class="btn btn-primary btn-sm" href="/propuesta/crear_servicios/{{$propuesta->id}}">Confirmar Servicio</a> --}}
                                                    <a class="btn btn-teal btn-sm" href="/propuesta/crear_servicios/{{$propuesta->id}}" title="Confirmar Servicio" ><i class="fas fa-calendar-check"></i></a>
                                                @endif
                                                {{-- <a class="btn btn-primary btn-sm" href="/propuesta/show/{{$propuesta->id}}">Detalles</a> --}}
                                                <a class="btn btn-teal btn-sm" href="/propuesta/show/{{$propuesta->id}}" title="Detalles" ><i class="fas fa-info"></i></a>
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
        </div>



        <div class="modal fade" id="modal-estados" tabindex="-1" role="dialog" aria-labelledby="estados-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="estados-label">Actualizar Estado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="form-label">Estado Actual</label>
                                <div id="estado-actual" class="form-control-plaintext"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <div id="data-propuesta" value=''></div>
                                <label for="select-estados" class="form-label">Estados</label>
                                <select class="form-control" name="select-estados" id="select-estados" onchange="ingresaMotivo();"></select>
                            </div>
                        </div>
                        <div id="motivos-div" class="row" hidden>
                            <div class="col-md-12 form-group">
                                <div id="data-tag-motivo" data-data='{{$motivosJson}}'></div>
                                <label for="motivos" class="form-label">Motivo</label>
                                <select id="motivos" class="form-control" name="motivo"></select>
                            </div>
                        </div>
                        <div id="mensaje-validacion" class="row" hidden>
                            <div class="col-md-12">
                                <div class="alert alert-warning" role="alert">
                                    Se debe ingresar el monto y curso/programa para poder cambiar el estado a Enviada.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn-cambiar-estado" type="button" onclick="cambiarEstado();" class="btn btn-cyan text-right">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>



    @endsection

    @section('scripts')
        <script src="/components/dynatable/jquery.dynatable.js"></script>
        <script src="/js/propuesta/propuesta.js"></script>
    @endsection

    @section('styles')
        <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/dynatable.css">
        <link rel="stylesheet" href="/css/tabla_grande.css">
    @endsection