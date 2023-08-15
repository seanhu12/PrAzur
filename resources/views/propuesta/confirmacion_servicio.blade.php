@extends('layouts.app')

@section('titulo', 'Confirmación de Servicio')
    @section('contenido')

        <div class="card col-lg-12 col-md-12 mx-auto">
            <div class="card-header">
                <h3 class="card-title">Confirmación de Servicio: {{ $propuesta->idp }}</h3>
            </div>
            <div class="card-body">
                <ul class="list-group card-list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tipo de Servicio</label>
                                    <input id="tipo-servicio" type="text" class="form-control" value="{{$propuesta->tipo_servicio()->nombre}}" maxlength="191" autofocus readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Empresa</label>
                                    <input id="empresa" type="text" class="form-control" value="{{$propuesta->empresa()->nombre}}" maxlength="191" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @if ($propuesta->tipo_servicio_id == 1)
                                    <div class="form-group">
                                        <label class="form-label">Programa</label>
                                        <input id="programa" type="text" value="{{$propuesta->programa()->nombre}}" class="form-control" maxlength="191" readonly>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label class="form-label">Curso</label>
                                        <input id="curso" type="text" value="{{$propuesta->curso()->nombre_venta}}" class="form-control" maxlength="191" readonly>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Contacto Venta Empresa</label>
                                    @if ($propuesta->get_contacto(1) != null)
                                        <div class="input-group">
                                            <input id="contacto-empresa" type="text" class="form-control" value="{{$propuesta->get_contacto(1)->nombre}} {{$propuesta->get_contacto(1)->apellido}}" maxlength="191" readonly>
                                            <span class="input-group-append">
                                                <a href="/contacto_empresa/show/{{$propuesta->get_contacto(1)->id}}" class="btn btn-primary"><i class="fas fa-info-circle"></i></a>
                                            </span>
                                        </div>
                                    @else
                                        <input id="contacto-empresa" type="text" class="form-control" maxlength="191" readonly>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Área</label>
                                    <input id="area" type="text" class="form-control" value="{{$propuesta->area()->nombre}}" maxlength="191" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Contacto OTIC</label>
                                    @if ($propuesta->contacto_otic() != null)
                                        <div class="input-group">
                                            <input id="contacto-otic" type="text" class="form-control" value="{{$propuesta->contacto_otic()->nombre}} {{$propuesta->contacto_otic()->apellido}}" maxlength="191" readonly>
                                            <span class="input-group-append">
                                                <a href="/contacto_otic/show/{{$propuesta->contacto_otic_id}}" class="btn btn-primary"><i class="fas fa-info-circle"></i></a>
                                            </span>
                                        </div>
                                    @else
                                        <input id="contacto-otic" type="text" class="form-control" value="" maxlength="191" readonly>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Monto Final</label>
                                    <input id="monto-final" type="text" class="form-control" value="$ 0" readonly>
                                    <div id="monto-final-alert" class="invalid-feedback">El monto puede tener máximo 9 digitos.</div>
                                </div>
                            </div>
                        </div>
                        @if ($propuesta->tipo_servicio_id == 1)
                            <div class="row" hidden="true">
                                <div class="col-md-12">
                                    <div class="custom-controls">
                                        <label class="custom-control custom-checkbox">
                                            <input id="diploma-programa" type="checkbox" class="custom-control-input" value="1">
                                            <span class="custom-control-label">Diploma Programa</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div id="propuesta-id" data-data="{{ $propuesta->id }}"></div>
                        <div id="data-tag-ciudad-id" data-data="{{ $propuesta->empresa()->ciudad_id }}"></div>
                        <div id="data-tag-ciudad" data-data='{{ $ciudadesJson }}'></div>
                        <div id="data-tag-relator" data-data='{{ $relatoresJson }}'></div>
                        @if ($propuesta->tipo_servicio_id == 1)
                            <div id="data-tag-cursos" data-data='{{ $propuesta->programa()->cursos() }}'></div>
                        @endif
                    </li>
                    @if ($propuesta->tipo_servicio_id == 1)
                        @foreach ($propuesta->programa()->cursos() as $curso)
                            <li class="list-group-item sin-linea">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="col-md-8">
                                            <div class="form-control-plaintext">{{$curso->nombre_venta}}</div>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <button onclick="desplegarAgregarServicio({{ $curso }})" class="btn btn-cyan" title="Agregar"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        {{-- <div id="data-curso" value=''></div> --}}
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Nombre</th>
                                                    <th>Fecha</th>
                                                    <th>Monto</th>
                                                    <th>Horario</th>
                                                    <th>Relator</th>
                                                    <th>Ciudad</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="{{$curso->id}}"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li class="list-group-item sin-linea">
                            <div class="card">
                                <div class="card-header">
                                    <div class="col-md-8">
                                        <div class="form-control-plaintext">{{$propuesta->curso()->nombre_venta}}</div>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <button onclick="desplegarAgregarServicio({{ $propuesta->curso() }})" class="btn btn-cyan" title="Agregar"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{-- <div id="data-curso" value=''></div> --}}
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Nombre</th>
                                                <th>Fecha</th>
                                                <th>Monto</th>
                                                <th>Horario</th>
                                                <th>Relator</th>
                                                <th>Ciudad</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="{{$propuesta->curso()->id}}"></tbody>
                                    </table>
                                </div>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
            <div id="error" class="alert alert-danger" role="alert" hidden></div>
            <div class="card-footer row">
                <div class="col-md-6 col-sm-6">
                    <a href="/propuesta" class="btn btn-secondary">Volver</a>
                </div>
                <div class="col-md-6 col-sm-6 text-right">
                    <button type="button" onclick="enviarDatos({{ $propuesta }});" id="button-crear" class="btn btn-primary">Confirmar Servicio</button>
                </div>
            </div>
        </div>

        @include('propuesta.confirmacion_servicio_parts.nuevo_servicio')

    @endsection

    @section('scripts')
        <script src="/js/propuesta/confirmacion_servicio.js"></script>
        <script src="/js/validaciones/validacion_nombre_largo.js"></script>
        <script src="/js/validaciones/validacion_numero.js"></script>
        <script src="/js/validaciones/validacion_fecha_no_pasada.js"></script>
        <script src="/js/validaciones/validacion_horario.js"></script>
        <script src="/js/validaciones/validacion_no_nulo.js"></script>
        <script src="/js/validaciones/validacion_no_cero.js"></script>
        <script src="/js/formato_numeros.js"></script>
    @endsection

    @section('styles')
        <link rel="stylesheet" href="/css/propuesta/confirmacion_servicio.css">
    @endsection