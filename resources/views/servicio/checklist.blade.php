@extends('layouts.app')

@section('titulo', 'Checklist')
    @section('contenido')

        <div class="card arriba col-lg-12 col-md-12 mx-auto">
            <div class="card-header">
                <div class="col-md-4 col-sm-12">
                    <h4 id="etapa-text" class="card-title">Etapa: {{$servicio->get_last_etapa()->nombre}}</h4>
                </div>
                <div class="col-md-4 col-sm-12 text-center">
                    <h3 class="card-title">Checklist del Servicio: {{ $servicio->ot}}</h3>
                </div>
                <div class="col-md-4 text-right">
                    <a id="btn-generar-diplomas-programa" href="/servicio/diploma_programa/{{$servicio->propuesta()->id}}" class="btn btn-teal" title="Diploma por Programa" hidden><i class="fas fa-medal"></i></a>
                    <button id="btn-generar-diplomas-programa-deshabilitado" class="btn btn-teal" title="Diploma por Programa" disabled hidden><i class="fas fa-medal"></i></button>
                    <a id="btn-exportar-participantes-programa" href="/servicio/exportar_datos_participantes_programa/{{$servicio->propuesta()->id}}" class="btn btn-teal" title="Exportar Datos Participante por Programa" hidden><i class="fas fa-file-alt"></i></a>
                    <button id="btn-exportar-participantes-programa-deshabilitado" class="btn btn-teal" title="Exportar Datos Participante por Programa" disabled hidden><i class="fas fa-file-alt"></i></button>
                    <a id="btn-descargar-checklist" href="/servicio/checklist_servicio/{{$servicio->id}}" class="btn btn-teal" title="Descargar Checklist" hidden><i class="fas fa-file-download"></i></a>
                    <button id="btn-descargar-checklist-deshabilitado" class="btn btn-teal" title="Descargar Checklist" disabled><i class="fas fa-file-download"></i></button>
                    <a id="btn-reporte-basico" href="/servicio/generar_reporte_basico/{{$servicio->id}}" class="btn btn-teal" title="Descargar Reporte Básico" hidden><i class="fas fa-file-download"></i></a>
                    <button id="btn-reporte-basico-deshabilitado" class="btn btn-teal" title="Descargar Reporte Básico" disabled><i class="fas fa-file-download"></i></button>
                </div>
            </div>
        </div>
        <div id="servicio-id" data-data="{{ $servicio->id }}"></div>
        <div id="etapa" data-data="{{ $servicio->get_last_etapa()->id }}"></div>
        <div id="estado-operacional" data-data="{{ $servicio->get_last_estado_operacional()->id }}"></div>
        <div id="tipo-servicio" data-data="{{ $servicio->propuesta()->tipo_servicio_id }}"></div>
        <div id="datos" class="alert separador alert-primary bg-cyan text-center" role="alert">
            <div class="row">
                <div class="col-md-4 text-left">
                </div>
                <div class="col-md-4" style="vertical-align: middle;">
                    <h4 class="card-title" style="color: white">Información del Servicio</h4>
                </div>
                <div class="col-md-4 text-right">
                    <button id="btn-datos-mostrar" class="btn btn-teal btn-sm" style="width:37px" onclick="mostrarDatos();" title="mostrar" ><i class="far fa-eye"></i></button>
                    <button id="btn-datos-ocultar" class="btn btn-teal btn-sm" style="width:37px" onclick="ocultarDatos();" title="ocultar" hidden><i class="far fa-eye-slash"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irDisenio();" title="Diseño Técnico" ><i class="fas fa-pencil-ruler"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irLogistica();" title="Logística" ><i class="fas fa-archive"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irCierre();" title="Cierre" ><i class="fas fa-lock"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irArchivos();" title="Archivos" ><i class="fas fa-folder"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irObservaciones();" title="Observaciones" ><i class="fas fa-sticky-note"></i></button>
                </div>
            </div>
        </div>
        <div id="datos-contenido" class="card medio col-lg-12 col-md-12 mx-auto" hidden>
            <div class="card-body">

                @include('servicio.checklist_parts.datos')

            </div>
        </div>
        <div id="disenio" class="alert separador alert-primary bg-cyan text-center" role="alert">
            <div class="row">
                <div class="col-md-4 text-left">
                    <label class="colorinput">
                        @if ($servicio->diseno_tecnico()->diseno_tecnico_listo == 1)
                            <input id="listo-disenio-tecnico" type="checkbox" value="1" class="colorinput-input" checked disabled/>
                        @else
                            <input id="listo-disenio-tecnico" type="checkbox" value="1" class="colorinput-input" disabled/>
                        @endif
                        <span class="colorinput-color bg-teal"></span>
                    </label>
                </div>
                <div class="col-md-4" style="vertical-align: middle;">
                    <h4 class="card-title" style="color: white">Diseño Técnico</h4>
                </div>
                <div class="col-md-4 text-right">
                    <button id="btn-disenio-mostrar" class="btn btn-teal btn-sm" style="width:37px" onclick="mostrarDisenio();" title="mostrar" ><i class="far fa-eye"></i></button>
                    <button id="btn-disenio-ocultar" class="btn btn-teal btn-sm" style="width:37px" onclick="ocultarDisenio();" title="ocultar" hidden><i class="far fa-eye-slash"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irDatos();" title="Información" ><i class="fas fa-info-circle"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irLogistica();" title="Logística" ><i class="fas fa-archive"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irCierre();" title="Cierre" ><i class="fas fa-lock"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irArchivos();" title="Archivos" ><i class="fas fa-folder"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irObservaciones();" title="Observaciones" ><i class="fas fa-sticky-note"></i></button>
                </div>
            </div>
        </div>
        <div id="disenio-contenido" class="card medio col-lg-12 col-md-12 mx-auto" hidden>
            <div class="card-body">

                @include('servicio.checklist_parts.disenio_tecnico')

            </div>
        </div>
        <div id="logistica" class="alert separador alert-primary bg-cyan text-center" role="alert">
            <div class="row">
                <div class="col-md-4 text-left">
                    <label class="colorinput">
                        @if ($servicio->logistica_listo == 1)
                            <input id="listo-logistica" type="checkbox" value="1" class="colorinput-input" checked disabled/>
                        @else
                            <input id="listo-logistica" type="checkbox" value="1" class="colorinput-input" disabled/>
                        @endif
                        <span class="colorinput-color bg-teal"></span>
                    </label>
                </div>
                <div class="col-md-4" style="vertical-align: middle;">
                    <h4 class="card-title" style="color: white">Logística</h4>
                </div>
                <div class="col-md-4 text-right">
                    <button id="btn-logistica-mostrar" class="btn btn-teal btn-sm" style="width:37px" onclick="mostrarLogistica();" title="mostrar" ><i class="far fa-eye"></i></button>
                    <button id="btn-logistica-ocultar" class="btn btn-teal btn-sm" style="width:37px" onclick="ocultarLogistica();" title="ocultar" hidden><i class="far fa-eye-slash"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irDatos();" title="Información" ><i class="fas fa-info-circle"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irDisenio();" title="Diseño Técnico" ><i class="fas fa-pencil-ruler"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irCierre();" title="Cierre" ><i class="fas fa-lock"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irArchivos();" title="Archivos" ><i class="fas fa-folder"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irObservaciones();" title="Observaciones" ><i class="fas fa-sticky-note"></i></button>
                </div>
            </div>
        </div>
        <div id="logistica-contenido" class="card medio col-lg-12 col-md-12 mx-auto" hidden>
            <div class="card-body">

                @include('servicio.checklist_parts.logistica')

            </div>
        </div>
        <div id="cierre" class="card alert separador alert-primary bg-cyan text-center" role="alert">
            <div class="row">
                <div class="col-md-4 text-left">
                    <label class="colorinput">
                        @if ($servicio->cierre_listo == 1)
                            <input id="listo-cierre" type="checkbox" value="1" class="colorinput-input" checked disabled/>
                        @else
                            <input id="listo-cierre" type="checkbox" value="1" class="colorinput-input" disabled/>
                        @endif
                        <span class="colorinput-color bg-teal"></span>
                    </label>
                </div>
                <div class="col-md-4" style="vertical-align: middle;">
                    <h4 class="card-title" style="color: white">Cierre</h4>
                </div>
                <div class="col-md-4 text-right">
                    <button id="btn-cierre-mostrar" class="btn btn-teal btn-sm" style="width:37px" onclick="mostrarCierre();" title="mostrar" ><i class="far fa-eye"></i></button>
                    <button id="btn-cierre-ocultar" class="btn btn-teal btn-sm" style="width:37px" onclick="ocultarCierre();" title="ocultar" hidden><i class="far fa-eye-slash"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irDatos();" title="Información" ><i class="fas fa-info-circle"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irDisenio();" title="Diseño Técnico" ><i class="fas fa-pencil-ruler"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irLogistica();" title="Logística" ><i class="fas fa-archive"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irArchivos();" title="Archivos" ><i class="fas fa-folder"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irObservaciones();" title="Observaciones" ><i class="fas fa-sticky-note"></i></button>
                </div>
            </div>
        </div>
        <div id="cierre-contenido" class="card medio col-lg-12 col-md-12 mx-auto" hidden>
            <div class="card-body">

                @include('servicio.checklist_parts.cierre')

            </div>
        </div>
        <div id="archivo" class="card alert separador alert-primary bg-cyan text-center" role="alert">
            <div class="row">
                <div class="col-md-4 text-left">
                </div>
                <div class="col-md-4" style="vertical-align: middle;">
                    <h4 class="card-title" style="color: white">Archivos</h4>
                </div>
                <div class="col-md-4 text-right">
                    <button id="btn-archivos-mostrar" class="btn btn-teal btn-sm" style="width:37px" onclick="mostrarArchivo();" title="mostrar" ><i class="far fa-eye"></i></button>
                    <button id="btn-archivos-ocultar" class="btn btn-teal btn-sm" style="width:37px" onclick="ocultarArchivo();" title="ocultar" hidden><i class="far fa-eye-slash"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irDatos();" title="Información" ><i class="fas fa-info-circle"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irDisenio();" title="Diseño Técnico" ><i class="fas fa-pencil-ruler"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irLogistica();" title="Logística" ><i class="fas fa-archive"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irCierre();" title="Cierre" ><i class="fas fa-lock"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irObservaciones();" title="Observaciones" ><i class="fas fa-sticky-note"></i></button>
                </div>
            </div>
        </div>
        <div id="archivos-contenido" class="card medio col-lg-12 col-md-12 mx-auto" hidden>
            <div class="card-body">

                @include('servicio.checklist_parts.archivos')

            </div>
        </div>
        <div id="observaciones" class="card alert separador alert-primary bg-cyan text-center" role="alert">
            <div class="row">
                <div class="col-md-4 text-left">
                </div>
                <div class="col-md-4" style="vertical-align: middle;">
                    <h4 class="card-title" style="color: white">Observaciones</h4>
                </div>
                <div class="col-md-4 text-right">
                    <button id="btn-observaciones-mostrar" class="btn btn-teal btn-sm" style="width:37px" onclick="mostrarObservaciones();" title="mostrar" ><i class="far fa-eye"></i></button>
                    <button id="btn-observaciones-ocultar" class="btn btn-teal btn-sm" style="width:37px" onclick="ocultarObservaciones();" title="ocultar" hidden><i class="far fa-eye-slash"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irDatos();" title="Información" ><i class="fas fa-info-circle"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irDisenio();" title="Diseño Técnico" ><i class="fas fa-pencil-ruler"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irLogistica();" title="Logística" ><i class="fas fa-archive"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irCierre();" title="Cierre" ><i class="fas fa-lock"></i></button>
                    <button class="btn btn-teal btn-sm" style="width:37px" onclick="irArchivos();" title="Archivos" ><i class="fas fa-folder"></i></button>
                </div>
            </div>
        </div>
        <div id="observaciones-contenido" class="card abajo col-lg-12 col-md-12 mx-auto" hidden>
            <div class="card-body">
                <textarea id="observaciones-checklist" class="form-control" rows="5">{{$servicio->observaciones_checklist}}</textarea>
                <div id="observaciones-guardando-datos" style="margin-top:1rem;" class="text-right" hidden>
                    <button type="button" class="btn btn-secondary btn-loading">C</button>Guardando
                </div>
                <div id="observaciones-error-guardar-datos" style="margin-top:1rem;" class="text-center" hidden>
                    <div class="alert alert-danger" role="alert">
                        No se pudo guardar los cambios.
                    </div>
                </div>
            </div>
            <div class="card-footer row">
                <div class="col-md-6 col-sm-12">
                    <a href="/servicio" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>

        @include('servicio.checklist_parts.contactos')

        @include('servicio.disenio_tecnico_parts.informacion_propuesta')

        @include('servicio.checklist_parts.archivos_disenio_tecnico')

    @endsection

    @section('scripts')
        <script src="/js/formato_numeros.js"></script>
        <script src="/js/servicio/checklist/observaciones.js"></script>
        <script src="/js/servicio/checklist/cierre/cierre_servicio.js"></script>
        <script src="/js/servicio/checklist/cierre/recepcion.js"></script>
        <script src="/js/servicio/checklist/cierre/cierre.js"></script>
        <script src="/js/servicio/checklist/disenio_tecnico.js"></script>
        <script src="/js/servicio/checklist/logistica/coordinacion.js"></script>
        <script src="/js/servicio/checklist/logistica/material_participante.js"></script>
        <script src="/js/servicio/checklist/logistica/material_relator.js"></script>
        <script src="/js/servicio/checklist/logistica/sence.js"></script>
        <script src="/js/servicio/checklist/logistica/outdoor.js"></script>
        <script src="/js/servicio/checklist/logistica/audio_iluminacion.js"></script>
        <script src="/js/servicio/checklist/logistica/logistica.js"></script>
        <script src="/js/servicio/checklist/contactos.js"></script>
        <script src="/js/servicio/checklist/datos.js"></script>
        <script src="/js/servicio/checklist.js"></script>
        <script src="/js/validaciones/validacion_fecha_no_pasada.js"></script>
        <script src="/js/validaciones/validacion_horario.js"></script>
        <script src="/js/validaciones/validacion_numero.js"></script>
        <script src="/js/formato_numeros.js"></script>
        <script src="/js/servicio/checklist/cierre/guardar_archivos.js"></script>
        <script src="/js/validaciones/validacion_no_nulo.js"></script>
    @endsection

    @section('styles')
        <link rel="stylesheet" href="/css/servicio/checklist.css">
    @endsection