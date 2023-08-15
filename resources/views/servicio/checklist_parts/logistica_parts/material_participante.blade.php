<div class="row">
    <div class="col-md-12">
        <div class="form-label">
            <h4>Material Participante</h4>
        </div>
        <div id="data-tag-check-material-participante" data-data='{{$servicio->check_material_participante()}}'></div>
        <table class="table">
            <tbody>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-gafete" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-gafete-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-gafete" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-gafete-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-gafete">Gafetes</div>
                    </td>
                    <td>
                        <a id="btn-gafete" href="/servicio/generar_gafetes/{{$servicio->id}}" class="btn btn-teal" title="Descargar Gafetes"><i class="fas fa-file-download"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="custom-switch">
                            <input id="logistica-aplica-bitacora" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-bitacora-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-bitacora" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-bitacora-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-bitacora">Bitácora de Aprendizaje</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="custom-switch">
                            <input id="logistica-aplica-carpeta" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-carpeta-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-carpeta" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-carpeta-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-carpeta">Carpeta ADS</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="custom-switch">
                            <input id="logistica-aplica-velobind" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-velobind-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-velobind" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-velobind-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-velobind">Velobind</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="custom-switch">
                            <input id="logistica-aplica-lapices" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-lapices-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-lapices" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-lapices-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-lapices">Lápices</div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="logistica-material-participante-guardando-datos" style="margin-top:1rem;" class="text-right" hidden>
            <button type="button" class="btn btn-secondary btn-loading">C</button>Guardando
        </div>
        <div id="logistica-material-participante-error-guardar-datos" style="margin-top:1rem;" class="text-center" hidden>
            <div class="alert alert-danger" role="alert">
                No se pudo guardar los cambios.
            </div>
        </div>
    </div>
</div>