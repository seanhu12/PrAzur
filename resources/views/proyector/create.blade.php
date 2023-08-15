@extends('layouts.app')

@section('titulo', 'Crear Proyector')
    @section('contenido')

        <div class="card col-xl-8 col-lg-10 col-md-12 mx-auto">
            <div class="card-header">
                <h3 class="card-title">Crear Proyector</h3>
            </div>
            <div class="card-body">
                <div id="error_bd_contorno" style="visibility:hidden" alert="alert">
                    <label id="error_bd" style="visibility:hidden"></label>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Fecha de Adquisición*</label>
                            <input id="fecha_adquisicion" onchange="validarFechaNoFutura(document.getElementById('fecha_adquisicion').value,'fecha_adquisicion');" type="date" class="form-control" name="fecha_adquisicion" placeholder="Fecha de adquisición"  >
                            <div id="fecha_adquisicion-alert" class="invalid-feedback">La fecha de adquisición es obligatoria. La fecha no puede ser posterior a la actual.</div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Foto*</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="custom_file_proyector" name="custom_file_proyector"  >
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
                    <button type="button" onclick="enviarDatos();" id="button-crear" class="btn btn-primary" >Crear Proyector</button>
                </div>
            </div>
        </div>

    @endsection

    @section('scripts')
        <script src="/js/validaciones/validacion_codigo.js"></script>
        <script src="/js/validaciones/validacion_fecha_no_futura.js"></script>
        <script src="/js/validaciones/validacion_nombre_largo.js"></script>
        <script src="/js/validaciones/validacion_no_nulo.js"></script>
        <script src="/js/proyector/create.js"></script>
        <script src="/js/proyector/create_file.js"></script>
    @endsection
