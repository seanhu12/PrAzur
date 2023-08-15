@extends('layouts.app')

@section('titulo', 'Contactos OTICs')
@section('contenido')

    <div class="card col-lg-12 col-md-12 mx-auto">
        <div class="card-header">
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title">Contactos de OTICs</h3>
            </div>
            <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                <a href="/contacto_otic/create"  class="btn btn-cyan" title="Crear Nuevo Contacto OTIC"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        <div id="data-tag-otic" data-data='{{$oticsJson}}'></div>
                        <label class="form-label">OTIC</label>
                        <div class="input-group">
                            <select id="select-beast-otic" type="text" tabindex="-1" placeholder="Seleccione una OTIC..." class="form-control"></select>
                            <span class="input-group-append">
                                <button class="btn btn-primary" onclick="removerFiltroOtic();" type="button"><i class="fas fa-times"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <table id="tabla" class="table table-striped table-bordered text-center">
                        <thead>
                        <tr>
                            <th>OTIC</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            {{-- <th>RUT</th>--}}
                            <th>Correo Electrónico</th>
                            <th>Teléfono Móvil</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                        @foreach ($contactosOtic as $key=>$contactoOtic)
                            <tr>
                                <td>{{$otics[$key]->nombre}}</td>
                                <td>{{$contactoOtic->nombre}}</td>
                                <td>{{$contactoOtic->apellido}}</td>
                                {{-- <td>{{$contactoOtic->rut}}</td>--}}
                                <td>{{$contactoOtic->mail}}</td>
                                @if ($contactoOtic->celular != null)
                                    <td>{{$contactoOtic->celular}}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>
                                    <div class="col-md-12 text-center">
                                        <a href="/contacto_otic/show/{{$contactoOtic->id}}" class="btn btn-teal btn-sm" title="Detalles"><i class="fas fa-info"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

@endsection
@section('scripts')
            <script src="/components/dynatable/jquery.dynatable.js"></script>
            <script src="/js/contacto_otic/contacto_otic.js"></script>
@endsection

@section('styles')
            <link href="/components/dynatable/jquery.dynatable.css" rel="stylesheet" />
            <link rel="stylesheet" href="/css/dynatable.css">
@endsection