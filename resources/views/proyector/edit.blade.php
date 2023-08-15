@extends('layouts.app')

@section('titulo', 'Editar Proyector')
@section('contenido')

    <div class="card  col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <h3 class="card-title">Editar Proyector</h3>
        </div>
        <div class="card-body">
            <div id="error_bd_contorno" style="visibility:hidden" alert="alert">
                <label id="error_bd" style="visibility:hidden"></label>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Código</label>
                        <input id="codigo" type="text" class="form-control" name="codigo" value="{{$proyector->codigo}}" placeholder="Código alfanumérico" maxlength="191" autofocus  readonly>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Fecha de Adquisición*</label>
                        <input id="fecha_adquisicion" onchange="validarFechaNoFutura(document.getElementById('fecha_adquisicion').value,'fecha_adquisicion');" type="date" class="form-control" name="fecha_adquisicion" value="{{$proyector->fecha_adquisicion}}" placeholder="Fecha de adquisición"  >
                        <div id="fecha_adquisicion-alert" class="invalid-feedback">La fecha de adquisición es obligatoria. La fecha no puede ser posterior a la actual.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        {{-- <label class="form-label">Foto</label> --}}
                        <label style="font-size: 0.875rem"><b>Foto:</b> {{$proyector->file_name}}</label>
                        <a href="/proyector/download/{{$proyector->id}}" class="btn btn-cyan pull-right btn-sm" title="Descargar Foto Actual"><i class="fas fa-file-download"> </i></a>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="custom_file_proyector" name="custom_file_proyector"  readonly>
                            <label class="custom-file-label" for="custom_file_proyector">Seleccionar archivo...</label>
                            <div id="custom_file_proyector-alert" class="invalid-feedback">Se debe seleccionar un archivo de tipo png, jpeg o jpg de tamaño máximo 5 mb.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer row">
            <div class="col-md-6 col-sm-12">
                <a href="/proyector" class="btn btn-secondary">Cancelar</a>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <button type="button" onclick="actualizarDatos({{$proyector->id}});" id="button-crear" class="btn btn-primary" >Guardar Cambios</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/validaciones/validacion_codigo.js"></script>
    <script src="/js/validaciones/validacion_fecha_no_futura.js"></script>
    <script src="/js/validaciones/validacion_nombre_largo.js"></script>
    <script src="/js/validaciones/validacion_no_nulo.js"></script>
    <script src="/js/proyector/edit.js"></script>
    <script src="/js/proyector/edit_file.js"></script>
@endsection