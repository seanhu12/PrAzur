@extends('layouts.app')

@section('titulo', 'Información Relator')
@section('contenido')

    <div class="card col-lg-8 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Información Relator</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                @if(Auth::user()->has_rol('Gestor de Recursos'))
                    <a href="/relator/edit/{{$relator->id}}" class="btn btn-blue" title="Editar" style="width: 45px"><i class="fas fa-edit"></i></a>
                    <button id="button_deshabilitar" class="btn btn-indigo" onclick="deshabilitarRelator({{$relator->id}});" title="Eliminar" style="width: 45px"><i class="fas fa-trash-alt"></i></button>
                @endif

            </div>
        </div>
        <div class="card-body">
            <ul class="list-group card-list-group">
                <li class="list-group-item py-5">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Nombre</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext">{{$relator->nombre}}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Apellido</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext">{{$relator->apellido}}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">RUT</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext">{{$relator->rut}}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Correo Electrónico</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext">{{$relator->mail}}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Ciudad</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                @if ($ciudad != null)
                                    <div class="form-control-plaintext">{{$ciudad->nombre}}</div>
                                @else
                                    <div class="form-control-plaintext"></div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Teléfono Móvil</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext">{{$relator->celular}}</div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item py-5">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Fecha Vencimiento Vigencia SENCE</label>
                                <hr style="margin-top: 0px; margin-bottom: 0px">
                                <div class="form-control-plaintext">{{date("d-m-Y", strtotime($relator->vigencia_sence))}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Certificaciones del Relator</label>
                            <hr style="margin-top: 0px; margin-bottom: 0px">
                            @foreach ($relator->documentos_relator() as $file)
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-control-plaintext">{{$file->file_name}}</div>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <a class="btn btn-cyan btn-sm" href="/relator/descargar_archivo/{{$file->hash_file_name}}/{{$file->file_name}}" title="Descargar"><i class="fas fa-file-download"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="row card-footer">
            @if(Auth::user()->has_rol('Gestor de Recursos'))
                <a href="/relator" class="btn btn-secondary" role="button">Volver</a>
            @else
                <a href="javascript:history.back()" class="btn btn-secondary" role="button">Volver</a>
            @endif

        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/relator/destroy.js"></script>
@endsection

@section('styles')
    <link href="/css/label_show.css" rel="stylesheet">
@endsection
