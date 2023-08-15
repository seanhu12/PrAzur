@extends('layouts.app')

@section('titulo', 'Editar Curso')
@section('contenido')

    <div class="card  col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <h3 class="card-title">Editar Curso</h3>
        </div>
        <div class="card-body">
            <div id="error_bd_contorno" style="visibility:hidden" alert="alert">
                <label id="error_bd" style="visibility:hidden"></label>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Nombre de Venta*</label>
                        <input id="nombre_venta" type="text" class="form-control" name="nombre_venta" value="{{$curso->nombre_venta}}"placeholder="Nombre" maxlength="191" autofocus >
                        <div id="nombre_venta-alert" class="invalid-feedback">Debe ingresar un nombre.</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Código</label>
                        <input id="codigo" type="text" class="form-control" name="codigo" value="{{$curso->codigo}}" placeholder="Código alfanumérico" maxlength="191" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Descripción*</label>
                        <textarea id="descripcion" type="text" class="form-control" name="descripcion" placeholder="Descripción" maxlength="9999" >{{$curso->descripcion}}</textarea>
                        <div id="descripcion-alert" class="invalid-feedback">La descripción no puede estar vacía ni superar los 9999 caracteres.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Cantidad de Horas Prácticas*</label>
                        <input id="cant_horas_practicas" onchange="validarMaxDosDigitosDecimal('cant_horas_practicas');" type="text" class="form-control" name="cant_horas_practicas" value="{{$curso->cant_horas_practicas}}" placeholder="0" max="999999999" min="0" >
                        <div id="cant_horas_practicas-alert" class="invalid-feedback">La cantidad de horas no es válida. Debe ser un número con menos de 3 dígitos.</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Año de Creación*</label>
                        <input id="anio_creacion" onchange="validarAnioPasado(document.getElementById('anio_creacion').value,'anio_creacion');" type="text" class="form-control" name="anio_creacion" value="{{$curso->anio_creacion}}" placeholder="0" max="9999" min="1990" >
                        <div id="anio_creacion-alert" class="invalid-feedback">El año solo puede tener 4 dígitos, mayor a 1900 y menor al año presente. El campo es obligatorio.</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Cantidad de Participantes*</label>
                        <input id="cant_participantes" onchange="validarMaxDosDigitos('cant_participantes');" type="text" class="form-control" name="cant_participantes" value="{{$curso->cant_participantes}}" placeholder="0" max="999999999" min="0" >
                        <div id="cant_participantes-alert" class="invalid-feedback"> Debe ser un número con menos de 3 dígitos.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Cantidad de Horas Teóricas*</label>
                        <input id="cant_horas_teoricas" onchange="validarMaxDosDigitosDecimal('cant_horas_teoricas');" type="text" class="form-control" name="cant_horas_teoricas" value="{{$curso->cant_horas_teoricas}}" placeholder="0" max="999999999" min="0" >
                        <div id="cant_horas_teoricas-alert" class="invalid-feedback">La cantidad de horas no es válida. Debe ser un número con menos de 3 dígitos.</div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="form-group">
                        <div id="data-tag" data-data='{{$tematicasJson}}'></div>
                        <div id="data-tag-tematica" data-data='{{$tematicaId}}'></div>
                        <label for="select_beast_tematicas" class="form-label">Temática*</label>
                        <select id="select_beast_tematicas" type="text"  tabindex="-1" placeholder="Seleccione una temática..." class="form-control" ></select>
                        <div id="select_beast_tematicas-alert" class="invalid-feedback">Se debe seleccionar una Temática.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Cantidad de Horas Totales*</label>
                        <input id="cant_horas" type="text" class="form-control" name="cant_horas" value="{{$curso->cant_horas}}" placeholder="0" max="999999999" min="0"  readonly>
                        <div id="cant_horas-alert" class="invalid-feedback">La cantidad de horas no es válida. Debe ser un número con menos de 3 dígitos.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="custom-switches-stacked">
                        <div class="form-group">
                            <label class="custom-switch">
                                <input id="opcion_sence" type="checkbox" name="option"  class="custom-switch-input" >
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">SENCE</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Nombre de SENCE*</label>
                        <input id="nombre_sence"  type="text" class="form-control" name="nombre_sence" value="{{$curso->nombre_sence}}" placeholder="Nombre" maxlength="191" readonly>
                        <div id="nombre_sence-alert" class="invalid-feedback">El nombre ingresado no es válido. Sólo puede haber un espacio entre cada palabra.</div>
                    </div>
                </div>     <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Código de SENCE*</label>
                        <input id="codigo_sence" onchange="validarNumero(document.getElementById('codigo_sence').value,'codigo_sence');" type="text" class="form-control" name="codigo" value="{{$curso->codigo_sence}}" placeholder="Código" max="999999999" min="0" readonly>
                        <div id="codigo_sence-alert" class="invalid-feedback">El Código ingresado no es válido. Sólo puede ingresarse un código numérico y debe ser único.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Fecha vencimiento Vigencia*</label>
                        <input id="vigencia" onchange="validarFechaNoPasada(document.getElementById('vigencia').value,'vigencia');" type="date" class="form-control" name="vigencia" value="{{$curso->vigencia}}" placeholder="Fecha fin vigencia"  readonly>
                        <div id="vigencia-alert" class="invalid-feedback">La fecha de vencimiento de vigencia es obligatoria. La fecha no puede ser anterior a la actual.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer row">
            <div class="col-md-6 col-sm-12">
                <a href="/curso/show/{{$curso->id}}" class="btn btn-secondary">Cancelar</a>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <button  type="button" onclick="enviarDatos({{$curso->id}});" id="button-crear" class="btn btn-primary" >Guardar Cambios</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/validaciones/validacion_nombre_largo.js"></script>
    <script src="/js/validaciones/validacion_no_nulo.js"></script>
    <script src="/js/validaciones/validacion_fecha_no_pasada.js"></script>
    <script src="/js/validaciones/validacion_numero.js"></script>
    <script src="/js/formato_numeros.js"></script>
    <script src="/js/validaciones/validacion_anio_pasado.js"></script>
    <script src="/js/validaciones/validacion_codigo.js"></script>
    <script src="/js/curso/edit.js"></script>
@endsection