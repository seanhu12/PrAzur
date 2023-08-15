@extends('layouts.app')

@section('titulo', 'Editar Estructura')
@section('contenido')

    <div class="card  col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <h3 class="card-title">Editar Estructura para {{$curso->nombre_venta}}</h3>
        </div>
        <div class="card-body">
            <div id="error_bd_contorno" style="visibility:hidden" alert="alert">
                <label id="error_bd" style="visibility:hidden"></label>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Nombre*</label>
                        <input id="nombre" type="text" class="form-control" name="nombre" value="{{$estructura->nombre}}"placeholder="Nombre" maxlength="191" autofocus >
                        <div id="nombre-alert" class="invalid-feedback">Debe ingresar un nombre.</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Código</label>
                        <input id="codigo" type="text" class="form-control" name="codigo" value="{{$estructura->codigo}}" placeholder="Código alfanumérico" maxlength="191" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Archivo</label>
                        <label>{{$estructura->file_name}}</label>
                        <a href="/estructura/download/{{$estructura->id}}" class="btn btn-primary btn-lime pull-right btn-sm" title="Descargar Estructura Actual"><i class="fas fa-file-download"> </i></a>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="custom_file_estructura" name="custom_file_estructura"  readonly>
                            <label class="custom-file-label" for="custom_file_estructura">Seleccionar archivo...</label>
                            <div id="custom_file_estructura-alert" class="invalid-feedback">Se debe seleccionar un archivo de tipo doc, docx, xls, xlsx, ppt, pptx, png, jpeg, jpg o pdf de tamaño máximo 5 mb.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer row">
            <div class="col-md-6 col-sm-12">
                <a href="/estructura/{{$curso->id}}" class="btn btn-secondary">Cancelar</a>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <button  type="button" onclick="enviarDatos({{$estructura->id}});" id="button-crear" class="btn btn-primary" >Guardar Cambios</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/validaciones/validacion_nombre_largo.js"></script>
    <script src="/js/validaciones/validacion_no_nulo.js"></script>
    <script src="/js/validaciones/validacion_numero.js"></script>
    <script src="/js/validaciones/validacion_anio.js"></script>
    <script src="/js/validaciones/validacion_codigo.js"></script>
    <script src="/js/estructura/edit.js"></script>
    <script src="/js/estructura/edit_file.js"></script>
@endsection