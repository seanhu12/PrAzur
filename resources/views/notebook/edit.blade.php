@extends('layouts.app')

@section('titulo', 'Editar Notebook')
@section('contenido')

    <div class="card  col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <h3 class="card-title">Editar Notebook</h3>
        </div>
        <div class="card-body">
            <div id="error_bd_contorno" style="visibility:hidden" alert="alert">
                <label id="error_bd" style="visibility:hidden"></label>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Código</label>
                        <input id="codigo" onchange="validarCodigo(document.getElementById('codigo').value,'codigo');" type="text" class="form-control" name="codigo" value="{{$notebook->codigo}}" placeholder="Código alfanumérico" maxlength="191"autofocus  readonly>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Fecha de Adquisición*</label>
                        <input id="fecha_adquisicion" onchange="validarFechaNoFutura(document.getElementById('fecha_adquisicion').value,'fecha_adquisicion');" type="date" class="form-control" name="fecha_adquisicion" value="{{$notebook->fecha_adquisicion}}" placeholder="Fecha de adquisición"  >
                        <div id="fecha_adquisicion-alert" class="invalid-feedback">La fecha de adquisición es obligatoria. La fecha no puede ser posterior a la actual.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Marca*</label>
                        <input id="marca" onchange="validarNombreLargo(document.getElementById('marca').value,'marca');" type="text" class="form-control" name="marca"value="{{$notebook->marca}}" placeholder="Marca" maxlength="191"  >
                        <div id="marca-alert" class="invalid-feedback">La marca ingresado no es válido. Sólo puede haber un espacio entre cada palabra.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        {{-- <label class="form-label">Foto</label> --}}
                        <label style="font-size: 0.875rem"><b>Foto:</b> {{$notebook->file_name}}</label>
                        <a href="/notebook/download/{{$notebook->id}}" class="btn btn-cyan pull-right btn-sm" title="Descargar Foto Actual"><i class="fas fa-file-download"> </i></a>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="custom_file_notebook" name="custom_file_notebook"  readonly>
                            <label class="custom-file-label" for="custom_file_notebook">Seleccionar archivo...</label>
                            <div id="custom_file_notebook-alert" class="invalid-feedback">Se debe seleccionar un archivo de tipo png, jpeg o jpg de tamaño máximo 5 mb.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer row">
            <div class="col-md-6 col-sm-12">
                <a href="/notebook" class="btn btn-secondary">Cancelar</a>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <button type="button" onclick="actualizarDatos({{$notebook->id}});" id="button-crear" class="btn btn-primary" >Guardar Cambios</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/validaciones/validacion_codigo.js"></script>
    <script src="/js/validaciones/validacion_nombre_largo.js"></script>
    <script src="/js/validaciones/validacion_fecha_no_futura.js"></script>
    <script src="/js/validaciones/validacion_no_nulo.js"></script>
    <script src="/js/notebook/edit.js"></script>
    <script src="/js/notebook/edit_file.js"></script>
@endsection