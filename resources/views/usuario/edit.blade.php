@extends('layouts.app')

@section('titulo', 'Editar Usuario')
    @section('contenido')

        <div class="card col-lg-8 col-md-12 mx-auto">
            <div class="card-header">
                <h3 class="card-title">Editar Usuario</h3>
            </div>
            <div class="card-body">
                <div id="error_bd_contorno" style="visibility:hidden" role="alert">
                    <label id="error_bd" style="visibility:hidden"></label>
                </div>
                <div class="row">
                    <div class="col-md-7 col-sm-12">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Nombre*</label>
                                <input id="nombre" onchange="validarNombre(document.getElementById('nombre').value,'nombre');" type="text" class="form-control" name="nombre" value="{{$user->nombre}}" placeholder="Nombre" maxlength="191" autofocus >
                                    <div id="nombre-alert" class="invalid-feedback">El nombre ingresado no es válido</div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Apellido*</label>
                                    <input id="apellido" onchange="validarApellido(document.getElementById('apellido').value,'apellido');" type="text" class="form-control" name="apellido" value="{{$user->apellido}}" placeholder="Apellido" maxlength="191" >
                                    <div id="apellido-alert" class="invalid-feedback">El apellido ingresado no es válido</div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">RUT</label>
                                    <input id="rut" type="text" class="form-control" name="rut" value="{{$user->rut}}" maxlength="191" readonly >
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Correo Electrónico*</label>
                                    <input id="mail" onchange="validarEmail(document.getElementById('mail').value,'mail');" type="text" class="form-control" name="mail" value="{{$user->mail}}" placeholder="Correo Electrónico" maxlength="191" >
                                    <div id="mail-alert" class="invalid-feedback">El correo electrónico ingresado no es válido</div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <div class="form-group">
                            <div id="data-tag" data-data='{{$rolesJson}}'></div>
                            <div id="data-tag-user" data-data='{{$rolesUserArray}}'></div>
                            <label class="form-label">Roles*</label>
                            <input id="input-tags" type="text" autocomplete="off" tabindex="" placeholder="Roles" class="form-control" >
                            <div id="input-tags-alert" class="invalid-feedback">Se debe seleccionar un rol</div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">RUT</label>
                                    <input id="rut" type="text" class="form-control" name="rut" value="{{$user->rut}}" maxlength="191" readonly >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <div id="data-tag" data-data='{{$rolesJson}}'></div>
                            <div id="data-tag-user" data-data='{{$rolesUserArray}}'></div>
                            <label class="form-label">Roles</label>
                            <input id="input-tags" type="text" autocomplete="off" tabindex="" placeholder="Roles" class="form-control" >
                            <div id="input-tag-alert" class="invalid-feedback">Se debe seleccionar un rol</div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="card-footer row">
                <div class="col-md-6 col-sm-12">
                    <a href="/usuario/show/{{$user->id}}" class="btn btn-secondary">Cancelar</a>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <button type="button" onclick="enviarDatos({{$user->id}});" id="button-editar" class="btn btn-primary" >Guardar Cambios</button>
                </div>
            </div>
        </div>

    @endsection

    @section('scripts')
        {{-- <script src="/js/usuario/confirmar_contrasenia.js"></script> --}}
        <script src="/js/validaciones/validacion_apellido.js"></script>
        {{-- <script src="/js/validaciones/validacion_contrasenia.js"></script> --}}
        <script src="/js/validaciones/validacion_mail.js"></script>
        <script src="/js/validaciones/validacion_nombre.js"></script>
        <script src="/js/validaciones/validacion_no_nulo.js"></script>
        <script src="/js/usuario/edit.js"></script>
    @endsection