@extends('layouts.app')

@section('titulo', 'Metas Venta')
@section('contenido')

    <div class="card col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Metas de Venta para {{$empresa->nombre}}</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                <a href="/metas_venta/create_meta/{{$empresa->id}}" class="btn btn-cyan" title="Crear Nueva Meta de Venta"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Año</label>
                        <div class="input-group">
                            <input id="buscar-anio" type="text" class="form-control" placeholder="Buscar por Año...">
                            <span class="input-group-append">
                                <button class="btn btn-primary" onclick="removerFiltroAnio();" type="button"><i class="fas fa-times"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <table id="tabla" class="table table-striped table-bordered text-center">
                <thead>
                <tr>
                    <th>Año</th>
                    <th>Mes</th>
                    <th data-dynatable-sorts="montoSort">Monto</th>
                    <th style="display: none">Monto Sort</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                <div id="metas" data-data="{{$metasJson}}"></div>
                @foreach ($metas as $meta)
                    <tr>
                        <td>{{$meta->anio}}</td>
                        <td>{{$meta->get_nombre_mes()}}</td>
                        <td id="monto{{$meta->id}}">{{$meta->monto_meta}}</td>
                        <td>{{$meta->monto_meta}}</td>
                        <td>
                            <div class="col-md-12 text-center">
                                <a href="/metas_venta/edit_meta/{{$meta->id}}" class="btn  btn-blue btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                <button onclick="deshabilitarMetaVenta({{$meta->id}},'{{$empresa->id}}');" class="btn btn-indigo btn-sm" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
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
    <script src="/js/formato_numeros.js"></script>
    <script src="/js/empresa/metas_venta/metas_venta.js"></script>
    <script src="/js/empresa/metas_venta/destroy.js"></script>
@endsection

@section('styles')
    <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/dynatable.css">
@endsection