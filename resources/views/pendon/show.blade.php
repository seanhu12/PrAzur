@extends('layouts.app')

@section('titulo', 'Información Pendón')
    @section('contenido')

        <div class="card col-lg-8 col-md-12 mx-auto">
            <div class="card-header">
                <div class="col-md-6 col-sm-12">
                    <h3 class="card-title">Información Pendón</h3>
                </div>
                <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                    <a href="/pendon/edit/{{$pendon->id}}" class="btn btn-blue" title="Editar" style="width: 45px"><i class="fas fa-edit"></i></a>
                    <button id="button_deshabilitar" class="btn btn-indigo" onclick="deshabilitarPendon({{$pendon->id}});" title="Eliminar" style="width: 45px"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Código</label>
                            <hr style="margin-top: 0px; margin-bottom: 0px">
                            <div class="form-control-plaintext">{{$pendon->codigo}}</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Nombre</label>
                            <hr style="margin-top: 0px; margin-bottom: 0px">
                            <div class="form-control-plaintext">{{$pendon->nombre}}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <table style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label class="form-label">Temáticas</label>
                                                <hr style="margin-top: 0px; margin-bottom: .375rem">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tematicasPendon as $tematica)
                                        <tr>
                                            <td>- {{$tematica->nombre}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Foto</label>
                                        <hr style="margin-top: 0px; margin-bottom: 0px">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-control-plaintext">{{$pendon->file_name}}</div>
                                    </div>
                                    <div class="col-md-2 text-left">
                                        <a class="btn  btn-cyan btn-sm" href="/pendon/download/{{$pendon->id}}" title="Descargar Foto"><i class="fas fa-file-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row card-footer">
                <a href="/pendon" class="btn btn-secondary" role="button">Volver</a>
            </div>
        </div>

    @endsection

    @section('scripts')
        <script src="/js/pendon/destroy.js"></script>
    @endsection

    @section('styles')
        <link href="/css/label_show.css" rel="stylesheet">
    @endsection
