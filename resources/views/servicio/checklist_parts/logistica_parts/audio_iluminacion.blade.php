<div class="row">
    <div class="col-md-12">
        <div class="form-label">
            <h4>Audio e Iluminación</h4>
        </div>
        <div id="data-tag-check-audio-iluminacion" data-data='{{$servicio->check_audio_iluminacion()}}'></div>
        <table class="table">
            <tbody>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-parlante" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-parlante-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-parlante" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-parlante-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-parlante">Parlantes</div>
                    </td>
                </tr>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-atril" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-atril-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-atril" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-atril-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-atril">Atriles</div>
                    </td>
                </tr>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-alargador" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-alargador-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-alargador" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-alargador-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-alargador">Alargador</div>
                    </td>
                </tr>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-foco" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-foco-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-foco" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-foco-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-foco">Focos</div>
                    </td>
                </tr>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-microfono-cintillo" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-microfono-cintillo-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-microfono-cintillo" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-microfono-cintillo-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-microfono-cintillo">Micrófono Cintillo</div>
                    </td>
                </tr>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-microfono-inalambrico" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-microfono-inalambrico-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-microfono-inalambrico" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-microfono-inalambrico-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-microfono-inalambrico">Micrófono Inalámbrico</div>
                    </td>
                </tr>
            </tbody>
        </table>
        @if ($servicio->check_audio_iluminacion() != null)
            <textarea style="margin-top: 1rem" id="logistica-audio-iluminacion-otros" class="form-control" rows="2" placeholder="Otros">{{$servicio->check_audio_iluminacion()->otros}}</textarea>
        @else
            <textarea style="margin-top: 1rem" id="logistica-audio-iluminacion-otros" class="form-control" rows="2" placeholder="Otros"></textarea>
        @endif
        <div id="logistica-audio-iluminacion-guardando-datos" style="margin-top:1rem;" class="text-right" hidden>
            <button type="button" class="btn btn-secondary btn-loading">C</button>Guardando
        </div>
        <div id="logistica-audio-iluminacion-error-guardar-datos" style="margin-top:1rem;" class="text-center" hidden>
            <div class="alert alert-danger" role="alert">
                No se pudo guardar los cambios.
            </div>
        </div>
    </div>
</div>