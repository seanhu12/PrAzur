@extends('layouts.app')

@section('titulo', 'Empresas')
@section('contenido')

    <div class="card col-lg-10 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Empresas</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                @if(Auth::user()->has_rol('Gestor de Empresas'))
                    <a href="/empresa/create"  class="btn btn-cyan"title="Crear Nueva Empresa"><i class="fa fa-plus"></i></a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <table id="tabla" class="table table-striped table-bordered text-center">
                <thead>
                <tr>
                    <th >Nombre</th>
                    {{-- <th >Ciudad</th> --}}
                    <th >RUT</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{$empresa->nombre}}</td>
                        {{-- @if ($empresa->get_ciudad() != null)
                            <td>{{$empresa->get_ciudad()->nombre}}</td>
                        @else
                            <td>No tiene</td>
                        @endif --}}
                        <td>{{$empresa->rut}}</td>
                        <td>
                            <div class="col-md-12 text-center">
                                <a href="/empresa/show/{{$empresa->id}}" class="btn  btn-teal btn-sm" title="Detalles"><i class="fas fa-info"></i></a>
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
    <script src="/js/empresa/empresa.js"></script>
@endsection

@section('styles')
    <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/dynatable.css">
@endsection