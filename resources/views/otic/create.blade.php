@extends('layouts.app')

@section('titulo', 'Crear OTIC')
    @section('contenido')

        <div class="card  col-lg-8 col-md-12 mx-auto">
            <div class="card-header">
                <h3 class="card-title">Crear OTIC</h3>
            </div>
            <div class="card-body">
                <div id="error_bd_contorno" style="visibility:hidden" alert="alert">
                    <label id="error_bd" style="visibility:hidden"></label>
                </div>
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Nombre*</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre" maxlength="191" autofocus >
                            <div id="nombre-alert" class="invalid-feedback">Debe ingresar un nombre.</div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">RUT*</label>
                            <input id="rut" onchange="validarRut(document.getElementById('rut').value);" type="text" class="form-control" name="rut" placeholder="RUT" maxlength="191" >
                            <div id="rut-alert" class="invalid-feedback">El RUT ingresado no es válido.</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Correo Electrónico</label>
                            <input id="mail" onchange="validarEmail(document.getElementById('mail').value,'mail');" type="text" class="form-control" name="mail" placeholder="Correo Electrónico" maxlength="191" >
                            <div id="mail-alert" class="invalid-feedback">El correo electrónico ingresado no es válido.</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Dirección</label>
                            <input id="direccion" type="text" class="form-control" name="direccion" placeholder="Nombre Calle/Pasaje y número" maxlength="191" >
                            <div id="direccion-alert" class="invalid-feedback">Debe ingresar una dirección.</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Teléfono Fijo</label>
                            <input id="telefono_fijo" onchange="validarTelefonoFijo(document.getElementById('telefono_fijo').value,'telefono_fijo');" type="text" class="form-control" name="telefono_fijo" placeholder="000 000 0000" maxlength="191" >
                            <div id="telefono_fijo-alert" class="invalid-feedback">El número de Teléfono Fijo sólo puede contener  entre 6 y 10 dígitos. Debe ingresar al menos un teléfono.</div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Teléfono Móvil</label>
                            <input id="celular" onchange="validarCelular(document.getElementById('celular').value,'celular');" type="text" class="form-control" name="celular"  placeholder="+000 0000 0000" maxlength="191">
                            <div id="celular-alert" class="invalid-feedback">El Teléfono Móvil debe contener el código "+569" y  8 dígitos. Debe ingresar al menos un teléfono.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer row">
                <div class="col-md-6 col-sm-12">
                    <a href="/otic" class="btn btn-secondary">Cancelar</a>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <button type="button" onclick="enviarDatos();" id="button-crear" class="btn btn-primary">Crear OTIC</button>
                </div>
            </div>
        </div>

    @endsection

    @section('scripts')
        <script src="/js/validaciones/validacion_mail.js"></script>
        <script src="/js/validaciones/validacion_telefono_fijo.js"></script>
        <script src="/js/validaciones/validacion_celular.js"></script>
        <script src="/js/validaciones/validacion_rut.js"></script>
        <script src="/js/validaciones/validacion_no_nulo.js"></script>
        <script src="/js/otic/create.js"></script>
    @endsection
