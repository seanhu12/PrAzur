@extends('layouts.app')

@section('titulo', 'Temáticas')
@section('contenido')

    <div class="card col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Temáticas</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                <a href="/tematica/create" class="btn btn-cyan" title="Crear Nueva Temática"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            <table id="tabla" class="table table-striped table-bordered text-center">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tematicas as $tematica)
                    <tr>
                        <td>{{$tematica->nombre}}</td>
                        <td>
                            <div class="col-md-12 text-center">
                                <a href="/tematica/edit/{{$tematica->id}}" class="btn btn-blue btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                <button onclick="deshabilitarTematica({{$tematica->id}});" class="btn btn-indigo btn-sm" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
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
    <script src="/js/tematica/tematica.js"></script>
    <script src="/js/tematica/destroy.js"></script>
@endsection

@section('styles')
    <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/dynatable.css">
@endsection