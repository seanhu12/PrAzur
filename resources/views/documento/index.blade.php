@extends('layouts.app')

@section('titulo', 'Documentos')
@section('contenido')

    <div class="card col-lg-12 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Documentos</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                <a href="/documento/create"  class="btn btn-cyan" title="Crear Nuevo Documento"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        <div id="data-tag-tipo" data-data='{{$tiposJson}}'></div>
                        <label class="form-label">Tipo Documento</label>
                        <div class="input-group">
                            <select id="select-beast-tipo" type="text" tabindex="-1" placeholder="Seleccione un tipo..." class="form-control"></select>
                            <span class="input-group-append">
                                <button class="btn btn-primary" onclick="removerFiltroTipo();" type="button"><i class="fas fa-times"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <table id="tabla" class="table table-striped table-bordered text-center">
                        <thead>
                        <tr>
                            <th data-dynatable-sorts="id">Código</th>
                            <th style="display: none">Id</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Temática</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                        @foreach ($documentos as $key=>$documento)
                            <tr>
                                <td>{{$documento->codigo}}</td>
                                <td>{{$documento->id}}</td>
                                <td>{{$documento->nombre}}</td>
                                <td>{{$tipos[$key]->nombre}}</td>
                                <td>{{$tematicas[$key]->nombre}}</td>
                                <td>
                                    <div class="col-md-12 text-center">
                                        <a href="/documento/show/{{$documento->id}}" class="btn btn-teal btn-sm" title="Detalles"><i class="fas fa-info"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
        <script src="/components/dynatable/jquery.dynatable.js"></script>
        <script src="/js/documento/documento.js"></script>
@endsection

@section('styles')
        <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/dynatable.css">
@endsection