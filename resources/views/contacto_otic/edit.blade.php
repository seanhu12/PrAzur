@extends('layouts.app')

@section('titulo', 'Editar Contacto OTIC')
@section('contenido')

    <div class="card  col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <h3 class="card-title">Editar Contacto de OTIC</h3>
        </div>
        <div class="card-body">
            <div id="error_bd_contorno" style="visibility:hidden" alert="alert">
                <label id="error_bd" style="visibility:hidden"></label>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Nombre*</label>
                        <input id="nombre" onchange="validarNombre(document.getElementById('nombre').value,'nombre');" type="text" class="form-control" name="nombre"  value="{{$contactoOtic->nombre}}" placeholder="Nombre" maxlength="191" autofocus >
                        <div id="nombre-alert" class="invalid-feedback">El nombre puede contener solamente letras  y solo un espacio entre palabras (Máximo dos palabras).</div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Apellido*</label>
                        <input id="apellido" onchange="validarApellido(document.getElementById('apellido').value,'apellido');" type="text" class="form-control" name="apellido" value="{{$contactoOtic->apellido}}" placeholder="Apellido" maxlength="191" >
                        <div id="apellido-alert" class="invalid-feedback">El apellido puede contener solamente letras  y solo un espacio entre palabras (Máximo dos palabras).</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Correo Electrónico*</label>
                        <input id="mail" onchange="validarEmail(document.getElementById('mail').value,'mail');" type="text" class="form-control" name="mail" value="{{$contactoOtic->mail}}" placeholder="Correo Electrónico" maxlength="191" >
                        <div id="mail-alert" class="invalid-feedback">El correo electrónico ingresado no es válido.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <div id="data-tag" data-data='{{$oticsJson}}'></div>
                        <div id="data-tag-otic" data-data='{{$oticId}}'></div>
                        <label for="select-beast" class="form-label">OTIC*</label>
                        <select id="select-beast" type="text"  tabindex="-1" placeholder="Seleccione una OTIC..." class="form-control" ></select>
                        <div id="select-beast-alert" class="invalid-feedback">Debe seleccionar una OTIC.</div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Área de la OTIC*</label>
                        <input id="area" onchange="validarNoNulo(document.getElementById('area').value,'area');" type="text" class="form-control" name="area" value="{{$contactoOtic->area}}" placeholder="Área" maxlength="191" >
                        <div id="area-alert" class="invalid-feedback">Debe ingresar un área.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Dirección*</label>
                        <input id="direccion"  onchange="validarNoNulo(document.getElementById('direccion').value,'direccion');" type="text" class="form-control" name="direccion" value="{{$contactoOtic->direccion}}" placeholder="Nombre Calle/Pasaje y número" maxlength="191" >
                        <div id="direccion-alert" class="invalid-feedback">Debe ingresar una dirección.</div>
                    </div>
                </div>
            </div>
            <label class="form-label">Teléfono*</label>
            <div class="row" style="margin-left: .5rem">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Fijo</label>
                        <input id="telefono_fijo" onchange="validarTelefonoFijo(document.getElementById('telefono_fijo').value,'telefono_fijo');" type="text" class="form-control" value="{{$contactoOtic->telefono_fijo}}" name="telefono_fijo" placeholder="000 000 0000" maxlength="191" >
                        <div id="telefono_fijo-alert" class="invalid-feedback">El número de Teléfono Fijo sólo puede contener  entre 6 y 10 dígitos. Debe ingresar al menos un teléfono.</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Móvil</label>
                        <input id="celular" onchange="validarCelular(document.getElementById('celular').value,'celular');" type="text" class="form-control" value="{{$contactoOtic->celular}}" name="celular"  placeholder="+000 0000 0000" maxlength="191">
                        <div id="celular-alert" class="invalid-feedback">El Teléfono Móvil debe contener el código "+569" y  8 dígitos. Debe ingresar al menos un teléfono.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer row">
            <div class="col-md-6 col-sm-12">
                <a href="/contacto_otic/show/{{$contactoOtic->id}}" class="btn btn-secondary">Cancelar</a>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <button type="button" onclick="enviarDatos({{$contactoOtic->id}});" id="button-crear" class="btn btn-primary" >Guardar Cambios</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/validaciones/validacion_mail.js"></script>
    <script src="/js/validaciones/validacion_telefono_fijo.js"></script>
    <script src="/js/validaciones/validacion_celular.js"></script>
    <script src="/js/validaciones/validacion_nombre.js"></script>
    <script src="/js/validaciones/validacion_apellido.js"></script>
    <script src="/js/validaciones/validacion_rut.js"></script>
    <script src="/js/validaciones/validacion_no_nulo.js"></script>
    <script src="/js/contacto_otic/edit.js"></script>
@endsection
