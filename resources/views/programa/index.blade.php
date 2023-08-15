@extends('layouts.app')

@section('titulo', 'Programas')
    @section('contenido')

        <div class="card col-lg-8 col-md-12 mx-auto">
            <div class="card-header">
                <div class="col-md-6 col-sm-12">
                    <h3 class="card-title">Programas</h3>
                </div>
                <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                    @if(Auth::user()->has_rol('Gestor de Cursos'))
                        <a href="/programa/create" class="btn btn-cyan" title="Crear Nuevo Programa"><i class="fa fa-plus"></i></a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <table id="tabla" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Opciones</th>
                    </thead>
                    <tbody>
                        @foreach ($programas as $programa)
                        <tr>
                            <td>{{$programa->nombre}}</td>
                            <td>
                            <div class="col-md-12 text-center">
                                <a href="/programa/show/{{$programa->id}}" class="btn  btn-teal btn-sm" title="Detalles"><i class="fas fa-info"></i></a>
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
    <script src="/js/programa/programa.js"></script>
@endsection

@section('styles')
    <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/dynatable.css">
@endsection