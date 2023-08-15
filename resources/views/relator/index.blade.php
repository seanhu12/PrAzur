@extends('layouts.app')

@section('titulo', 'Relatores')
@section('contenido')

    <div class="card col-lg-12 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Relatores</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                <a href="/relator/create" class="btn btn-cyan" title="Crear Nuevo Relator"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            <table id="tabla" class="table table-striped table-bordered text-center">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>RUT</th>
                    {{-- <th>Correo Electrónico</th>
                    <th>Teléfono Móvil</th> --}}
                    <th>Opciones</th>
                </thead>
                <tbody>
                @foreach ($relatores as $relator)
                    <tr>
                        <td>{{$relator->nombre}}</td>
                        <td>{{$relator->apellido}}</td>
                        <td>{{$relator->rut}}</td>
                        {{-- <td>{{$relator->mail}}</td>
                        <td>{{$relator->celular}}</td> --}}
                        <td>
                            <div class="col-md-12 text-center">
                                <a href="/relator/show/{{$relator->id}}" class="btn btn-teal btn-sm" title="Detalles"><i class="fas fa-info"></i></a>
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
    <script src="/js/relator/relator.js"></script>
@endsection

@section('styles')
    <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/dynatable.css">
@endsection