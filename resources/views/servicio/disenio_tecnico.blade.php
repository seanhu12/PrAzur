@extends('layouts.app')

@section('titulo', 'Diseño Técnico')
    @section('contenido')

        <div class="card col-xl-12 col-lg-12 col-md-12 mx-auto">
            <div class="card-header">
                <div class="col-md-12 col-sm-12">
                    <h3 class="card-title">Diseño Técnico del Servicio</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <button onclick="mostrarInformacionServicio();" class="btn btn-pill btn-cyan btn-lg" style="width: 100%; margin-bottom:0.5rem">Información del Servicio</button>
                    </div>
                    <div class="col-md-4">
                        <button onclick="mostrarInformacionPropuesta();" class="btn btn-pill btn-cyan btn-lg" style="width: 100%; margin-bottom:0.5rem">Información de la Propuesta</button>
                    </div>
                    <div class="col-md-4">
                        <button onclick="mostrarResumen();" class="btn btn-pill btn-cyan btn-lg" style="width: 100%; margin-bottom:0.5rem">Resumen</button>
                    </div>
                </div>
                <hr>
                <div id="servicio-id" data-data="{{ $servicio->id }}"></div>
                <div id="etapa" data-data="{{ $servicio->get_last_etapa()->id }}"></div>
                <div id="estado-operacional" data-data="{{ $servicio->get_last_estado_operacional()->id }}"></div>
                <div id="data-tag-disenio-tecnico" data-data='{{ $servicio->diseno_tecnico()}}'></div>
                <div id="realizar-disenio-tecnico" class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input id="aplica-relator" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Relator</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                                <button id="btn-relator" class="btn btn-pill btn-cyan btn-sm" title="Seleccionar Relator"><i class="fas fa-pencil-ruler"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input id="aplica-estructura" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Estructura del Curso</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                                <button id="btn-estructura" class="btn btn-pill btn-cyan btn-sm" title="Seleccionar Estructura"><i class="fas fa-pencil-ruler"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input id="aplica-manual" type="checkbox" class="custom-switch-input" value="1">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Manuales</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                                <button id="btn-manual" class="btn btn-pill btn-cyan btn-sm" title="Seleccionar Manuales"><i class="fas fa-pencil-ruler"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input id="aplica-prueba" type="checkbox" class="custom-switch-input" value="1">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Pruebas</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                                <button id="btn-prueba" class="btn btn-pill btn-cyan btn-sm" title="Seleccionar Pruebas"><i class="fas fa-pencil-ruler"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input id="aplica-guia" type="checkbox" class="custom-switch-input" value="1">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Guias</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                                <button id="btn-guia" class="btn btn-pill btn-cyan btn-sm" title="Seleccionar Guias"><i class="fas fa-pencil-ruler"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input id="aplica-encuesta-ads" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Encuesta ADS</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                                <button id="btn-encuesta-ads" class="btn btn-pill btn-cyan btn-sm" title="Seleccionar Encuesta ADS"><i class="fas fa-pencil-ruler"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input id="aplica-encuesta-empresa" type="checkbox" class="custom-switch-input" value="1">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Encuesta Empresa</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                                <button id="btn-encuesta-empresa" class="btn btn-pill btn-cyan btn-sm" title="Seleccionar Encuesta Empresa"><i class="fas fa-pencil-ruler"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input id="aplica-encuesta-adicional" type="checkbox" class="custom-switch-input" value="1">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Encuestas Adicionales</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                                <button id="btn-encuesta-adicional" class="btn btn-pill btn-cyan btn-sm" title="Seleccionar Encuestas Adicionales"><i class="fas fa-pencil-ruler"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12">
                        <div id="elegir-relator" class="row" hidden>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Seleccionar al Relator</label>
                                    <div id="data-tag-relator" data-data='{{ $relatoresJson }}'></div>
                                    <div id="data-tag-relator-servicio" data-data='{{ $servicio->relator_id }}'></div>
                                    <div class="input-group">
                                        <select id="select-beast-relator" type="text" tabindex="-1" placeholder="Seleccione un relator..." class="form-control"></select>
                                        <span class="input-group-append">
                                            <button id="btn-agregar-relator" class="btn btn-pill btn-cyan btn-sm" title="Agregar"><i class="fas fa-plus"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="elegir-estructura" class="row" hidden>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Seleccionar la estructura</label>
                                    <div id="data-tag-estructura" data-data='{{ $servicio->curso()->estructuras() }}'></div>
                                    <div id="data-tag-estructura-servicio" data-data='{{ $servicio->diseno_tecnico()->estructura_id }}'></div>
                                    <div class="input-group">
                                        <select id="select-beast-estructura" type="text" tabindex="-1" placeholder="Seleccione una estructura..." class="form-control"></select>
                                        <span class="input-group-append">
                                            <button id="btn-agregar-estructura" class="btn btn-pill btn-cyan btn-sm" title="Agregar"><i class="fas fa-plus"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="elegir-manual" class="row" hidden>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Seleccionar los Manuales</label>
                                    <div id="data-tag-manual" data-data='{{ $documento->get_documentos_tipo(1) }}'></div>
                                    <div id="data-tag-manual-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo_id(1)) }}'></div>
                                    <div class="input-group">
                                        <select id="select-beast-manual" type="text" tabindex="-1" placeholder="Seleccione un manual..." class="form-control"></select>
                                        <span class="input-group-append">
                                            <button id="btn-agregar-manual" class="btn btn-pill btn-cyan btn-sm" title="Agregar"><i class="fas fa-plus"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="elegir-prueba" class="row" hidden>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Seleccionar las Pruebas</label>
                                    <div id="data-tag-prueba" data-data='{{ $documento->get_documentos_tipo(3) }}'></div>
                                    <div id="data-tag-prueba-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo_id(3)) }}'></div>
                                    <div class="input-group">
                                        <select id="select-beast-prueba" type="text" tabindex="-1" placeholder="Seleccione una prueba..." class="form-control"></select>
                                        <span class="input-group-append">
                                            <button id="btn-agregar-prueba" class="btn btn-pill btn-cyan btn-sm" title="Agregar"><i class="fas fa-plus"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="elegir-guia" class="row" hidden>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Seleccionar las Guias</label>
                                    <div id="data-tag-guia" data-data='{{ $documento->get_documentos_tipo(2) }}'></div>
                                    <div id="data-tag-guia-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo_id(2)) }}'></div>
                                    <div class="input-group">
                                        <select id="select-beast-guia" type="text" tabindex="-1" placeholder="Seleccione una guia..." class="form-control"></select>
                                        <span class="input-group-append">
                                            <button id="btn-agregar-guia" class="btn btn-pill btn-cyan btn-sm" title="Agregar"><i class="fas fa-plus"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="elegir-encuesta-ads" class="row" hidden>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Seleccionar la Encuesta ADS</label>
                                    <div id="data-tag-encuesta-ads" data-data='{{ $documento->get_documentos_tipo(5) }}'></div>
                                    <div id="data-tag-encuesta-ads-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo_id(5)) }}'></div>
                                    <div class="input-group">
                                        <select id="select-beast-encuesta-ads" type="text" tabindex="-1" placeholder="Seleccione una encuesta..." class="form-control"></select>
                                        <span class="input-group-append">
                                            <button id="btn-agregar-encuesta-ads" class="btn btn-pill btn-cyan btn-sm" title="Agregar"><i class="fas fa-plus"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="elegir-encuesta-empresa" class="row" hidden>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Seleccionar las Encuestas de la Empresa</label>
                                    <div id="data-tag-encuesta-empresa" data-data='{{ $documento->get_documentos_tipo(6) }}'></div>
                                    <div id="data-tag-encuesta-empresa-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo_id(6)) }}'></div>
                                    <div class="input-group">
                                        <select id="select-beast-encuesta-empresa" type="text" tabindex="-1" placeholder="Seleccione una encuesta..." class="form-control"></select>
                                        <span class="input-group-append">
                                            <button id="btn-agregar-encuesta-empresa" class="btn btn-pill btn-cyan btn-sm" title="Agregar"><i class="fas fa-plus"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="elegir-encuesta-adicional" class="row" hidden>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Seleccionar Encuestas Adicionales</label>
                                    <div id="data-tag-encuesta-adicionales" data-data='{{ $documento->get_encuestas_adicionales() }}'></div>
                                    <div id="data-tag-encuesta-adicionales-servicio" data-data='{{ json_encode($servicio->get_encuestas_adicionales_id()) }}'></div>
                                    <div class="input-group">
                                        <select id="select-beast-encuesta-adicionales" type="text" tabindex="-1" placeholder="Seleccione una encuesta..." class="form-control"></select>
                                        <span class="input-group-append">
                                            <button id="btn-agregar-encuesta-adicional" class="btn btn-pill btn-cyan btn-sm" title="Agregar"><i class="fas fa-plus"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <table id="ingresado" class="table"></table>
                        </div>
                        <div id="guardando" class="text-right" hidden>
                            <button type="button" class="btn btn-secondary btn-loading">C</button>Guardando
                        </div>
                        <div id="error-guardar" class="text-center" hidden>
                            <div class="alert alert-danger" role="alert">
                                No se pudo guardar los cambios.
                            </div>
                        </div>
                    </div>
                </div>
                <div id="validacion-finalizar" style="margin-top:1rem;" class="text-center" hidden>
                    <div id="validacion-finalizar-mensaje" class="alert alert-danger" role="alert">
                        error
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="detalles">Detalles</label>
                        <textarea id="detalles" class="form-control" rows="6" maxlength="9999">{{$servicio->diseno_tecnico()->detalle}}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer row">
                <div class="col-md-6 col-sm-6">
                    <a href="/servicio" class="btn btn-secondary">Volver</a>
                </div>
                <div class="col-md-6 col-sm-6 text-right">
                    <button type="button" onclick="finalizar();" id="btn-finalizar" class="btn btn-cyan">Finalizar</button>
                </div>
            </div>
        </div>

        @include('servicio.disenio_tecnico_parts.informacion_servicio')

        @include('servicio.disenio_tecnico_parts.informacion_propuesta')

        @include('servicio.disenio_tecnico_parts.resumen')

    @endsection

    @section('scripts')
        <script src="/js/servicio/disenio_tecnico.js"></script>
    @endsection

    @section('styles')
        <link rel="stylesheet" href="/css/servicio/disenio_tecnico.css">
    @endsection