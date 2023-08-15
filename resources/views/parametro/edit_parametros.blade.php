@extends('layouts.app')

@section('titulo', 'Editar Parámetros de los Servicios')
@section('contenido')

    <div class="card  col-lg-10 col-md-12 mx-auto">
        <div class="card-header">
            <h3 class="card-title">Editar Parámetros los Servicios</h3>
        </div>
        <div class="card-body">
            <div id="success_bd_contorno" class="alert alert-success" role="alert" hidden>
                Los cambios se guardaron exitosamente.
            </div>
            <div id="error_bd_contorno" class="alert alert-danger" role="alert" hidden>
                No se pudieron guardar los cambios.
            </div>
            <div id="etapas" data-data="{{$etapasJson}}"></div>
            <div class="row">
                <div class="col-md-12">
                    <h4 style="margin-bottom: 2rem">Marcar Servicio con Estado Operacional "Atrasado":</h4>
                    @foreach($etapas as $etapa)
                        @if($etapa->id==1||$etapa->id==2||$etapa->id==5)
                            <div class="row" style="margin-bottom: 0.25rem">
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label" style="margin-top: 0.5rem"> Si la Etapa de "{{$etapa->nombre}}" no está preparada a los:</label>
                                </div>
                                <div class="col-md-1 col-sm-12">
                                    <input id="etapa{{$etapa->id}}" onkeyup="formatoNumero('etapa{{$etapa->id}}');" onchange="validarNoNulo(document.getElementById('etapa{{$etapa->id}}').value,'etapa{{$etapa->id}}');" type="text" class="form-control" name="disenio" value="{{$etapa->tiempo_limite}}" placeholder="Cantidad de días" maxlength="2"  >
                                    <div id="etapa{{$etapa->id}}-alert" class="invalid-feedback">Debe ingresar un número de días.</div>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    @if($etapa->id==1||$etapa->id==2)
                                        <label class="form-label" style="margin-top: 0.5rem"> días antes de la Ejecución.</label>
                                    @else
                                        @if($etapa->id==5)
                                            <label class="form-label" style="margin-top: 0.5rem"> días después de la Ejecución.</label>
                                        @else
                                            <label class="form-label" style="margin-top: 0.5rem"> días después de la Ejecución.</label>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="row" style="margin-bottom: 0.25rem" hidden>
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label" style="margin-top: 0.5rem"> Si la Etapa de "{{$etapa->nombre}}" no está preparada a los:</label>
                                </div>
                                <div class="col-md-1 col-sm-12">
                                    <input id="etapa{{$etapa->id}}" onkeyup="formatoNumero('etapa{{$etapa->id}}');" onchange="validarNoNulo(document.getElementById('etapa{{$etapa->id}}').value,'etapa{{$etapa->id}}');" type="text" class="form-control" name="disenio" value="{{$etapa->tiempo_limite}}" placeholder="Cantidad de días" maxlength="2"  >
                                    <div id="etapa{{$etapa->id}}-alert" class="invalid-feedback">Debe ingresar un número de días.</div>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    @if($etapa->id==1||$etapa->id==2)
                                        <label class="form-label" style="margin-top: 0.5rem"> días antes de la Ejecución.</label>
                                    @else
                                        @if($etapa->id==5)
                                            <label class="form-label" style="margin-top: 0.5rem"> días después de la Ejecución.</label>
                                        @else
                                            <label class="form-label" style="margin-top: 0.5rem"> días después de la Ejecución.</label>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <hr>
            <div id="parametros" data-data="{{$parametrosJson}}"></div>
            <div class="row">
                <div class="col-md-12">
                    <h4 style="margin-bottom: 2rem">Notificar:</h4>
                    @foreach($parametros as $parametro)
                        <div class="row" style="margin-bottom: 0.25rem">
                            @if($parametro->id==1)
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label" style="margin-top: 0.5rem"> Si la Propuesta no se ha marcado como envíada a los:</label>
                                </div>
                                <div class="col-md-1 col-sm-12">
                                    <input id="parametro{{$parametro->id}}" onkeyup="formatoNumero('parametro{{$parametro->id}}');" onchange="validarNoNulo(document.getElementById('parametro{{$parametro->id}}').value,'parametro{{$parametro->id}}');" type="text" class="form-control" name="disenio" value="{{$parametro->tiempo_limite}}" placeholder="Cantidad de días" maxlength="2"  >
                                    <div id="parametro{{$parametro->id}}-alert" class="invalid-feedback">Debe ingresar un número de días.</div>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    <label class="form-label" style="margin-top: 0.5rem"> días antes de la Fecha de Compromiso.</label>
                                </div>
                            @endif
                            @if($parametro->id==2)
                                <div hidden="true">
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label" style="margin-top: 0.5rem"> Si los Diplomas de un Servicio no se han marcado como impreso a los:</label>
                                    </div>
                                    <div class="col-md-1 col-sm-12">
                                        <input id="parametro{{$parametro->id}}" onkeyup="formatoNumero('parametro{{$parametro->id}}');" onchange="validarNoNulo(document.getElementById('parametro{{$parametro->id}}').value,'parametro{{$parametro->id}}');" type="text" class="form-control" name="disenio" value="{{$parametro->tiempo_limite}}" placeholder="Cantidad de días" maxlength="2"  >
                                        <div id="parametro{{$parametro->id}}-alert" class="invalid-feedback">Debe ingresar un número de días.</div>
                                    </div>
                                    <div class="col-md-5 col-sm-12">
                                        <label class="form-label" style="margin-top: 0.5rem"> días después de la fecha de Ejecución.</label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="card-footer row">
            <div class="col-md-12 col-sm-12 text-right">
                <button type="button" onclick="enviarDatos();" id="button-crear" class="btn btn-primary" >Guardar Cambios</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/validaciones/validacion_no_nulo.js"></script>
    <script src="/js/validaciones/validacion_numero.js"></script>
    <script src="/js/parametro/edit.js"></script>
    <script src="/js/formato_numeros.js"></script>
@endsection