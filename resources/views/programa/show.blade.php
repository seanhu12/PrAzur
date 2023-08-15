@extends('layouts.app')

@section('titulo', 'Información Programa')
    @section('contenido')

        <div class="card col-lg-6 col-md-12 mx-auto">
            <div class="card-header">
                <div class="col-md-6 col-sm-12">
                    <h3 class="card-title">Información Programa</h3>
                </div>
                <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                    @if(Auth::user()->has_rol('Gestor de Cursos'))
                        <a href="/programa/edit/{{$programa->id}}" class="btn btn-blue" title="Editar" style="width: 45px"><i class="fas fa-edit"></i></a>
                        {{-- <button id="button_deshabilitar" class="btn  btn-indigo" onclick="deshabilitarPrograma({{$programa->id}});" title="Eliminar" style="width: 45px"><i class="fas fa-trash-alt"></i></button> --}}
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Nombre</label>
                            <hr style="margin-top: 0px; margin-bottom: 0px">
                            <div class="form-control-plaintext">{{$programa->nombre}}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="form-label">Cursos</label>
                                        <hr style="margin-top: 0px; margin-bottom: .375rem">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cursosPrograma as $rol)
                                <tr>
                                    <td>- {{$rol->nombre_venta}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row card-footer">
                @if(Auth::user()->has_rol('Gestor de Cursos'))
                    <a href="/programa" class="btn btn-secondary" role="button">Volver</a>
                @else
                    <a href="javascript:history.back()" class="btn btn-secondary" role="button">Volver</a>
                @endif

            </div>
        </div>

    @endsection

    @section('scripts')
        <script src="/js/programa/destroy.js"></script>
    @endsection

    @section('styles')
        <link href="/css/label_show.css" rel="stylesheet">
    @endsection
