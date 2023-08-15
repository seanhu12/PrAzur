@extends('layouts.login-layout')

@section('contenido')
    <div class="row">
        <div class="col col-login mx-auto">
            <div class="text-center mb-6">
                <img src="/imagenes/logo.png" alt="ADS Consultores" height="100" width="100">
            </div>

            <form class="card" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                <div class="card-body p-6">

                <div class="card-title">Ingresar al sistema</div>

                @if ($errors->has('rut'))
                    <div id="nombre-alert" class="help-block alert alert-danger">{{ $errors->first('rut') }}</div>
                    {{-- <span class="help-block alert alert-danger">
                        <strong>{{ $errors->first('rut') }}</strong>
                    </span> --}}
                @endif

                <div class="form-group{{ $errors->has('rut') ? ' has-error' : '' }}">
                    <label class="form-label" for="rut">ID Usuario</label>
                    <input id="rut" onblur="validarRut(document.getElementById('rut').value);"  type="text" class="form-control" name="rut" value="{{ old('rut') }}" placeholder="Ingresar ID Usuario" required autofocus>
                    <div id="rut-alert" class="invalid-feedback">La credencial ingresada no es válida.</div>

                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="form-label">
                    Contraseña
                    </label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
                </div>

                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
                    <span class="custom-control-label">Recordarme</span>
                    </label>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/validaciones/validacion_rut.js"></script>
@endsection