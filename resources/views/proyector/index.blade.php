@extends('layouts.app')

@section('titulo', 'Proyectores')
@section('contenido')

    <div class="card col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Proyectores</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                <a href="/proyector/create" class="btn btn-cyan" title="Crear Nuevo Proyector"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            <table id="tabla" class="table table-striped table-bordered text-center">
                <thead>
                <tr>
                    <th data-dynatable-sorts="id">Código</th>
                    <th style="display: none">Id</th>
                    <th data-dynatable-sorts="fechaSort">Fecha de Adquisición</th>
                    <th style="display: none">Fecha Sort</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                @foreach ($proyectors as $proyector)
                    <tr>
                        <td>{{$proyector->codigo}}</td>
                        <td>{{$proyector->id}}</td>
                        <td>{{date("d-m-Y", strtotime($proyector->fecha_adquisicion))}}</td>
                        <td>{{$proyector->fecha_adquisicion}}</td>
                        <td>
                            <div class="col-md-12 text-center">
                                <a class="btn  btn-cyan btn-sm" href="/proyector/download/{{$proyector->id}}" title="Descargar Foto"><i class="fas fa-file-download"></i></a>
                                <a href="/proyector/edit/{{$proyector->id}}" class="btn btn-blue btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                <button onclick="deshabilitarProyector({{$proyector->id}});" class="btn btn-indigo btn-sm" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
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
    <script src="/js/proyector/proyector.js"></script>
    <script src="/js/proyector/destroy.js"></script>
@endsection

@section('styles')
    <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/dynatable.css">
@endsection