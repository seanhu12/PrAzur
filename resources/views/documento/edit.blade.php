@extends('layouts.app')

@section('titulo', 'Editar Documento')
@section('contenido')

    <div class="card  col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <h3 class="card-title">Editar Documento</h3>
        </div>
        <div class="card-body">
            <div id="error_bd_contorno" style="visibility:hidden" alert="alert">
                <label id="error_bd" style="visibility:hidden"></label>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Nombre*</label>
                        <input id="nombre" type="text" class="form-control" name="nombre" value="{{$documento->nombre}}"placeholder="Nombre" maxlength="191" autofocus >
                        <div id="nombre-alert" class="invalid-feedback">Debe ingresar un nombre.</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Código</label>
                        <input id="codigo" type="text" class="form-control" name="codigo" value="{{$documento->codigo}}" placeholder="Código alfanumérico" maxlength="191"  readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Tipo</label>
                        <input id="tipo" type="text" class="form-control" name="tipo" value="{{$tipo->nombre}}" placeholder="Tipo" maxlength="191"  readonly>
                        <div id="tipo-alert" class="invalid-feedback">El tipo es requerido.</div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <div id="data-tag-tematicas" data-data='{{$tematicasJson}}'></div>
                        <div id="data-tag-tematica" data-data='{{$tematicaId}}'></div>
                        <label for="select_beast_tematicas" class="form-label">Temática*</label>
                        <select id="select_beast_tematicas" type="text"  tabindex="-1" placeholder="Seleccione una temática..." class="form-control" ></select>
                        <div id="select_beast_tematicas-alert" class="invalid-feedback">Se debe seleccionar una Temática.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Archivo</label>
                        <label>{{$documento->file_name}}</label>
                        <a href="/documento/download/{{$documento->id}}" class="btn btn-primary btn-lime pull-right btn-sm" title="Descargar Archivo Actual"><i class="fas fa-file-download"> </i></a>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="custom_file_archivo" name="custom_file_archivo"  readonly>
                            <label class="custom-file-label" for="custom_file_archivo">Seleccionar archivo...</label>
                            <div id="custom_file_archivo-alert" class="invalid-feedback">Se debe seleccionar un archivo de tipo doc, docx, xls, xlsx, ppt, pptx, png, jpeg, jpg o pdf de tamaño máximo 30 mb.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="guardando-datos" style="margin-top:1rem;" class="text-right" hidden>
                <button type="button" class="btn btn-secondary btn-loading">C</button>Guardando
            </div>
        </div>
        <div class="card-footer row">
            <div class="col-md-6 col-sm-12">
                <a href="/documento/show/{{$documento->id}}" class="btn btn-secondary">Cancelar</a>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <button  type="button" onclick="enviarDatos({{$documento->id}});" id="button-crear" class="btn btn-primary" >Guardar Cambios</button>
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
    <script src="/js/documento/edit.js"></script>
    <script src="/js/documento/edit_file.js"></script>
@endsection