@extends('layouts.app')

@section('titulo', 'Editar Orden de Compra')
@section('contenido')

    <div class="card  col-lg-6 col-md-12 mx-auto">
        <div class="card-header">
            <h3 class="card-title">Editar Orden de Compra para el Servicio {{$servicio->nombre}}</h3>
        </div>
        <div class="card-body">
            <div id="error_bd_contorno" style="visibility:hidden" alert="alert">
                <label id="error_bd" style="visibility:hidden"></label>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Número*</label>
                        <input id="numero" onchange="validarNumero(document.getElementById('numero').value,'numero');" type="text" class="form-control" name="numero" value="{{$ordenCompra->numero}}" placeholder="numero" maxlength="9" autofocus >
                        <div id="numero-alert" class="invalid-feedback">Debe ingresar un número.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <div id="data-tag-empresas" data-data='{{$empresasJson}}'></div>
                        <div id="data-tag-empresa" data-data='{{$empresaId}}'></div>
                        <label for="select-beast-empresas" class="form-label">Empresa*</label>
                        <select id="select-beast-empresas" type="text"  tabindex="-1" placeholder="Seleccione una Empresa..." class="form-control" ></select>
                        <div id="select-beast-empresas-alert" class="invalid-feedback">Se debe seleccionar una Empresa.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer row">
            <div class="col-md-6 col-sm-12">
                <a href="/orden_compra/{{$servicio->id}}" class="btn btn-secondary">Cancelar</a>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <button type="button" onclick="enviarDatos({{$ordenCompra->id}},'{{$servicio->id}}');" id="button-crear" class="btn btn-primary" >Guardar Cambios</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/validaciones/validacion_no_nulo.js"></script>
    <script src="/js/validaciones/validacion_numero.js"></script>
    <script src="/js/orden_compra/edit.js"></script>
@endsection