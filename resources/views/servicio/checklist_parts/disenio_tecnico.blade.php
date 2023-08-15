<div class="row">
    <div class="col-md-8">
        <div id="data-tag-disenio-tecnico" data-data='{{ $servicio->diseno_tecnico()}}'></div>
        <table class="table">
            <tbody>
                <tr>
                    <td width="65" style="vertical-align: middle" class="text-left">
                        <label class="custom-switch">
                            <input id="aplica-relator" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="160" style="vertical-align: middle">
                        <div id="text-relator">Relator</div>
                    </td>
                    <td style="vertical-align: middle">
                        @if ($servicio->relator() != '')
                            <input class="form-control" type="text" value="{{$servicio->relator()->nombre . ' ' . $servicio->relator()->apellido}}" readonly>
                        @else
                            <input class="form-control" type="text" readonly>
                        @endif
                    </td>
                    @if ($servicio->relator_id != null)
                        <td>
                            <a href="/relator/show/{{$servicio->relator_id}}" class="btn btn-teal" title="Detalles" style="width: 100%" ><i class="fas fa-info-circle"></i></a>
                        </td>
                    @endif
                </tr>
                <tr>
                    <td style="vertical-align: middle" class="text-left">
                        <label class="custom-switch">
                            <input id="aplica-estructura" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="text-estructura">Estructura Curso</div>
                    </td>
                    <td style="vertical-align: middle">
                        @if ($servicio->diseno_tecnico()->estructura() != '')
                            <input class="form-control" type="text" value="{{$servicio->diseno_tecnico()->estructura()->codigo . ' - ' . $servicio->diseno_tecnico()->estructura()->nombre}}" readonly>
                        @else
                            <input class="form-control" type="text" readonly>
                        @endif
                    </td>
                    @if ($servicio->diseno_tecnico()->estructura() != '')
                        <td width="65">
                            <a id="btn-descargar-estructura" class="btn btn-teal" href="/servicio/descargar_estructura/{{$servicio->diseno_tecnico()->estructura()->id}}" title="Descargar" style="width: 100%"><i class="fas fa-file-download"></i></a>
                        </td>
                    @endif
                </tr>
                <tr>
                    <td style="vertical-align: middle" class="text-left">
                        <label class="custom-switch">
                            <input id="aplica-manual" type="checkbox" class="custom-switch-input" value="1" disabled>
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="text-manual">Manuales</div>
                    </td>
                    <td style="vertical-align: middle">
                        <input class="form-control" type="text" value="{{implode(', ',$servicio->get_documentos_tipo_codigo(1))}}" readonly>
                    </td>
                    @if (count($servicio->get_documentos_tipo_id(1)) > 0)
                        <td>
                            <button id="btn-archivos-manual" class="btn btn-primary btn-teal" onclick="mostrarArchivos({{$servicio->get_documentos_tipo(1)}},'Manuales')" title="Archivos" style="width: 100%"><i class="fas fa-folder"></i></button>
                        </td>
                    @else
                        <td width="65">
                            <button id="btn-archivos-manual" class="btn btn-primary btn-teal" title="Archivos" style="width: 100%" disabled><i class="fas fa-folder"></i></button>
                        </td>
                    @endif
                </tr>
                <tr>
                    <td style="vertical-align: middle" class="text-left">
                        <label class="custom-switch">
                            <input id="aplica-prueba" type="checkbox" class="custom-switch-input" value="1" disabled>
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="text-prueba">Pruebas</div>
                    </td>
                    <td style="vertical-align: middle">
                        <input class="form-control" type="text" value="{{implode(', ',$servicio->get_documentos_tipo_codigo(3))}}" readonly>
                    </td>
                    @if (count($servicio->get_documentos_tipo_id(3)) > 0)
                        <td>
                            <button id="btn-archivos-prueba" class="btn btn-primary btn-teal" onclick="mostrarArchivos({{$servicio->get_documentos_tipo(3)}},'Pruebas')" title="Archivos" style="width: 100%"><i class="fas fa-folder"></i></button>
                        </td>
                    @else
                        <td width="65">
                            <button id="btn-archivos-prueba" class="btn btn-primary btn-teal" title="Archivos" style="width: 100%" disabled><i class="fas fa-folder"></i></button>
                        </td>
                    @endif
                </tr>
                <tr>
                    <td style="vertical-align: middle" class="text-left">
                        <label class="custom-switch">
                            <input id="aplica-guia" type="checkbox" class="custom-switch-input" value="1" disabled>
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="text-guia">Guías</div>
                    </td>
                    <td style="vertical-align: middle">
                        <input class="form-control" type="text" value="{{implode(', ',$servicio->get_documentos_tipo_codigo(2))}}" readonly>
                    </td>
                    @if (count($servicio->get_documentos_tipo_id(2)) > 0)
                        <td>
                            <button id="btn-archivos-guia" class="btn btn-primary btn-teal" onclick="mostrarArchivos({{$servicio->get_documentos_tipo(2)}},'Guías')" title="Archivos" style="width: 100%"><i class="fas fa-folder"></i></button>
                        </td>
                    @else
                        <td width="65">
                            <button id="btn-archivos-guia" class="btn btn-primary btn-teal" title="Archivos" style="width: 100%" disabled><i class="fas fa-folder"></i></button>
                        </td>
                    @endif
                </tr>
                <tr>
                    <td style="vertical-align: middle" class="text-left">
                        <label class="custom-switch">
                            <input id="aplica-encuesta-ads" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="text-encuesta-ads">Encuesta ADS</div>
                    </td>
                    <td style="vertical-align: middle">
                        <input class="form-control" type="text" value="{{implode(', ',$servicio->get_documentos_tipo_codigo(5))}}" readonly>
                    </td>
                    @if (count($servicio->get_documentos_tipo_id(5)) > 0)
                        <td>
                            <a id="btn-archivos-encuesta-ads" class="btn btn-teal" href="/servicio/descargar_documento/{{$servicio->get_documentos_tipo_id(5)[0]}}" title="Descargar" style="width: 100%"><i class="fas fa-file-download"></i></a>
                        </td>
                    @endif
                </tr>
                <tr>
                    <td style="vertical-align: middle" class="text-left">
                        <label class="custom-switch">
                            <input id="aplica-encuesta-empresa" type="checkbox" class="custom-switch-input" value="1" disabled>
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="text-encuesta-empresa">Encuesta Empresa</div>
                    </td>
                    <td style="vertical-align: middle">
                        <input class="form-control" type="text" value="{{implode(', ',$servicio->get_documentos_tipo_codigo(6))}}" readonly>
                    </td>
                    @if (count($servicio->get_documentos_tipo_id(6)) > 0)
                        <td>
                            <button id="btn-archivos-encuesta-empresa" class="btn btn-primary btn-teal" onclick="mostrarArchivos({{$servicio->get_documentos_tipo(6)}},'Encuesta Empresa')" title="Archivos" style="width: 100%"><i class="fas fa-folder"></i></button>
                        </td>
                    @else
                        <td width="65">
                            <button id="btn-archivos-encuesta-empresa" class="btn btn-primary btn-teal" title="Archivos" style="width: 100%" disabled><i class="fas fa-folder"></i></button>
                        </td>
                    @endif
                </tr>
                <tr>
                    <td style="vertical-align: middle" class="text-left">
                        <label class="custom-switch">
                            <input id="aplica-encuesta-adicionales" type="checkbox" class="custom-switch-input" value="1" disabled>
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="text-encuesta-adicionales">Encuestas Adicionales</div>
                    </td>
                    <td style="vertical-align: middle">
                        <input class="form-control" type="text" value="{{implode(', ',$servicio->get_encuestas_adicionales_codigo())}}" readonly>
                    </td>
                    @if (count($servicio->get_documentos_tipo_id(4)) > 0)
                        <td>
                            <button id="btn-archivos-encuesta-adicionales" class="btn btn-primary btn-teal" onclick="mostrarArchivos({{$servicio->get_encuestas_adicionales()}},'Encuestas Adicionales')" title="Archivos" style="width: 100%"><i class="fas fa-folder"></i></button>
                        </td>
                    @else
                        <td width="65">
                            <button id="btn-archivos-encuesta-adicionales" class="btn btn-primary btn-teal" title="Archivos" style="width: 100%" disabled><i class="fas fa-folder"></i></button>
                        </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4 vertical-line">
        <div class="row">
            <div class="col-md-12">
                <label id="text-detalle" class="form-label">Detalles Diseño Técnico</label>
            </div>
        </div>
        <textarea id="detalle" class="form-control" rows="13" readonly>{{$servicio->diseno_tecnico()->detalle}}</textarea>
    </div>
</div>
<div class="row text-right">
    <div class="col-md-12">
        <hr>
        @if(Auth::user()->has_rol('Diseñador Técnico'))
            <a href="/servicio/disenio_tecnico/{{$servicio->id}}" class="btn btn-teal" title="Diseño Técnico">Modificar Diseño Técnico</a>
        @endif
    </div>
</div>