@extends('layouts.app')

@section('titulo', 'Estructuras')
@section('contenido')

    <div class="card col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Estructuras</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                <a href="/estructura/create_estructura/{{$curso->id}}" class="btn btn-cyan" title="Crear Nueva Estructura"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            <table id="tabla" class="table table-striped table-bordered text-center">
                <thead>
                <tr>
                    <th data-dynatable-sorts="id">Código</th>
                    <th style="display: none">Id</th>
                    <th>Nombre</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                @foreach ($estructuras as $key=>$estructura)
                    <tr>
                        <td>{{$estructura->codigo}}</td>
                        <td>{{$estructura->id}}</td>
                        <td>{{$estructura->nombre}}</td>
                        <td>
                            <div class="col-md-12 text-center">
                                <a href="/estructura/download/{{$estructura->id}}" class="btn btn-cyan btn-sm" title="Descargar Estructura"><i class="fas fa-file-download"></i></a>
                                <a href="/estructura/edit_estructura/{{$estructura->id}}" class="btn btn-blue btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                <button id="button_deshabilitar" class="btn btn-indigo btn-sm" onclick="deshabilitarEstructura({{$estructura->id}});" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
        <script src="/components/dynatable/jquery.dynatable.js"></script>
        <script src="/js/estructura/estructura.js"></script>
        <script src="/js/estructura/destroy.js"></script>
@endsection

@section('styles')
        <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/dynatable.css">
@endsection