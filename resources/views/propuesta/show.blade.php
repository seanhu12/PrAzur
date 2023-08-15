@extends('layouts.app')

@section('titulo', 'Detalles Propuesta')
    @section('contenido')

        <div class="card col-lg-10 col-md-12 mx-auto">
            <div class="card-header">
                <div class="col-md-6 col-sm-12">
                    <h3 class="card-title">Propuesta: {{$propuesta->idp}}</h3>
                </div>
                <div class="col-md-6 col-sm-12 card-title text-right" style="color: white">
                    @if ($propuesta->get_last_estado()->nombre == 'No Enviada' || $propuesta->get_last_estado()->nombre == 'Enviada' || $propuesta->get_last_estado()->nombre == 'Aceptada')
                        <a href="/propuesta/edit/{{$propuesta->id}}" class="btn btn-blue" title="Editar" style="width: 45px"><i class="fas fa-edit"></i></a>
                    @endif
                    @if ($propuesta->get_last_estado()->nombre == 'No Enviada')
                        <button id="btn-eliminar" class="btn btn-indigo" onclick="eliminarPropuesta({{$propuesta->id}});" title="Eliminar" style="width: 45px"><i class="fas fa-trash-alt"></i></button>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group card-list-group">
                    <li class="list-group-item py-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Área</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{$propuesta->area()->nombre}}</div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="form-label">Empresa</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{$propuesta->empresa()->nombre}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Fecha de Creación</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{date("d-m-Y", strtotime($propuesta->fecha_propuesta))}}</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Fecha Compromiso</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{date("d-m-Y", strtotime($propuesta->fecha_compromiso))}}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Estado</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{$propuesta->get_last_estado()->nombre}}, el {{date("d-m-Y", strtotime($propuesta->get_last_estado_propuesta()->created_at))}}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                @if ($propuesta->get_last_estado()->id == 5)
                                    <label class="form-label">Motivo Rechazo</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{$motivo->nombre}}</div>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item py-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Monto</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div id="monto" class="form-control-plaintext">{{$propuesta->monto}}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Valor Hora</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div id="uf-hora" class="form-control-plaintext">{{$propuesta->uf_hora}}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Cantidad Total Horas</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div id="cant-total-horas" class="form-control-plaintext">{{$propuesta->cant_total_horas}}</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item py-5">
                        <div class="row">
                            @if ($propuesta->tipo_servicio_id == 1)
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div id="programa_nombre" data-data='{{$propuesta->Programa()->nombre}}'></div>
                                        <div id="programa_id" data-data='{{$propuesta->programa_id}}'></div>
                                        <label class="form-label">Programa</label>
                                        <hr style="margin-top: 0px; margin-bottom: 0px">
                                        <div id="programa" class="form-control-plaintext">{{$propuesta->Programa()->nombre}}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-right">
                                        <button id="btn-cursos-programa" class="btn btn-cyan" onclick="desplegarCursosPrograma();" style="visibility:visible">Cursos del programa</button>
                                    </div>
                                </div>
                            @endif
                            @if ($propuesta->tipo_servicio_id == 2)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Curso</label>
                                        <hr style="margin-top: 0px; margin-bottom: 0px">
                                        <div class="form-control-plaintext">{{$propuesta->Curso()->nombre_venta}}</div>
                                    </div>
                                </div>
                            @endif
                            @if ($propuesta->tipo_servicio_id == 0)
                                <div class="col-md-12">
                                    <label class="form-label">Programa</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="list-group-item py-5">
                        <div class="row">
                            @foreach ($propuesta->get_contactos() as $contacto)
                                <div class="col-md-6 form-group">
                                    {{-- <label class="form-label">Contacto Venta</label> --}}
                                    <label class="form-label">Contacto {{$contacto->tipo_contacto()->nombre}}</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{$contacto->contacto_empresa()->nombre}}</div>
                                </div>
                            @endforeach
                        </div>
                        @if ($propuesta->contacto_otic() != null)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Contacto OTIC</label>
                                        <hr style="margin-top: 0px; margin-bottom: 0px">
                                        <div class="form-control-plaintext">{{$propuesta->contacto_otic()->nombre}}</div>
                                    </div>
                                </div>
                        </div>
                        @else
                            <label class="form-label">Contacto OTIC</label>
                        @endif
                    </li>
                    <li class="list-group-item py-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Urgencia</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    @if ($propuesta->urgencia() != null)
                                        <div class="form-control-plaintext">{{$propuesta->urgencia()->nombre}}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Complejidad del Grupo</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    @if ($propuesta->complejidad_grupo() != null)
                                        <div class="form-control-plaintext">{{$propuesta->complejidad_grupo()->nombre}}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Experiencia con ADS</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    @if ($propuesta->experiencia_ads == 1)
                                        <div class="form-control-plaintext">Si, {{$propuesta->experiencia_en}}</div>
                                    @else
                                        @if ($propuesta->experiencia_ads == 0)
                                            @if ($propuesta->experiencia_ads !== null)
                                                <div class="form-control-plaintext">No</div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Experiencia con la Temática</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    @if ($propuesta->experiencia_tematica == 1)
                                        <div class="form-control-plaintext">Si</div>
                                    @else
                                        @if ($propuesta->experiencia_tematica == 0)
                                            @if ($propuesta->experiencia_tematica !== null)
                                                <div class="form-control-plaintext">No</div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <table style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="form-label">Perfil Participante</label>
                                                    <hr style="margin-top: 0px; margin-bottom: .375rem">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($propuesta->participante_perfil() as $perfil)
                                            <tr>
                                                <td>- {{$perfil->nombre}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <table style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="form-label">Foco Intervención</label>
                                                    <hr style="margin-top: 0px; margin-bottom: .375rem">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($propuesta->foco_intervencion() as $foco)
                                            <tr>
                                                <td>- {{$foco->nombre}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item py-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Observaciones</label>
                                    <hr style="margin-top: 0px; margin-bottom: 0px">
                                    <div class="form-control-plaintext">{{$propuesta->observaciones}}</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item py-5">
                        <label class="form-label">Archivos de la Propuesta</label>
                        <hr style="margin-top: 0px; margin-bottom: 0px">
                        @foreach ($propuesta->documentos_propuesta() as $file)
                            <div class="row">
                                <div class="col-md-8">
                                    <label>{{$file->file_name}}</label>
                                </div>
                                <div class="col-md-4 text-right">
                                    <a class="btn btn-primary btn-lime btn-sm" href="descargar_archivo/{{$file->hash_file_name}}/{{$file->file_name}}" title="Descargar"><i class="fas fa-file-download"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </li>
                </ul>
            </div>
            <div class="card-footer row">
                <div class="col-md-6 col-sm-6">
                    <a href="/propuesta" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>



        <div class="modal fade" id="modal-cursos-programa" tabindex="-1" role="dialog" aria-labelledby="cursos-programa-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cursos-programa-label"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="cursos-programa"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>



    @endsection

    @section('scripts')
        <script src="/js/formato_numeros.js"></script>
        <script src="/js/propuesta/show.js"></script>
        <script src="/js/propuesta/destroy.js"></script>
    @endsection

    @section('styles')
        <link href="/css/label_show.css" rel="stylesheet">
    @endsection