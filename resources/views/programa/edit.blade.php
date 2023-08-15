@extends('layouts.app')

@section('titulo', 'Editar Programa')
    @section('contenido')

        <div class="card col-lg-8 col-md-12 mx-auto">
            <div class="card-header">
                <h3 class="card-title">Editar Programa</h3>
            </div>
            <div class="card-body">
                <div id="error_bd_contorno" style="visibility:hidden" role="alert">
                    <label id="error_bd" style="visibility:hidden"></label>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Nombre*</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" value="{{$programa->nombre}}" placeholder="Nombre" maxlength="191" autofocus >
                            <div id="nombre-alert" class="invalid-feedback">Debe ingresar un nombre.</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <div id="data-tag" data-data='{{$cursosJson}}'></div>
                            <div id="data-tag-curso" data-data='{{$cursosProgramaArray}}'></div>
                            <label class="form-label">Cursos*</label>
                            <input id="input-tags" type="text" autocomplete="off" tabindex="" placeholder="Cursos" class="form-control" >
                            <div id="input-tags-alert" class="invalid-feedback">Se deben seleccionar al menos dos cursos.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer row">
                <div class="col-md-6 col-sm-12">
                    <a href="/programa/show/{{$programa->id}}" class="btn btn-secondary">Cancelar</a>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <button type="button" onclick="enviarDatos({{$programa->id}});" id="button-crear" class="btn btn-primary" >Guardar Cambios</button>
                </div>
            </div>
        </div>

    @endsection

    @section('scripts')
        <script src="/js/validaciones/validacion_no_nulo.js"></script>
        <script src="/js/programa/edit.js"></script>
    @endsection