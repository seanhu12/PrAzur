@extends('layouts.app')

@section('titulo', 'Modificar Contraseña Usuario')
    @section('contenido')

        <div class="card col-lg-5 col-md-7 mx-auto">
            <div class="card-header">
                <h3 class="card-title">Modificar Contraseña Usuario: {{ $user->rut }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Contraseña*</label>
                                <input id="password" onchange="validarContrasenia(document.getElementById('password').value,'password');" type="password" class="form-control" name="password" placeholder="******" maxlength="191" >
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
                </div>
            </div>
            <div class="card-footer row">
                <div class="col-md-6 col-sm-12">
                    <a href="/usuario/show/{{$user->id}}" class="btn btn-secondary">Cancelar</a>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <button type="button" onclick="enviarDatos({{$user->id}});" id="button-crear" class="btn btn-primary" >Guardar Cambios</button>
                </div>
            </div>
        </div>

    @endsection

    @section('scripts')
        <script src="/js/usuario/confirmar_contrasenia.js"></script>
        <script src="/js/validaciones/validacion_contrasenia.js"></script>
        <script src="/js/validaciones/validacion_no_nulo.js"></script>
        <script src="/js/usuario/cambiar_password.js"></script>
    @endsection