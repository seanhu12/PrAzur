@extends('layouts.app')

@section('titulo', 'Editar Meta Venta')
@section('contenido')

    <div class="card  col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <h3 class="card-title">Editar Meta de Venta para {{$empresa->nombre}}</h3>
        </div>
        <div class="card-body">
            <div id="error_bd_contorno" style="visibility:hidden" alert="alert">
                <label id="error_bd" style="visibility:hidden"></label>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Año*</label>
                        <input id="anio" onchange="validarAnioFuturo(document.getElementById('anio').value,'anio');" type="text" class="form-control" value="{{$metaVenta->anio}}" name="anio" placeholder="Año" maxlength="4" autofocus  readonly>
                        <div id="anio-alert" class="invalid-feedback">El año solo puede tener 4 dígitos y no menor al año presente. El campo es obligatorio.</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="mes" class="form-label">Mes*</label>
                        <input id="mes"  type="text" class="form-control"  name="mes" placeholder="Mes" value="{{$metaVenta->get_nombre_mes()}}" maxlength="191" autofocus  readonly>
                        <div id="mes-alert" class="invalid-feedback">Se debe seleccionar un Mes.</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Monto*</label>
                        <input id="monto_meta" type="text" class="form-control" name="monto_meta" value="{{$metaVenta->monto_meta}}" placeholder="Monto" maxlength="13">
                        <div id="monto_meta-alert" class="invalid-feedback">El monto tiene que ser mayor a 0 y menor a 999999999. El campo es obligatorio.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer row">
            <div class="col-md-6 col-sm-12">
                <a href="/metas_venta/{{$empresa->id}}" class="btn btn-secondary">Cancelar</a>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <button type="button" onclick="updateDatos({{$metaVenta->id}});" id="button-crear" class="btn btn-primary" >Guardar Cambios</button>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/validaciones/validacion_no_nulo.js"></script>
    <script src="/js/validaciones/validacion_anio_futuro.js"></script>
    <script src="/js/validaciones/validacion_anio_futuro.js"></script>
    <script src="/js/formato_numeros.js"></script>
    <script src="/js/empresa/metas_venta/edit.js"></script>
@endsection
