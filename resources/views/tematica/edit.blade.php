@extends('layouts.app')

@section('titulo', 'Editar Temática')
@section('contenido')

    <div class="card  col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <h3 class="card-title">Editar Temática</h3>
        </div>
        <div class="card-body">
            <div id="error_bd_contorno" style="visibility:hidden" alert="alert">
                <label id="error_bd" style="visibility:hidden"></label>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Nombre*</label>
                        <input id="nombre" type="text" class="form-control" name="nombre" value="{{$tematica->nombre}}" placeholder="Nombre" maxlength="191" autofocus >
                        <div id="nombre-alert" class="invalid-feedback">Debe ingresar un nombre.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer row">
            <div class="col-md-6 col-sm-12">
                <a href="/tematica" class="btn btn-secondary">Cancelar</a>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <button type="button" onclick="enviarDatos({{$tematica->id}});" id="button-crear" class="btn btn-primary" >Guardar Cambios</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/validaciones/validacion_no_nulo.js"></script>
    <script src="/js/tematica/edit.js"></script>
@endsection