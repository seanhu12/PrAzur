@extends('layouts.app')

@section('titulo', 'Cursos')
@section('contenido')

    <div class="card col-lg-12 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Cursos</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                @if(Auth::user()->has_rol('Gestor de Cursos'))
                    <a href="/curso/create"  class="btn btn-cyan" title="Crear Nuevo Curso"><i class="fa fa-plus"></i></a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <table id="tabla" class="table table-striped table-bordered text-center">
                <thead>
                <tr>
                    <th data-dynatable-sorts="id">Código</th>
                    <th style="display: none">Id</th>
                    <th>Código SENCE</th>
                    <th>Nombre Venta</th>
                    <th>Temática</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                @foreach ($cursos as $key=>$curso)
                    <tr>
                        <td>{{$curso->codigo}}</td>
                        <td>{{$curso->id}}</td>
                        <td>{{$codigosSence[$key]}}</td>
                        <td>{{$curso->nombre_venta}}</td>
                        <td>{{$tematicas[$key]->nombre}}</td>
                        <td>
                            <div class="col-md-12 text-center">
                                <a href="/curso/show/{{$curso->id}}" class="btn  btn-teal btn-sm" title="Detalles"><i class="fas fa-info"></i></a>
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
        <script src="/js/curso/curso.js"></script>
@endsection

@section('styles')
        <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/dynatable.css">
@endsection