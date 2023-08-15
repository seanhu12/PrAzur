@extends('layouts.app')

@section('titulo', 'Administrar Servicio')
    @section('contenido')

        <div class="card col-lg-4 col-md-6 mx-auto">
            <div class="card-header">
                <h3 class="card-title">Administrar Servicio</h3>
            </div>
            <div class="card-body">
                @if ($servicio->get_last_etapa()->id != 6 && $servicio->get_last_estado_operacional()->id != 5)
                    <div class="row">
                        @if ($servicio->get_last_etapa()->id == 1 || $servicio->get_last_etapa()->id == 2 || $servicio->get_last_etapa()->id == 3)
                            @if ($servicio->get_last_estado_operacional()->id == 3)
                                <div class="col-md-12">
                                    <button id="btn-mostrar-reanudar" style="width: 100%" class="btn btn-cyan btn-lg">Reanudar Servicio</button>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <button id="btn-detener" onclick="detener({{$servicio->id}});" style="width: 100%" class="btn btn-cyan btn-lg">Detener Servicio</button>
                                </div>
                            @endif
                            <hr>
                            <div class="col-md-12">
                                <button id="btn-cancelar" onclick="cancelar({{$servicio->id}});" style="width: 100%" class="btn btn-cyan btn-lg">Cancelar Servicio</button>
                            </div>
                            <hr>
                        @endif
                        <div class="col-md-12">
                            <button id="btn-reiniciar-etapas" onclick="reiniciarEtapas({{$servicio->id}});" style="width: 100%" class="btn btn-cyan btn-lg">Reiniciar Etapas del Servicio</button>
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-footer row">
                <div class="col-md-6 col-sm-6">
                    <a href="/servicio" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>



        <div class="modal fade" id="modal-reanudar" tabindex="-1" role="dialog" aria-labelledby="contactos-label" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contacto-title">Reanudar Servicio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="form-label">Nueva fecha de ejecución</label>
                                    <input id="fecha-ejecucion" onchange="validarFechaNoPasada(document.getElementById('fecha-ejecucion').value,'fecha-ejecucion');" placeholder="Fecha de Ejecucion" type="date" class="form-control">
                                    <div id="fecha-ejecucion-alert" class="invalid-feedback">La fecha no puede ser anterior a la actual.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                        <div class="col-md-8 text-right" style="padding-right:0">
                            <button id="btn-reanudar" onclick="reanudar({{$servicio->id}});" class="btn btn-cyan">Reanudar Servicio</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    @endsection

    @section('scripts')
    <script src="/js/validaciones/validacion_fecha_no_pasada.js"></script>
    <script src="/js/validaciones/validacion_no_nulo.js"></script>
        <script src="/js/servicio/administrar_servicio.js"></script>
    @endsection