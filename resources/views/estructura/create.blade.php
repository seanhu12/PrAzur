@extends('layouts.app')

@section('titulo', 'Crear Estructura')
    @section('contenido')

        <div class="card  col-lg-8 col-md-12 mx-auto">
            <div class="card-header">
                <h3 class="card-title">Crear Estructura para {{$curso->nombre_venta}}</h3>
            </div>
            <div class="card-body">
                <div id="error_bd_contorno" style="visibility:hidden" alert="alert">
                    <label id="error_bd" style="visibility:hidden"></label>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Nombre*</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre" maxlength="191" autofocus >
                            <div id="nombre-alert" class="invalid-feedback">Debe ingresar un nombre.</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Archivo*</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="custom_file_estructura" name="custom_file_estructura"  >
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
                    <button  type="button" onclick="enviarDatos({{$curso->id}});" id="button-crear" class="btn btn-primary" >Crear Estructura</button>
                </div>
            </div>
        </div>

    @endsection

    @section('scripts')
        <script src="/js/validaciones/validacion_nombre_largo.js"></script>
        <script src="/js/validaciones/validacion_no_nulo.js"></script>
        <script src="/js/validaciones/validacion_numero.js"></script>
        <script src="/js/validaciones/validacion_anio.js"></script>
        <script src="/js/estructura/create.js"></script>
        <script src="/js/estructura/create_file.js"></script>
    @endsection
