@extends('layouts.app')

@section('titulo', 'Información OTIC')
@section('contenido')

    <div class="card col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Información OTIC</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                <a href="/otic/edit/{{$otic->id}}" class="btn  btn-blue" title="Editar" style="width: 45px"><i class="fas fa-edit"></i></a>
                <button id="button_deshabilitar" class="btn  btn-indigo" onclick="deshabilitarOtic({{$otic->id}});" title="Eliminar" style="width: 45px"><i class="fas fa-trash-alt"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Nombre</label>
                        <hr style="margin-top: 0; margin-bottom: 0;">
                        <div class="form-control-plaintext">{{$otic->nombre}}</div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">RUT</label>
                        <hr style="margin-top: 0; margin-bottom: 0;">
                        <div class="form-control-plaintext">{{$otic->rut}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Correo Electrónico</label>
                        <hr style="margin-top: 0; margin-bottom: 0;">
                        <div class="form-control-plaintext">{{$otic->mail}}</div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Teléfono Fijo</label>
                        <hr style="margin-top: 0; margin-bottom: 0;">
                        <div class="form-control-plaintext">{{$otic->telefono_fijo}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Dirección</label>
                        <hr style="margin-top: 0; margin-bottom: 0;">
                        <div class="form-control-plaintext">{{$otic->direccion}}</div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Teléfono Móvil</label>
                        <hr style="margin-top: 0; margin-bottom: 0;">
                        <div class="form-control-plaintext">{{$otic->celular}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row card-footer">
            <a href="/otic" class="btn btn-secondary" role="button">Volver</a>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/otic/destroy.js"></script>
@endsection

@section('styles')
    <link href="/css/label_show.css" rel="stylesheet">
@endsection
