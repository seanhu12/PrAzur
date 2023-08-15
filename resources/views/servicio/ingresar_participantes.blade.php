@extends('layouts.app')

@section('titulo', 'Ingresar Participantes')
    @section('contenido')

    <div class="card col-lg-12 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6">
                <h3 class="card-title">Ingresar Participantes</h3>
            </div>
            <div class="col-md-6 text-right">
                @if ($servicio->get_last_etapa()->id != 6 && $servicio->get_last_estado_operacional()->id != 5)
                    <button id="btn-mostrar-eliminar-participante" class="btn btn-cyan" title="Eliminar Participante"><i class="fas fa-user"></i> <i class="fas fa-trash-alt"></i></button>
                @endif
            </div>
        </div>
        <div id="data-tag-participantes" data-data="{{$participantes}}"></div>
        <div id="data-tag-headers" data-data="{{$headers}}"></div>
        <div id="data-tag-servicio" data-data="{{$servicio}}"></div>
        <div id="data-tag-etapa" data-data="{{ $servicio->get_last_etapa()->id }}"></div>
        <div id="data-tag-estado-operacional" data-data="{{ $servicio->get_last_estado_operacional()->id }}"></div>
        <div id="data-tag-perfiles" data-data="{{ $perfiles }}"></div>
        <div class="card-body">

            {{-- {{$participantes}} --}}

            <div class="row">
                <div class="col-md-12">
                    <div id="error-datos" hidden>
                        <div id="mensaje-error-datos" class="alert alert-danger" role="alert">
                            <div id="validacion-nombre-no-vacio" hidden>- El nombre del participante es obligatorio.</div>
                            <div id="validacion-apellido-no-vacio" hidden>- El apellido del participante es obligatorio.</div>
                            <div id="validacion-rut-no-vacio" hidden>- El rut del participante es obligatorio.</div>
                            <div id="validacion-correo-no-vacio" hidden>- El correo electrónico del participante es obligatorio.</div>
                            <div id="validacion-vigencia-no-vacio" hidden>- La vigencia del participante es obligatoria.</div>
                            <div id="validacion-nombre" hidden>- El nombre de algún participante no es válido.</div>
                            <div id="validacion-apellido" hidden>- El apellido de algún participante no es válido.</div>
                            <div id="validacion-rut" hidden>- El rut de algún participante no es válido.</div>
                            <div id="validacion-correo" hidden>- El correo electrónico de algún participante no es válido.</div>
                            <div id="validacion-perfil" hidden>- El perfil de algún participante no es válido.</div>
                            <div id="validacion-vigencia" hidden>- La vigencia de algún participante no es válida.</div>
                            <div id="validacion-asistencia" hidden>- La asistencia de algún participante no es válida.</div>
                            <div id="validacion-test" hidden>- El test de algún participante no es válido.</div>
                            <div id="validacion-retest" hidden>- El retest de algún participante no es válido.</div>
                            <div id="validacion-guia" hidden>- La guía de algún participante no es válida.</div>
                            <div id="validacion-prueba" hidden>- La prueba de algún participante no es válida.</div>
                            <div id="validacion-evaluacion" hidden>- La evaluación de algún participante no es válida.</div>
                            <div id="validacion-asistencia-ingresada" hidden>- Se deben ingresar las asistencias de todos los participantes.</div>
                            <div id="validacion-test-ingresado" hidden>- Se deben ingresar los test de todos los participantes.</div>
                            <div id="validacion-retest-ingresado" hidden>- Se deben ingresar los retest de todos los participantes.</div>
                            <div id="validacion-guia-ingresado" hidden>- Se deben ingresar las guias de todos los participantes.</div>
                            <div id="validacion-prueba-ingresado" hidden>- Se deben ingresar las pruebas de todos los participantes.</div>
                            <div id="validacion-evaluacion-ingresado" hidden>- Se deben ingresar las evaluaciones de todos los participantes.</div>
                        </div>
                    </div>
                    <div id="participantes"></div>
                    <div id="guardando-datos" style="margin-top:1rem;" class="text-right" hidden>
                        <button type="button" class="btn btn-secondary btn-loading">C</button>Guardando
                    </div>
                    <div id="error-guardar-datos" style="margin-top:1rem;" class="text-center" hidden>
                        <div class="alert alert-danger" role="alert">
                            No se pudo guardar los cambios.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer row">
            <div class="col-md-6 col-sm-6">
                <a href="/servicio/checklist/{{$servicio->id}}" class="btn btn-secondary">Volver</a>
            </div>
            <div class="col-md-6 col-sm-6 text-right">
                <button id="btn-guardar" type="button" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modal-eliminar-participante" tabindex="-1" role="dialog" aria-labelledby="contactos-label" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contacto-title">Eliminar Participante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Ingresar RUT</label>
                                <input id="rut" onchange="validarRut(document.getElementById('rut').value);" type="text" class="form-control" name="rut" placeholder="RUT" maxlength="191">
                                <div id="rut-alert" class="invalid-feedback">El RUT ingresado no es válido</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    <div class="col-md-6 text-right" style="padding-right:0">
                        <button id="btn-eliminar-participante" class="btn btn-cyan" title="Eliminar Participante">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @endsection

    @section('scripts')
        <script src="/components/handsontable/dist/handsontable.full.min.js"></script>
        <script src="/js/validaciones/validacion_rut.js"></script>
        <script src="/js/validaciones/validacion_no_nulo.js"></script>
        <script src="/js/servicio/ingresar_participantes.js"></script>
    @endsection

    @section('styles')
        <link rel="stylesheet" href="/components/handsontable/dist/handsontable.full.min.css">
    @endsection