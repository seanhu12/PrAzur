@extends('layouts.app')

@section('titulo','Home')
    @section('contenido')
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="row row-cards">
                <div class="col-6 col-sm-4 col-lg-2" title="Cantidad de servicios a ejecutarse en los proximos {{$dias}} días">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            {{-- <div class="text-right text-green">
                                -
                            </div> --}}
                            <div class="h1 m-0">{{$serviciosProxDias}}</div>
                            <table style="width: 100%">
                                <tr>
                                    <td style="height: 45px; vertical-align: middle;">
                                        <div class="text-muted">Servicios prox. {{$dias}} Días</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-lg-2" title="Cantidad de servicios que se encuentran en etapa de cierre">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            {{-- <div class="text-right text-green">
                                -
                            </div> --}}
                            <div class="h1 m-0">{{$serviciosCierre}}</div>
                            <table style="width: 100%">
                                <tr>
                                    <td style="height: 45px; vertical-align: middle;">
                                        <div class="text-muted">Servicios en Cierre</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-lg-2" title="Cantidad de servicios que se encuentran atrasados">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            {{-- <div class="text-right text-green">
                                -
                            </div> --}}
                            <div class="h1 m-0">{{$serviciosAtrasados}}</div>
                            <table style="width: 100%">
                                <tr>
                                    <td style="height: 45px; vertical-align: middle;">
                                        <div class="text-muted">Servicios Atrasados</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                @php
                    $comun = new App\Http\Controllers\Servicios\Comun()
                @endphp
                <div class="col-6 col-sm-4 col-lg-2" title="Cantidad de servicios que se van a ejecutar en {{$comun->mes(date('m'))}}">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            {{-- @if ($serviciosMesAnterior >= 0)
                                <div class="text-right text-green">
                                    {{$serviciosMesAnterior}}%
                                    <i class="fe fe-chevron-up"></i>
                                </div>
                            @else
                                <div class="text-right text-red">
                                    {{$serviciosMesAnterior}}%
                                    <i class="fe fe-chevron-down"></i>
                                </div>
                            @endif --}}
                            <div class="h1 m-0">{{$serviciosMes}}</div>
                            <table style="width: 100%">
                                <tr>
                                    <td style="height: 45px; vertical-align: middle;">
                                        <div class="text-muted">Servicios {{$comun->mes(date('m'))}}</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-lg-2" title="Cantidad de propuestas que se han confirmado en {{$comun->mes(date('m'))}}">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            {{-- @if ($propuestasConfirmadasMesAnterior >= 0)
                                <div class="text-right text-green">
                                    {{$propuestasConfirmadasMesAnterior}}%
                                    <i class="fe fe-chevron-up"></i>
                                </div>
                            @else
                                <div class="text-right text-red">
                                    {{$propuestasConfirmadasMesAnterior}}%
                                    <i class="fe fe-chevron-down"></i>
                                </div>
                            @endif --}}
                            <div class="h1 m-0">{{$confirmacionesMes}}</div>
                            <table style="width: 100%">
                                <tr>
                                    <td style="height: 45px; vertical-align: middle;">
                                        <div class="text-muted">Confirmaciones {{$comun->mes(date('m'))}}</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-lg-2" title="Cantidad de propuestas que han sido enviadas en {{$comun->mes(date('m'))}}">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            {{-- @if ($propuestasEnviadasMesAnterior >= 0)
                                <div class="text-right text-green">
                                    {{$propuestasEnviadasMesAnterior}}%
                                    <i class="fe fe-chevron-up"></i>
                                </div>
                            @else
                                <div class="text-right text-red">
                                    {{$propuestasEnviadasMesAnterior}}%
                                    <i class="fe fe-chevron-down"></i>
                                </div>
                            @endif --}}
                            <div class="h1 m-0">{{$propuestasEnviadas}}</div>
                            <table style="width: 100%">
                                <tr>
                                    <td style="height: 45px; vertical-align: middle;">
                                        <div class="text-muted">Propuestas Enviadas {{$comun->mes(date('m'))}}</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <div class="card" title="Cantidad de servicios mes">
                        <div class="card-body" style="padding: 1rem; padding-left: 0rem">
                            <div id="data-tag-servicios-mes" data-data="{{$serviciosMesGrafico}}"></div>
                            <div id="data-tag-meses" data-data="{{$meses}}"></div>
                            <div id="servicios-mes" title=""></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <div class="card" title="Cantidad de servicios etapa">
                        <div class="card-body" style="padding: 1rem; padding-left: 0rem;">
                            <div id="data-tag-servicios-etapa" data-data="{{$serviciosEtapa}}"></div>
                            <div id="servicios-etapa" title=""></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-8 col-md-2">
                    <div class="form-group">
                        <button id="ocultar-servicio" class="btn btn-cyan btn-sm" style="width: 100%">Ocultar Servicios</i></button>
                        <button id="mostrar-servicio" class="btn btn-cyan btn-sm" style="width: 100%" hidden>Mostrar Servicios</button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button id="ocultar-propuesta" class="btn btn-cyan btn-sm" style="width: 100%">Ocultar Propuestas</i></button>
                        <button id="mostrar-propuesta" class="btn btn-cyan btn-sm" style="width: 100%" hidden>Mostrar Propuestas</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div id="servicio" class="row">
                        <div class="col-md-12 col-lg-8 col-xl-9">
                            <div class="card">
                                <div class="card-header">
                                    <div class="col-md-12 col-sm-12">
                                        <h3 class="card-title">Servicios</h3>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div style="overflow-x:auto;">
                                        <table id="tabla-servicio" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th data-dynatable-sorts="id">OT</th>
                                                    <th style="display: none">id</th>
                                                    <th>idP</th>
                                                    <th data-dynatable-sorts="fechaSort">Fecha Ejecución</th>
                                                    <th style="display: none">Fecha Sort</th>
                                                    <th>Empresa</th>
                                                    <th>Etapa</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($servicios as $servicio)
                                                <tr>
                                                    <td><a href="/servicio/checklist/{{$servicio->id}}" style="color: #495057">{{$servicio->id}}</a></td>
                                                    <td>{{$servicio->id}}</td>
                                                    <td>{{$servicio->propuesta()->idp}}</td>
                                                    <td>{{date("d-m-Y", strtotime($servicio->fecha_ejecucion))}}</td>
                                                    <td>{{$servicio->fecha_ejecucion}}</td>
                                                    <td>{{$servicio->propuesta()->empresa()->nombre}}</td>
                                                    <td>
                                                        <?php
                                                            $fechaEjecucion = new DateTime($servicio->fecha_ejecucion);
                                                        ?>
                                                        @if ($servicio->get_last_etapa()->id == 6)
                                                            {{$servicio->get_last_etapa()->nombre}}
                                                        @else
                                                                {{$servicio->get_last_etapa()->nombre}}
                                                        @endif
                                                    </td>
                                                    <td style="color:red">
                                                        @if ($servicio->get_last_estado_operacional()->id == '2')
                                                            <div style="color:red">{{$servicio->get_last_estado_operacional()->nombre}}</div>
                                                        @else
                                                            {{$servicio->get_last_estado_operacional()->nombre}}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-lg-4 col-xl-3">
                            {{-- <h4 id="filtro-servicio">Filtros Servicios</h4> --}}
                            <div id="filtro-fecha-inicio-servicio" class="col-md-12 col-sm-12">
                                <div class="form-group">
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
                            </div>
                            <div id="filtro-fecha-termino-servicio" class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Fecha Termino</label>
                                    <div class="input-group">
                                        <input id="fecha-termino" onchange="" type="date" class="form-control" name="fecha-termino" placeholder="Fecha Término">
                                        <span class="input-group-append">
                                            <button class="btn btn-primary" onclick="removerFiltroFechaTermino();" type="button"><i class="fas fa-times"></i></button>
                                        </span>
                                    </div>
                                    <div id="fecha-termino-alert" class="invalid-feedback">La fecha ingresada no puede ser futura</div>
                                </div>
                            </div>
                            <div id="filtro-estado-operacional" class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <div id="data-tag-estado-operacional" data-data='{{$estadosOperacionalesJson}}'></div>
                                    <label class="form-label">Estado Operacional</label>
                                    <div class="input-group">
                                        <select id="select-beast-estado-operacional" type="text" tabindex="-1" placeholder="Seleccione un estado..." class="form-control"></select>
                                        <span class="input-group-append">
                                            <button class="btn btn-primary" onclick="removerFiltroEstadoOperacional();" type="button"><i class="fas fa-times"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="filtro-etapa" class="col-md-12 col-sm-12">
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
                        </div>
                    </div>
                    <div id="propuesta" class="row">
                        <div class="col-md-12 col-lg-8 col-xl-9">
                            <div class="card">
                                <div class="card-header">
                                    <div class="col-md-12 col-sm-12">
                                        <h3 class="card-title">Propuestas</h3>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div style="overflow-x:auto;">
                                        <table id="tabla-propuesta" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>idP</th>
                                                    <th data-dynatable-sorts="fechaCompromisoSort">Fecha Compromiso</th>
                                                    <th style="display: none">Fecha Compromiso Sort</th>
                                                    <th>Empresa</th>
                                                    <th>Estado</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($propuestas as $propuesta)
                                                <tr>
                                                    <td><a href="/propuesta/show/{{$propuesta->id}}" style="color: #495057">{{$propuesta->idp}}</a></td>
                                                    <td>{{date("d-m-Y", strtotime($propuesta->fecha_compromiso))}}</td>
                                                    <td>{{$propuesta->fecha_compromiso}}</td>
                                                    <td>{{$propuesta->empresa()->nombre}}</td>
                                                    <td>{{$propuesta->get_last_estado()->nombre}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-lg-4 col-xl-3">
                            {{-- <h4 id="filtro-propuesta">Filtros Propuestas</h4> --}}
                            <div id="filtro-fecha-inicio-propuesta" class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <div id="data-tag-fecha" data-data='{{$fechaActual}}'></div>
                                    <label class="form-label">Fecha Inicio</label>
                                    <div class="input-group">
                                        <input id="fecha-inicio-propuesta" onchange="" type="date" class="form-control" name="fecha-inicio-propuesta" placeholder="Fecha Inicio">
                                        <span class="input-group-append">
                                            <button class="btn btn-primary" onclick="removerFiltroFechaInicioPropuesta();" type="button"><i class="fas fa-times"></i></button>
                                        </span>
                                    </div>
                                    <div id="fecha-inicio-alert" class="invalid-feedback">La fecha ingresada no puede ser futura</div>
                                </div>
                            </div>
                            <div id="filtro-fecha-termino-propuesta" class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Fecha Termino</label>
                                    <div class="input-group">
                                        <input id="fecha-termino-propuesta" onchange="" type="date" class="form-control" name="fecha-termino-propuesta" placeholder="Fecha Término">
                                        <span class="input-group-append">
                                            <button class="btn btn-primary" onclick="removerFiltroFechaTerminoPropuesta();" type="button"><i class="fas fa-times"></i></button>
                                        </span>
                                    </div>
                                    <div id="fecha-termino-alert" class="invalid-feedback">La fecha ingresada no puede ser futura</div>
                                </div>
                            </div>
                            <div id="filtro-estado" class="col-md-12 col-sm-12">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
        <script src="/components/dynatable/jquery.dynatable.js"></script>
        <script src="/js/dashboard/tabla_servicio.js"></script>
        <script src="/js/dashboard/tabla_propuesta.js"></script>
        <script src="/js/dashboard/graficos.js"></script>
    @endsection

    @section('styles')
        <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/dynatable.css">
        <link rel="stylesheet" href="/css/dashboard.css">
    @endsection
