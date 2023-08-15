@extends('layouts.app')

@section('titulo', 'Información Contacto Empresa')
@section('contenido')

    <div class="card col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Información del Contacto de Empresa</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                @if(Auth::user()->has_rol('Gestor de Empresas'))
                    <a href="/contacto_empresa/edit/{{$contactoEmpresa->id}}" class="btn  btn-blue" title="Editar"><i class="fas fa-edit"></i></a>
                    <button id="button_deshabilitar" class="btn  btn-indigo" onclick="deshabilitarContactoEmpresa({{$contactoEmpresa->id}});" title="Editar"><i class="fas fa-trash-alt"></i></button>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Empresa</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$empresa->nombre}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Nombre</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$contactoEmpresa->nombre}}</div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Apellido</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$contactoEmpresa->apellido}}</div>
                    </div>
                </div>
                {{--<div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">RUT</label>
                        <label>{{$contactoEmpresa->rut}}</label>
                    </div>
                </div>--}}
            </div>
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Área de la Empresa</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$contactoEmpresa->area}}</div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Correo Electrónico</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$contactoEmpresa->mail}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Cargo en la Empresa</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$contactoEmpresa->cargo}}</div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Teléfono Fijo</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$contactoEmpresa->telefono_fijo}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Dirección</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$contactoEmpresa->direccion}}</div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Teléfono Móvil</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$contactoEmpresa->celular}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row card-footer">
            @if(Auth::user()->has_rol('Gestor de Empresas'))
                <a href="/contacto_empresa" class="btn btn-secondary" role="button">Volver</a>
            @else
                <a href="javascript:history.back()" class="btn btn-secondary" role="button">Volver</a>
            @endif
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/contacto_empresa/destroy.js"></script>
@endsection

@section('styles')
    <link href="/css/label_show.css" rel="stylesheet">
@endsection