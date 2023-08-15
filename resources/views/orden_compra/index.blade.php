@extends('layouts.app')

@section('titulo', 'Ordenes de Compra')
@section('contenido')

    <div class="card col-lg-10 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Ordenes de Compra del Servicio {{$servicio->ot}}</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                @if ($servicio->get_last_etapa()->id != 6 && $servicio->get_last_estado_operacional()->id != 5)
                    <a href="/orden_compra/create/{{$servicio->id}}" class="btn btn-cyan" title="Crear Nueva Orden de Compra"><i class="fa fa-plus"></i></a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        <div id="data-tag-empresa" data-data='{{$empresasJson}}'></div>
                        <label for="select-beast-empresas" class="form-label">Empresa</label>
                        <div class="input-group">
                            <select id="select-beast-empresas" type="text"  tabindex="-1" placeholder="Seleccione una Empresa..." class="form-control" ></select>
                            <span class="input-group-append">
                                <button class="btn btn-primary" onclick="removerFiltroEmpresa();" type="button"><i class="fas fa-times"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <table id="tabla" class="table table-striped table-bordered text-center">
                <thead>
                <tr>
                    <th>Número</th>
                    <th>Empresa</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($ordenesCompra as $ordenCompra)
                    <tr>
                        <td>{{$ordenCompra->numero}}</td>
                        <td>{{$ordenCompra->nombre_empresa}}</td>
                        <td>
                            <div class="col-md-12 text-center">
                                @if ($servicio->get_last_etapa()->id != 6 && $servicio->get_last_estado_operacional()->id != 5)
                                    <a href="/orden_compra/edit/{{$ordenCompra->id}}" class="btn btn-blue btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                    <button onclick="deshabilitarOrdenCompra({{$ordenCompra->id}});" class="btn btn-indigo btn-sm" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer row">
            <div class="col-md-6 col-sm-12">
                <a href="/servicio/checklist/{{$servicio->id}}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="/components/dynatable/jquery.dynatable.js"></script>
    <script src="/js/orden_compra/orden_compra.js"></script>
    <script src="/js/orden_compra/destroy.js"></script>
@endsection

@section('styles')
    <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/dynatable.css">
@endsection