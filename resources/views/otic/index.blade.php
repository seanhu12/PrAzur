@extends('layouts.app')

@section('titulo', 'OTICs')
@section('contenido')

    <div class="card col-lg-12 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">OTICs</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                <a href="/otic/create" class="btn btn-cyan" title="Crear Nueva OTIC"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            <table id="tabla" class="table table-striped table-bordered text-center">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>RUT</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono Fijo</th>
                    <th>Teléfono Móvil</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                @foreach ($otics as $otic)
                    <tr>
                        <td>{{$otic->nombre}}</td>
                        <td>{{$otic->rut}}</td>
                        <td>{{$otic->mail}}</td>
                        @if ($otic->telefono_fijo != null)
                            <td>{{$otic->telefono_fijo}}</td>
                        @else
                            <td>No tiene</td>
                        @endif
                        @if ($otic->celular != null)
                            <td>{{$otic->celular}}</td>
                        @else
                            <td>No tiene</td>
                        @endif
                        <td>
                            <div class="col-md-12 text-center">
                                <a href="/otic/show/{{$otic->id}}" class="btn  btn-teal btn-sm" title="Detalles"><i class="fas fa-info"></i></a>
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
    <script src="/js/otic/otic.js"></script>
@endsection

@section('styles')
    <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/dynatable.css">
@endsection