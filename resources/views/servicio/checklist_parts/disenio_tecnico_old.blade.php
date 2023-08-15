<div class="row">
    <div class="col-md-8">
        <div id="data-tag-disenio-tecnico" data-data='{{ $servicio->check_diseno_tecnico()}}'></div>
        <table class="table">
            <tbody>
                <tr>
                    <td style="vertical-align: middle" class="text-left">
                        <label class="custom-switch">
                            <input id="aplica-relator" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle" class="text-center">
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input id="listo-relator" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="text-relator">Relator</div>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="data-tag-relator" data-data='{{ $relatoresJson }}'></div>
                        <div id="data-tag-relator-servicio" data-data='{{ $servicio->relator_id }}'></div>
                        <select id="select-beast-relator" type="text" tabindex="-1" placeholder="Seleccione un relator..." class="form-control"></select>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: middle" class="text-left">
                        <label class="custom-switch">
                            <input id="aplica-estructura" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle" class="text-center">
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input id="listo-estructura" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="text-estructura">Estructura Curso</div>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="data-tag-estructura" data-data='{{ $servicio->curso()->estructuras() }}'></div>
                        <div id="data-tag-estructura-servicio" data-data='{{ $servicio->estructura_id }}'></div>
                        <select id="select-beast-estructura" type="text" tabindex="-1" placeholder="Seleccione una estructura..." class="form-control"></select>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: middle" class="text-left">
                        <label class="custom-switch">
                            <input id="aplica-manual" type="checkbox" class="custom-switch-input" value="1">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle" class="text-center">
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input id="listo-manual" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="text-manual">Manuales</div>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="data-tag-manual" data-data='{{ $documento->get_documentos_tipo(1) }}'></div>
                        <div id="data-tag-manual-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo(1)) }}'></div>
                        <select id="input-tags-manual" type="text" tabindex="-1" placeholder="Seleccione un manual..." class="form-control"></select>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: middle" class="text-left">
                        <label class="custom-switch">
                            <input id="aplica-prueba" type="checkbox" class="custom-switch-input" value="1">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle" class="text-center">
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input id="listo-prueba" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="text-prueba">Pruebas</div>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="data-tag-prueba" data-data='{{ $documento->get_documentos_tipo(3) }}'></div>
                        <div id="data-tag-prueba-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo(3)) }}'></div>
                        <select id="input-tags-prueba" type="text" tabindex="-1" placeholder="Seleccione una prueba..." class="form-control"></select>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: middle" class="text-left">
                        <label class="custom-switch">
                            <input id="aplica-guia" type="checkbox" class="custom-switch-input" value="1">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle" class="text-center">
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input id="listo-guia" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="text-guia">Guías</div>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="data-tag-guia" data-data='{{ $documento->get_documentos_tipo(2) }}'></div>
                        <div id="data-tag-guia-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo(2)) }}'></div>
                        <select id="input-tags-guia" type="text" tabindex="-1" placeholder="Seleccione una guia..." class="form-control"></select>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: middle" class="text-left">
                        <label class="custom-switch">
                            <input id="aplica-encuesta-diagnostica" type="checkbox" class="custom-switch-input" value="1">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle" class="text-center">
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input id="listo-encuesta-diagnostica" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label"></span>
                        </label>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="text-encuesta-diagnostica">Encuesta Diagnóstica</div>
                    </td>
                    <td style="vertical-align: middle">
                        <div id="data-tag-encuesta-diagnostica" data-data='{{ $documento->get_documentos_tipo(4) }}'></div>
                        <div id="data-tag-encuesta-diagnostica-servicio" data-data='{{ json_encode($servicio->get_documentos_tipo(4)) }}'></div>
                        <select id="input-tags-encuesta-diagnostica" type="text" tabindex="-1" placeholder="Seleccione una encuesta..." class="form-control"></select>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4 verticalLine">
        <div class="row">
            <div class="col-md-6">
                <label id="text-compras" class="form-label">Compras</label>
            </div>
            <div class="col-md-6 text-right">
                <label class="custom-switch">
                    <input id="aplica-compras" type="checkbox" class="custom-switch-input" value="1">
                    <span class="custom-switch-indicator"></span>
                </label>
            </div>
        </div>
        <textarea id="compras" class="form-control" rows="9">{{$servicio->check_diseno_tecnico()->compras}}</textarea>
    </div>
</div>