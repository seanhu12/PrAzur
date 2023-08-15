@extends('layouts.app')

@section('titulo', 'Crear Propuesta')
@section('contenido')

    <div class="card col-lg-12 col-md-12 mx-auto">
        <div class="card-header">
            <h3 id="titulo" class="card-title">Nueva Propuesta</h3>
        </div>
        <div class="card-body">
            <div id="error_bd_contorno" style="visibility:hidden" role="alert">
                <label id="error_bd" style="visibility:hidden"></label>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Fecha Propuesta*</label>
                                <input id="fecha_propuesta" onchange="validarFechaNoFutura(document.getElementById('fecha_propuesta').value,'fecha_propuesta');" type="date" class="form-control" name="fecha_propuesta" value="{{$fechaActual}}" placeholder="Fecha Propuesta" autofocus >
                                <div id="fecha_propuesta-alert" class="invalid-feedback">La fecha ingresada no puede ser futura. Se debe ingresar una fecha.</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Fecha Compromiso*</label>
                                <input id="fecha_compromiso" onchange="validarFechaNoPasada(document.getElementById('fecha_compromiso').value,'fecha_compromiso');" type="date" class="form-control" name="fecha_compromiso" placeholder="Fecha Compromiso">
                                <div id="fecha_compromiso-alert" class="invalid-feedback">La fecha ingresada no puede ser pasada. Se debe ingresar una fecha.</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Cantidad Total Horas</label>
                                <input id="cant_total_horas" onchange="calcularMonto();validarMaxMinNumeroHoras();" type="text" class="form-control" name="cant_total_horas" placeholder="Cantidad Total Horas" maxlength="11">
                                <div id="cant_total_horas-alert" class="invalid-feedback">Se debe ingresar un valor entre 0,0 y 999,9.</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Valor Hora</label>
                                <input id="uf_hora" onchange="calcularMonto();validarValorHora();" type="text" class="form-control" value="{{$ultimoValorUf}}" placeholder="Valor Hora" maxlength="13">
                                <div id="uf_hora-alert" class="invalid-feedback">Se debe ingresar un valor entre 0 y 999.999.</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Monto</label>
                                <input id="monto" type="text" class="form-control" name="monto" placeholder="Monto" readonly>
                                <div id="monto-alert" class="invalid-feedback">El monto puede tener máximo 9 digitos.</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <div id="data-tag-area" data-data='{{$areasJson}}'></div>
                                <label for="select-beast-area" class="form-label">Área*</label>
                                <select id="select-beast-area" type="text" tabindex="-1" placeholder="Seleccione una área..." class="form-control" readonly ></select>
                                <div id="select-beast-area-alert" class="invalid-feedback">Se debe seleccionar un área.</div>
                            </div>
                            <div class="form-group">
                                <div id="data-tag-empresa" data-data='{{$empresasJson}}'></div>
                                <label for="select-beast-empresa" class="form-label">Empresa*</label>
                                <select id="select-beast-empresa" type="text" tabindex="-1" placeholder="Seleccione una empresa..." class="form-control" ></select>
                                <div id="select-beast-empresa-alert" class="invalid-feedback">Se debe seleccionar una empresa.</div>
                            </div>
                            <div class="form-group">
                                <div id="data-tag-contacto-empresa" data-data='{{$contactosEmpresaJson}}'></div>
                                <label id="label-contacto-empresa" for="select-beast-contacto-empresa" class="form-label">Contacto Venta Empresa</label>
                                <select id="select-beast-contacto-empresa" type="text" tabindex="-1" placeholder="Seleccione un contacto empresa..." class="form-control" ></select>
                                <div id="select-beast-contacto-empresa-alert" class="invalid-feedback">Se debe seleccionar un contacto de la empresa.</div>
                            </div>
                            <div class="form-group">
                                <div id="data-tag-contacto-otic" data-data='{{$contactosOticJson}}'></div>
                                <label for="select-beast-contacto-otic" class="form-label">Contacto OTIC</label>
                                <select id="select-beast-contacto-otic" type="text" tabindex="-1" placeholder="Seleccione un contacto OTIC..." class="form-control" ></select>
                                <div id="select-beast-contacto-otic-alert" class="invalid-feedback">Se debe seleccionar un contacto de la otic.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Tipo de Servicio</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group">
                                <div id="data-tag-programa" data-data='{{$programasJson}}'></div>
                                <select id="select-beast-programa" type="text" tabindex="-1" placeholder="Seleccione un programa..." class="form-control" ></select>
                                <div id="select-beast-programa-alert" class="invalid-feedback">Se debe seleccionar un programa o un curso.</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="custom-switches-stacked">
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input id="opcion_programa" onclick="elegirProgramaCurso();" type="radio" name="option" value="programa" class="custom-switch-input" checked>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Programa</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group">
                                <div id="data-tag-curso" data-data='{{$cursosJson}}'></div>
                                <select id="select-beast-curso" type="text" tabindex="-1" placeholder="Seleccione un curso..." class="form-control" ></select>
                                <div id="select-beast-curso-alert" class="invalid-feedback">Se debe seleccionar un programa o un curso.</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="custom-switches-stacked">
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input id="opcion_curso" onclick="elegirProgramaCurso();" type="radio" name="option" value="curso" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Curso</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="btn-cursos-programa" class="btn btn-primary" onclick="desplegarCursosPrograma();" style="visibility:visible">Cursos del programa</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div id="data-tag-urgencia" data-data='{{$urgenciasJson}}'></div>
                        <label for="select-beast-urgencia" class="form-label">Urgencia</label>
                        <select id="select-beast-urgencia" type="text" tabindex="-1" placeholder="Seleccione la Urgencia..." class="form-control"></select>
                        <div id="select-beast-urgencia-alert" class="invalid-feedback">Se debe seleccionar una opción.</div>
                    </div>
                    <div class="form-group">
                        <div id="data-tag-complejidad" data-data='{{$complejidadesJson}}'></div>
                        <label for="select-beast-complejidad" class="form-label">Complejidad</label>
                        <select id="select-beast-complejidad" type="text" tabindex="-1" placeholder="Seleccione la Complejidad..." class="form-control"></select>
                        <div id="select-beast-complejidad-alert" class="invalid-feedback">Se debe seleccionar una opción.</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Experiencia con ADS</label>
                        <div>
                            <label class="custom-control custom-checkbox custom-control-inline">
                                <input id="experiencia-ads-si" onclick="experienciaAdsSi()" type="checkbox" class="custom-control-input" value="1">
                                <span class="custom-control-label">Si</span>
                            </label>
                            <label class="custom-control custom-checkbox custom-control-inline">
                                <input id="experiencia-ads-no" onclick="experienciaAdsNo()" type="checkbox" class="custom-control-input" value="1">
                                <span class="custom-control-label">No</span>
                            </label>
                        </div>
                        <input id="experiencia-ads-text" type="text" class="form-control" placeholder="¿Qué experiencia?" maxlength="191" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Experiencia con la Temática</label>
                        <div>
                            <label class="custom-control custom-checkbox custom-control-inline">
                                <input id="experiencia-tematica-si" onclick="experienciaTematicaSi()" type="checkbox" class="custom-control-input" value="1">
                                <span class="custom-control-label">Si</span>
                            </label>
                            <label class="custom-control custom-checkbox custom-control-inline">
                                <input id="experiencia-tematica-no" onclick="experienciaTematicaNo()" type="checkbox" class="custom-control-input" value="1">
                                <span class="custom-control-label">No</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="data-tag-perfil" data-data='{{$perfilesJson}}'></div>
                        <label for="input-tags-perfil" class="form-label">Perfil Participantes</label>
                        <select id="input-tags-perfil" type="text" tabindex="-1" placeholder="Seleccione el Perfil..." class="form-control"></select>
                        <div id="input-tags-perfil-alert" class="invalid-feedback">Se debe seleccionar una opción.</div>
                    </div>
                    <div class="form-group">
                        <div id="data-tag-foco" data-data='{{$focosJson}}'></div>
                        <label for="input-tags-foco" class="form-label">Foco de la Intervención</label>
                        <select id="input-tags-foco" type="text" tabindex="-1" placeholder="Seleccione el Foco..." class="form-control"></select>
                        <div id="input-tags-foco-alert" class="invalid-feedback">Se debe seleccionar una opción.</div>
                    </div>
                    <div class="form-group">
                        <input id="foco-observacion" type="text" class="form-control" placeholder="Indique el foco de intervención" maxlength="191" hidden>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Archivos de la Propuesta</label>
                        <div class="custom-file">
                            <input id="custom-file-propuesta" type="file" class="custom-file-input" multiple >
                            <label class="custom-file-label" for="custom-file-propuesta">Seleccionar archivo...</label>
                            <div id="custom-file-propuesta-alert" class="invalid-feedback">Solo se puede subir hasta 20 archivos.</div>
                        </div>
                        <div id="archivos"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="form-label">Contexto</label>
                        <textarea id="observaciones" class="form-control" name="observaciones" rows="6" maxlength="9999"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer row">
            <div class="col-md-6 col-sm-6">
                <a href="/propuesta" class="btn btn-secondary">Cancelar</a>
            </div>
            <div class="col-md-6 col-sm-6 text-right">
                <button type="button" onclick="enviarDatos();" id="button-crear" class="btn btn-primary">Crear Propuesta</button>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modal-cursos-programa" tabindex="-1" role="dialog" aria-labelledby="cursos-programa-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cursos-programa-label"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="cursos-programa"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/validaciones/validacion_fecha_no_futura.js"></script>
    <script src="/js/validaciones/validacion_fecha_no_pasada.js"></script>
    <script src="/js/validaciones/validacion_numero.js"></script>
    <script src="/js/validaciones/validacion_no_nulo.js"></script>
    <script src="/js/formato_numeros.js"></script>
    <script src="/js/propuesta/create.js"></script>
@endsection