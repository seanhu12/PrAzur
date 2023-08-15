<div class="row">
    <div class="col-md-12">
        <div class="form-label">
            <h4>Sence</h4>
        </div>
        <div id="data-tag-check-sence" data-data='{{$servicio->check_sence()}}'></div>
        <div id="data-tag-aplica-sence" data-data='{{$servicio->sence_aplica}}'></div>
        <div id="data-tag-codigo-sence" data-data='{{$servicio->curso()->codigo_sence}}'></div>
        <table class="table">
            <tbody>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-sence-notebook" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-sence-notebook-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-sence-notebook" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-sence-notebook-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-sence-notebook">ID Sence Cargado en Notebook</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="custom-switch">
                            <input id="logistica-aplica-lector-biometrico" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-lector-biometrico-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-lector-biometrico" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-lector-biometrico-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-lector-biometrico">Verificar Lector Biométrico</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="custom-switch">
                            <input id="logistica-aplica-reglamento-sence" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-reglamento-sence-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-reglamento-sence" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-reglamento-sence-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-reglamento-sence">Reglamento Sence</div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="logistica-sence-guardando-datos" style="margin-top:1rem;" class="text-right" hidden>
            <button type="button" class="btn btn-secondary btn-loading">C</button>Guardando
        </div>
        <div id="logistica-sence-error-guardar-datos" style="margin-top:1rem;" class="text-center" hidden>
            <div class="alert alert-danger" role="alert">
                No se pudo guardar los cambios.
            </div>
        </div>
    </div>
</div>