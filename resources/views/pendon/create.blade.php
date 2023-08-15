@extends('layouts.app')

@section('titulo', 'Crear Pendón')
    @section('contenido')

        <div class="card col-lg-8 col-md-12 mx-auto">
            <div class="card-header">
                <h3 class="card-title">Crear Pendón</h3>
            </div>
            <div class="card-body">
                <div id="error_bd_contorno" style="visibility:hidden" role="alert">
                    <label id="error_bd" style="visibility:hidden"></label>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Nombre*</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre" maxlength="191"  >
                            <div id="nombre-alert" class="invalid-feedback">Debe ingresar un nombre.</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Foto*</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="custom_file_pendon" name="custom_file_pendon"  >
                                <label class="custom-file-label" for="custom_file_pendon">Seleccionar archivo...</label>
                                <div id="custom_file_pendon-alert" class="invalid-feedback">Se debe seleccionar un archivo de tipo png, jpeg o jpg de tamaño máximo 5 mb.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <div id="data-tag" data-data='{{$tematicasJson}}'></div>
                            <label class="form-label">Temáticas*</label>
                            <input id="input-tags" type="text" autocomplete="off" tabindex="" placeholder="Temáticas" class="form-control" >
                            <div id="input-tags-alert" class="invalid-feedback">Se debe seleccionar una temática.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer row">
                <div class="col-md-6 col-sm-12">
                    <a href="/pendon" class="btn btn-secondary">Cancelar</a>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <button type="button" onclick="enviarDatos();" id="button-crear" class="btn btn-primary" >Crear Pendón</button>
                </div>
            </div>
        </div>

    @endsection

    @section('scripts')
        <script src="/js/validaciones/validacion_no_nulo.js"></script>
        <script src="/js/pendon/create.js"></script>
        <script src="/js/pendon/create_file.js"></script>
    @endsection
