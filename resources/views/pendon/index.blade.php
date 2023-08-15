@extends('layouts.app')

@section('titulo', 'Pendones')
    @section('contenido')

        <div class="card col-lg-12 col-md-12 mx-auto">
            <div class="card-header">
                <div class="col-md-6 col-sm-12">
                    <h3 class="card-title">Pendones</h3>
                </div>
                <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                    <a href="/pendon/create" class="btn btn-cyan" title="Crear Nuevo Pendón"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <div id="data-tag-tematica" data-data='{{$tematicasJson}}'></div>
                            <label class="form-label">Temática</label>
                            <div class="input-group">
                                <select id="select-beast-tematica" type="text" tabindex="-1" placeholder="Seleccione una temática..." class="form-control"></select>
                                <span class="input-group-append">
                                    <button class="btn btn-primary" onclick="removerFiltroTematica();" type="button"><i class="fas fa-times"></i></button>
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
                                    <th>Temáticas</th>
                                    <th>Opciones</th>
                            </thead>
                            <tbody>
                                @foreach ($pendones as $pendon)
                                    <tr>
                                        <td>{{$pendon->codigo}}</td>
                                        <td>{{$pendon->id}}</td>
                                        <td>{{$pendon->nombre}}</td>
                                        <td>
                                            @foreach($pendon->tematicas() as $tematica)
                                                |{{$tematica->nombre}}|
                                            @endforeach
                                        </td>
                                        <td>
                                        <div class="col-md-12 text-center">
                                            <a href="/pendon/show/{{$pendon->id}}" class="btn  btn-teal btn-sm" title="Detalles"><i class="fas fa-info"></i></a>
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
    <script src="/js/pendon/pendon.js"></script>
@endsection

@section('styles')
    <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/dynatable.css">
@endsection