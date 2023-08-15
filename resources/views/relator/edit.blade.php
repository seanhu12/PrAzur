@extends('layouts.app')

@section('titulo', 'Editar Relator')
@section('contenido')

    <div class="card  col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <h3 class="card-title">Editar Relator</h3>
        </div>
        <div class="card-body">
            <div id="error_bd_contorno" style="visibility:hidden" alert="alert">
                <label id="error_bd" style="visibility:hidden"></label>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Nombre*</label>
                        <input id="nombre" onchange="validarNombre(document.getElementById('nombre').value,'nombre');" type="text" class="form-control" name="nombre" value="{{$relator->nombre}}" placeholder="Nombre" maxlength="191" autofocus >
                        <div id="nombre-alert" class="invalid-feedback">El nombre puede contener solamente letras  y solo un espacio entre palabras.</div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Apellido*</label>
                        <input id="apellido" onchange="validarNombre(document.getElementById('apellido').value,'apellido');" type="text" class="form-control" name="apellido" value="{{$relator->apellido}}" placeholder="Apellido" maxlength="191"  >
                        <div id="apellido-alert" class="invalid-feedback">El nombre puede contener solamente letras  y solo un espacio entre palabras.</div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">RUT</label>
                        <input id="rut" onchange="validarRut(document.getElementById('rut').value);" type="text" class="form-control" name="rut" value="{{$relator->rut}}" placeholder="RUT" maxlength="191"  readonly>
                        <div id="rut-alert" class="invalid-feedback">El RUT ingresado no es válido.</div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <div id="data-tag" data-data='{{$ciudadesJson}}'></div>
                        <div id="data-tag-ciudad" data-data='{{$ciudadId}}'></div>
                        <label for="select-beast" class="form-label">Ciudad</label>
                        <select id="select-beast" type="text" tabindex="-1" placeholder="Seleccione una ciudad..." class="form-control" ></select>
                        <div id="select-beast-alert" class="invalid-feedback">Debe seleccionar una Ciudad.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Correo Electrónico</label>
                        <input id="mail" onchange="validarEmail(document.getElementById('mail').value,'mail');" type="text" class="form-control" name="mail" value="{{$relator->mail}}" placeholder="Correo Electrónico" maxlength="191" >
                        <div id="mail-alert" class="invalid-feedback">El correo electrónico ingresado no es válido.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Teléfono Móvil</label>
                        <input id="celular" onchange="validarCelular(document.getElementById('celular').value,'celular');" type="text" class="form-control" name="celular" value="{{$relator->celular}}" placeholder="+000 0000 0000" maxlength="191">
                        <div id="celular-alert" class="invalid-feedback">El Teléfono Móvil sólo puede contener 8 dígitos y debe contener el código "+569".</div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Fecha vencimiento Vigencia SENCE</label>
                        <input id="vigencia_sence"  onchange="validarFechaNoPasada(document.getElementById('vigencia_sence').value,'vigencia_sence');" type="date" class="form-control" name="vigencia_sence" value="{{$relator->vigencia_sence}}" placeholder="Fecha" maxlength="191" >
                        <div id="vigencia_sence-alert" class="invalid-feedback">La fecha de vencimiento de vigencia es obligatoria. La fecha no puede ser anterior a la actual.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Certificaciones del Relator </label>
                        @foreach ($relator->documentos_relator() as $file)
                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{$file->file_name}}</label>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="btn btn-cyan btn-sm" href="/relator/descargar_archivo/{{$file->hash_file_name}}/{{$file->file_name}}" title="Descargar"><i class="fas fa-file-download"></i></a>
                                    <button class="btn btn-indigo btn-sm" onclick="eliminarArchivo({{$file->id}});"><i class="fas fa-trash-alt" title="Eliminar"></i></button>
                                </div>
                            </div>
                        @endforeach
                        <div class="custom-file">
                            <input  id="custom-file-archivo" type="file" class="custom-file-input" multiple >
                            <label class="custom-file-label" for="custom-file-archivo">Seleccionar archivos...</label>
                            <div id="custom-file-archivo-alert" class="invalid-feedback">Sólo se pueden subir hasta 10 archivos. Se deben seleccionar  archivos de tipo doc, docx, xls, xlsx, ppt, pptx, png, jpeg, jpg o pdf de tamaño máximo 5 mb cada uno.</div>
                        </div>
                        <div id="archivos_relator"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer row">
            <div class="col-md-6 col-sm-12">
                <a href="/relator/show/{{$relator->id}}" class="btn btn-secondary">Cancelar</a>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <button type="button" onclick="enviarDatos({{$relator->id}});" id="button-crear" class="btn btn-primary" >Guardar Cambios</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/validaciones/validacion_mail.js"></script>
    <script src="/js/validaciones/validacion_celular.js"></script>
    <script src="/js/validaciones/validacion_nombre.js"></script>
    <script src="/js/validaciones/validacion_rut.js"></script>
    <script src="/js/validaciones/validacion_no_nulo.js"></script>
    <script src="/js/validaciones/validacion_fecha_no_pasada.js"></script>
    <script src="/js/relator/edit.js"></script>
@endsection
