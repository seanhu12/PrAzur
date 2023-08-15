@extends('layouts.app')

@section('titulo', 'Información Empresa')
@section('contenido')

    <div class="card col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Información Empresa</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                @if(Auth::user()->has_rol('Gestor de Ventas'))
                    <a href="/metas_venta/{{$empresa->id}}" class="btn  btn-cyan" title="Ver Metas Venta" style="width: 45px"><i class="fas fa-donate"></i></a>
                @endif
                @if(Auth::user()->has_rol('Gestor de Empresas'))
                    <a href="/empresa/edit/{{$empresa->id}}" class="btn  btn-blue" title="Editar" style="width: 45px"><i class="fas fa-edit"></i></a>
                    <button id="button_deshabilitar" class="btn  btn-indigo" onclick="deshabilitarEmpresa({{$empresa->id}});" title="Eliminar" style="width: 45px"><i class="fas fa-trash-alt"></i></button>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Nombre</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$empresa->nombre}}</div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">RUT</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$empresa->rut}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Dirección</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$empresa->direccion}}</div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Correo Electrónico</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$empresa->mail}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Ciudad</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$ciudad->nombre}}</div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Teléfono Fijo</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$empresa->telefono_fijo}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Holding</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$empresa->nombre_holding}}</div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Teléfono Móvil</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$empresa->celular}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row card-footer">
            <a href="/empresa" class="btn btn-secondary" role="button">Volver</a>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/empresa/destroy.js"></script>
@endsection

@section('styles')
    <link href="/css/label_show.css" rel="stylesheet">
@endsection
