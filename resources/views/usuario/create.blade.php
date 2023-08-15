@extends('layouts.app')

@section('titulo', 'Crear Usuario')
    @section('contenido')

        <div class="card col-lg-8 col-md-12 mx-auto">
            <div class="card-header">
                <h3 class="card-title">Crear Usuario</h3>
            </div>
            <div class="card-body">
                <div id="error_bd_contorno" class="alert alert-danger" role="alert" hidden>
                    <div id="error_bd"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Nombre*</label>
                            <input id="nombre" onchange="validarNombre(document.getElementById('nombre').value,'nombre');" type="text" class="form-control" name="nombre" placeholder="Nombre" maxlength="191" autofocus >
                            <div id="nombre-alert" class="invalid-feedback">El nombre ingresado no es válido</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">RUT*</label>
                            <input id="rut" onchange="validarRut(document.getElementById('rut').value);" type="text" class="form-control" name="rut" placeholder="RUT" maxlength="191" >
                            <div id="rut-alert" class="invalid-feedback">El RUT ingresado no es válido</div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Apellido*</label>
                            <input id="apellido" onchange="validarApellido(document.getElementById('apellido').value,'apellido');" type="text" class="form-control" name="apellido" placeholder="Apellido" maxlength="191" >
                            <div id="apellido-alert" class="invalid-feedback">El apellido ingresado no es válido</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Correo Electrónico*</label>
                            <input id="mail" onchange="validarEmail(document.getElementById('mail').value,'mail');" type="text" class="form-control" name="mail" placeholder="Correo Electrónico" maxlength="191" >
                            <div id="mail-alert" class="invalid-feedback">El correo electrónico ingresado no es válido</div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Contraseña*</label>
                                    <input id="password" onchange="validarContrasenia(document.getElementById('password').value,'password');" type="password" class="form-control" name="password" placeholder="******" autocomplete="new-password" maxlength="191" >
                                    <div id="password-alert" class="invalid-feedback">La contraseña debe tener entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula. No puede tener otros símbolos.</div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Confirmar Contraseña*</label>
                                    <input id="confirmar_password" onchange="confirmarContrasenia(document.getElementById('confirmar_password').value);" type="password" class="form-control" name="confirmar_password" placeholder="******" maxlength="191" >
                                    <div id="confirmar_password-alert" class="invalid-feedback">Las contraseñas no coinciden</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div id="data-tag" data-data='{{$rolesJson}}'></div>
                            <label class="form-label">Roles*</label>
                            <input id="input-tags" type="text" autocomplete="off" tabindex="" placeholder="Roles" class="form-control" >
                            <div id="input-tags-alert" class="invalid-feedback">Se debe seleccionar un rol</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer row">
                <div class="col-md-6 col-sm-12">
                    <a href="/usuario" class="btn btn-secondary">Cancelar</a>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <button type="button" onclick="enviarDatos();" id="button-crear" class="btn btn-primary" >Crear Usuario</button>
                </div>
            </div>
        </div>

    @endsection

    @section('scripts')
        <script src="/js/usuario/confirmar_contrasenia.js"></script>
        <script src="/js/validaciones/validacion_apellido.js"></script>
        <script src="/js/validaciones/validacion_contrasenia.js"></script>
        <script src="/js/validaciones/validacion_mail.js"></script>
        <script src="/js/validaciones/validacion_nombre.js"></script>
        <script src="/js/validaciones/validacion_rut.js"></script>
        <script src="/js/validaciones/validacion_no_nulo.js"></script>
        <script src="/js/usuario/create.js"></script>
    @endsection
