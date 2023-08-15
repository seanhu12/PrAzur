<div class="row">
    <div class="col-md-12">
        <div class="form-label">
            <h4>Material Relator</h4>
        </div>
        <div id="data-tag-check-material-relator" data-data='{{$servicio->check_material_relator()}}'></div>
        <table class="table">
            <tbody>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-libro-asistencia" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span id="logistica-aplica-libro-asistencia-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-libro-asistencia" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-libro-asistencia-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td width="160">
                        <div id="logistica-text-libro-asistencia">Libro de Asistencia</div>
                    </td>
                    <td class="text-left">
                        <a id="btn-logistica-libro-asistencia" style="width: 43px;" href="/servicio/lista_asistencia_servicio/{{$servicio->id}}" class="btn btn-teal" style="width:100%" title="Generar Libro de Asistencia"><i class="fas fa-book"></i></a>
                    </td>
                </tr>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-pendon" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span id="logistica-aplica-pendon-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-pendon" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-pendon-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-pendon">Pendones</div>
                    </td>
                    <td>
                        <div id="data-tag-logistica-pendon" data-data='{{ $pendones }}'></div>
                        <div id="data-tag-logistica-pendon-servicio" data-data='{{ json_encode($servicio->get_id_pendones()) }}'></div>
                        <select id="input-tags-logistica-pendon" type="text" tabindex="-1" placeholder="Seleccione un pendon..." class="form-control"></select>
                    </td>
                </tr>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-proyector" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-proyector-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-proyector" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-proyector-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-proyector">Proyector</div>
                    </td>
                    <td>
                        <div id="data-tag-logistica-proyector" data-data='{{ $proyectores }}'></div>
                        <div id="data-tag-logistica-proyector-servicio" data-data='{{ $servicio->proyector_id }}'></div>
                        <select id="select-beast-logistica-proyector" type="text" tabindex="-1" placeholder="Seleccione un proyector..." class="form-control"></select>
                    </td>
                </tr>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-notebook" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-notebook-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-notebook" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-notebook-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-notebook">Notebook</div>
                    </td>
                    <td>
                        <div id="data-tag-logistica-notebook" data-data='{{ $notebooks }}'></div>
                        <div id="data-tag-logistica-notebook-servicio" data-data='{{ $servicio->notebook_id }}'></div>
                        <select id="select-beast-logistica-notebook" type="text" tabindex="-1" placeholder="Seleccione un notebook..." class="form-control"></select>
                    </td>
                </tr>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-encuesta-ads" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span id="logistica-aplica-encuesta-ads-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-encuesta-ads" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-encuesta-ads-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-encuesta-ads">Encuesta ADS</div>
                    </td>
                </tr>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-encuesta-empresa" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span id="logistica-aplica-encuesta-empresa-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-encuesta-empresa" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-encuesta-empresa-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-encuesta-empresa">Encuesta Empresa</div>
                    </td>
                </tr>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-encuesta-adicionales" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span id="logistica-aplica-encuesta-adicionales-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-encuesta-adicionales" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-encuesta-adicionales-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-encuesta-adicionales">Encuestas Adicionales</div>
                    </td>
                </tr>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-guia" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span id="logistica-aplica-guia-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-guia" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-guia-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-guia">Guias</div>
                    </td>
                </tr>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-prueba" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span id="logistica-aplica-prueba-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-prueba" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-prueba-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-prueba">Pruebas</div>
                    </td>
                </tr>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-plumones" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-plumones-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-plumones" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-plumones-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-plumones">Plumones</div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="logistica-material-relator-guardando-datos" style="margin-top:1rem;" class="text-right" hidden>
            <button type="button" class="btn btn-secondary btn-loading">C</button>Guardando
        </div>
        <div id="logistica-material-relator-validacion-listo" style="margin-top:1rem;" class="text-center" hidden>
            <div id="logistica-material-relator-validacion-listo-text" class="alert alert-danger" role="alert">
                error.
            </div>
        </div>
        <div id="logistica-material-relator-error-guardar-datos" style="margin-top:1rem;" class="text-center" hidden>
            <div class="alert alert-danger" role="alert">
                No se pudo guardar los cambios.
            </div>
        </div>
    </div>
</div>