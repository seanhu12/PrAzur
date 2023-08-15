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
                        <div id="data-tag-relator" data-data='{{ $relatoresJson }}'></div>
                        <div id="data-tag-relator-servicio" data-data='{{ $servicio->relator_id }}'></div>
                        <select id="select-beast-relator" type="text" tabindex="-1" placeholder="Seleccione un relator..." class="form-control" disabled></select>
                    </td>
                    @if ($servicio->relator_id != null)
                        <td>
                            <a href="/relator/show/{{$servicio->relator_id}}" class="btn btn-teal" title="Detalles" style="width: 100%" ><i class="fas fa-info"></i></a>
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
                        <div id="data-tag-estructura" data-data='{{ $servicio->curso()->estructuras() }}'></div>
                        <div id="data-tag-estructura-servicio" data-data='{{ $servicio->estructura_id }}'></div>
                        <select id="select-beast-estructura" type="text" tabindex="-1" placeholder="Seleccione una estructura..." class="form-control" disabled></select>
                    </td>
                    @if ($servicio->estructura_id != null)
                        <td width="65">
                            <a id="btn-descargar-estructura" class="btn btn-primary btn-teal" href="/servicio/descargar_estructura/{{$servicio->estructura_id}}" title="Descargar" style="width: 100%"><i class="fas fa-file-download"></i></a>
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
                        <div id="data-tag-manual" data-data='{{ $documento->get_documentos_tipo(1) }}'></div>
                        <div id="data-tag-manual-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo_id(1)) }}'></div>
                        <select id="input-tags-manual" type="text" tabindex="-1" placeholder="Seleccione un manual..." class="form-control" disabled></select>
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
                        <div id="data-tag-prueba" data-data='{{ $documento->get_documentos_tipo(3) }}'></div>
                        <div id="data-tag-prueba-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo_id(3)) }}'></div>
                        <select id="input-tags-prueba" type="text" tabindex="-1" placeholder="Seleccione una prueba..." class="form-control" disabled></select>
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
                        <div id="data-tag-guia" data-data='{{ $documento->get_documentos_tipo(2) }}'></div>
                        <div id="data-tag-guia-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo_id(2)) }}'></div>
                        <select id="input-tags-guia" type="text" tabindex="-1" placeholder="Seleccione una guia..." class="form-control" disabled></select>
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
                        <div id="data-tag-encuesta-ads" data-data='{{ $documento->get_documentos_tipo(5) }}'></div>
                        <div id="data-tag-encuesta-ads-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo_id(5)) }}'></div>
                        <select id="select-beast-encuesta-ads" type="text" tabindex="-1" placeholder="Seleccione una encuesta..." class="form-control" disabled></select>
                    </td>
                    @if (count($servicio->get_documentos_tipo_id(5)) > 0)
                        <td>
                            <a id="btn-archivos-encuesta-ads" class="btn btn-primary btn-teal" href="/servicio/descargar_documento/{{$servicio->get_documentos_tipo_id(5)[0]}}" title="Descargar" style="width: 100%"><i class="fas fa-file-download"></i></a>
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
                        <div id="data-tag-encuesta-empresa" data-data='{{ $documento->get_documentos_tipo(6) }}'></div>
                        <div id="data-tag-encuesta-empresa-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo_id(6)) }}'></div>
                        <select id="input-tags-encuesta-empresa" type="text" tabindex="-1" placeholder="Seleccione una encuesta..." class="form-control" disabled></select>
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
                        <div id="data-tag-encuesta-adicionales" data-data='{{ $documento->get_documentos_tipo(4) }}'></div>
                        <div id="data-tag-encuesta-adicionales-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo_id(4)) }}'></div>
                        <select id="input-tags-encuesta-adicionales" type="text" tabindex="-1" placeholder="Seleccione una encuesta..." class="form-control" disabled></select>
                    </td>
                    @if (count($servicio->get_documentos_tipo_id(4)) > 0)
                        <td>
                            <button id="btn-archivos-encuesta-adicionales" class="btn btn-primary btn-teal" onclick="mostrarArchivos({{$servicio->get_documentos_tipo(4)}},'Encuestas Diagnóstica')" title="Archivos" style="width: 100%"><i class="fas fa-folder"></i></button>
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
            <div class="col-md-6">
                <label id="text-detalle" class="form-label">Detalles Diseño Técnico</label>
            </div>
        </div>
        <textarea id="detalle" class="form-control" rows="13" readonly>{{$servicio->diseno_tecnico()->detalle}}</textarea>
    </div>
</div>