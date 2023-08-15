@extends('layouts.app')

@section('titulo', 'Servicio')
    @section('contenido')

        <div class="card col-lg-12 col-md-12 mx-auto">
            <div class="card-header">
                <div class="col-md-6 col-sm-12">
                    <h3 class="card-title">Servicios</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <div id="data-tag-estado" data-data='{{$estadosJson}}'></div>
                            <label class="form-label">Estado Operacional</label>
                            <div class="input-group">
                                <select id="select-beast-estado" type="text" tabindex="-1" placeholder="Seleccione un estado..." class="form-control"></select>
                                <span class="input-group-append">
                                    <button class="btn btn-primary" onclick="removerFiltroEstado();" type="button"><i class="fas fa-times"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
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
                            <div id="data-tag-etapa" data-data='{{$etapasJson}}'></div>
                            <label class="form-label">Etapa</label>
                            <div class="input-group">
                                <select id="select-beast-etapa" type="text" tabindex="-1" placeholder="Seleccione una etapa..." class="form-control"></select>
                                <span class="input-group-append">
                                    <button class="btn btn-primary" onclick="removerFiltroEtapa();" type="button"><i class="fas fa-times"></i></button>
                                </span>
                            </div>
                        </div>
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
                        <table id="tabla" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>OT</th>
                                    <th>idP</th>
                                    <th data-dynatable-sorts="fechaSort">Fecha Ejecución</th>
                                    <th style="display: none">Fecha Sort</th>
                                    <th>Nombre Servicio</th>
                                    <th>Empresa</th>
                                    <th>Curso</th>
                                    <th>Etapa</th>
                                    <th>Estado</th>
                                    <th data-dynatable-sorts="fechaCreacionSort">Fecha Creación</th>
                                    <th style="display: none">Fecha Creacion Sort</th>
                                    <th>Opciones</th>
                            </thead>
                            <tbody>
                                <?php
                                    $fechaActual = new DateTime($fechaActual);
                                ?>
                                @foreach ($servicios as $servicio)
                                <tr>
                                    <td>{{$servicio->id}}</td>
                                    <td>{{$servicio->propuesta()->idp}}</td>
                                    <td>{{date("d-m-Y", strtotime($servicio->fecha_ejecucion))}}</td>
                                    <td>{{$servicio->fecha_ejecucion}}</td>
                                    <td>{{$servicio->nombre}}</td>
                                    <td>{{$servicio->propuesta()->empresa()->nombre}}</td>
                                    <td>{{$servicio->curso()->nombre_venta}}</td>
                                    <td>
                                        <?php
                                            $fechaEjecucion = new DateTime($servicio->fecha_ejecucion);
                                        ?>
                                        {{-- @if ($servicio->get_last_etapa()->id == 6) --}}
                                            {{$servicio->get_last_etapa()->nombre}}
                                        {{-- @else
                                            @if ($fechaActual >= $fechaEjecucion->modify('-' . $servicio->get_last_etapa()->tiempo_limite . ' days'))
                                                <div style="color:red">{{$servicio->get_last_etapa()->nombre}}</div>
                                            @else
                                                {{$servicio->get_last_etapa()->nombre}}
                                            @endif
                                                {{$servicio->get_last_etapa()->nombre}}
                                        @endif --}}
                                    </td>
                                    <td style="color:red">
                                        @if ($servicio->get_last_estado_operacional()->id == '2')
                                            <div style="color:red">{{$servicio->get_last_estado_operacional()->nombre}}</div>
                                        @else
                                            {{$servicio->get_last_estado_operacional()->nombre}}
                                        @endif
                                    </td>
                                    <td>{{date("d-m-Y", strtotime($servicio->created_at))}}</td>
                                    <td>{{$servicio->created_at}}</td>
                                    <td>
                                        <div class="col-md-12">
                                            @if(Auth::user()->has_rol('Administrador de Servicios') && $servicio->get_last_etapa()->id != 6 && $servicio->get_last_estado_operacional()->id != 5)
                                                <a id="btn-administrar-servicio" href="/servicio/administrar_servicio/{{$servicio->id}}" class="btn btn-teal btn-sm" title="Administrar Servicio"><i class="fas fa-cogs"></i></a>
                                            @endif
                                            @if(Auth::user()->has_rol('Diseñador Técnico'))
                                                <a href="/servicio/disenio_tecnico/{{$servicio->id}}" class="btn btn-teal btn-sm" title="Diseño Técnico"><i class="fas fa-pencil-ruler"></i></a>
                                            @endif
                                            @if(Auth::user()->has_rol('Gestor de Servicios'))
                                                <a class="btn btn-teal btn-sm" href="/servicio/checklist/{{$servicio->id}}" title="Checklist"><i class="fas fa-tasks"></i></a>
                                            @endif
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
        <script src="/js/servicio/servicio.js"></script>
    @endsection

    @section('styles')
        <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/dynatable.css">
        <link rel="stylesheet" href="/css/tabla_grande.css">
    @endsection