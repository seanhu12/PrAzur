@extends('layouts.app')

@section('titulo', 'Información Documento')
@section('contenido')

    <div class="card col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Información Documento</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                <a href="/documento/edit/{{$documento->id}}" class="btn btn-blue" title="Editar" style="width: 45px"><i class="fas fa-edit"></i></a>
                <button id="button_deshabilitar" class="btn btn-indigo" onclick="deshabilitarDocumento({{$documento->id}});" title="Eliminar" style="width: 45px"><i class="fas fa-trash-alt"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Código</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$documento->codigo}}</div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Nombre</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$documento->nombre}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Tipo</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$tipo->nombre}}</div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Temática</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control-plaintext">{{$tematica->nombre}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="form-label">Archivo</label>
                    <hr style="margin-top: 0px; margin-bottom: 0px">
                    <div class="row">
                        <div class="col-md-8">
                            <label>{{$documento->file_name}}</label>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="/documento/download/{{$documento->id}}" class="btn btn-cyan btn-sm" title="Descargar Archivo"><i class="fas fa-file-download"> </i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row card-footer">
            <a href="/documento" class="btn btn-secondary" role="button">Volver</a>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/documento/destroy.js"></script>
@endsection

@section('styles')
    <link href="/css/label_show.css" rel="stylesheet">
@endsection