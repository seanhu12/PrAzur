@extends('layouts.app')

@section('titulo', 'Notebooks')
@section('contenido')

    <div class="card col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Notebooks</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                <a href="/notebook/create" class="btn btn-cyan" title="Crear Nuevo Notebook"><i class="fa fa-plus"></i></a>
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
                    <th>Marca</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                @foreach ($notebooks as $notebook)
                    <tr>
                        <td>{{$notebook->codigo}}</td>
                        <td>{{$notebook->id}}</td>
                        <td>{{date("d-m-Y", strtotime($notebook->fecha_adquisicion))}}</td>
                        <td>{{$notebook->fecha_adquisicion}}</td>
                        <td>{{$notebook->marca}}</td>
                        <td>
                            <div class="col-md-12 text-center">
                                <a class="btn btn-cyan btn-sm" href="/notebook/download/{{$notebook->id}}" title="Descargar Foto"><i class="fas fa-file-download"></i></a>
                                <a href="/notebook/edit/{{$notebook->id}}" class="btn btn-blue btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                <button id="button_deshabilitar" class="btn btn-indigo btn-sm" onclick="deshabilitarNotebook({{$notebook->id}});" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
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
    <script src="/js/notebook/destroy.js"></script>
    <script src="/js/notebook/notebook.js"></script>
@endsection

@section('styles')
    <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/dynatable.css">
@endsection