<div class="row">
    <div class="col-md-12">
        <div class="form-label">
            <h4>Coordinación</h4>
        </div>
        <div id="data-tag-check-coordinacion" data-data='{{$servicio->check_coordinacion()}}'></div>
        <div id="data-tag-hay-participantes" data-data='{{$hayParticipantes}}'></div>
        <table class="table">
            <tbody>
                <tr>
                    <td width="36">
                        <label class="custom-switch">
                            <input id="logistica-aplica-sala" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span id="logistica-aplica-sala-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-sala" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-sala-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td width="160">
                        <div id="logistica-text-sala">Sala</div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-xl-12">
                                <input id="salon" type="text" value="{{ $servicio->salon }}" placeholder="Sala" class="form-control" maxlength="191">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="custom-switch">
                            <input id="logistica-aplica-coffee" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-coffee-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-coffee" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-coffee-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-coffee">Coffee</div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-xl-4 col-lg-6">
                                <div class="input-group">
                                    <input id="logistica-horario-am-coffee" onchange="validarHorario(document.getElementById('logistica-horario-am-coffee').value,'logistica-horario-am-coffee');" value="{{ $servicio->horario_coffee_am }}" placeholder="00:00-00:00" type="text" class="form-control">
                                    <span class="input-group-append">
                                        <label id="logistica-text-horario-coffee-am" class="form-control">AM</label>
                                    </span>
                                    <div id="logistica-horario-am-coffee-alert" class="invalid-feedback">Se debe ingresar como "00:00-00:00".</div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6">
                                <div class="input-group">
                                    <input id="logistica-horario-pm-coffee" onchange="validarHorario(document.getElementById('logistica-horario-pm-coffee').value,'logistica-horario-pm-coffee');" value="{{ $servicio->horario_coffee_pm }}" placeholder="00:00-00:00" type="text" class="form-control">
                                    <span class="input-group-append">
                                        {{-- <label class="form-control bg-cyan" style="color: white"><strong>PM</strong></label> --}}
                                        <label id="logistica-text-horario-coffee-pm" class="form-control">PM</label>
                                    </span>
                                    <div id="logistica-horario-pm-coffee-alert" class="invalid-feedback">Se debe ingresar como "00:00-00:00".</div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="custom-switch">
                            <input id="logistica-aplica-almuerzo" type="checkbox" class="custom-switch-input" value="1" checked>
                            <span id="logistica-aplica-almuerzo-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-almuerzo" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-almuerzo-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-almuerzo">Almuerzo</div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-xl-3 col-lg-5">
                                <input id="logistica-horario-almuerzo" onchange="validarHorario(document.getElementById('logistica-horario-almuerzo').value,'logistica-horario-almuerzo');" value="{{ $servicio->horario_almuerzo }}" placeholder="00:00-00:00" type="text" class="form-control">
                                <div id="logistica-horario-almuerzo-alert" class="invalid-feedback">Se debe ingresar como "00:00-00:00".</div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="custom-switch">
                            <input id="logistica-aplica-nomina-participantes" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span id="logistica-aplica-nomina-participantes-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td class="text-center">
                        <label class="colorinput">
                            <input id="logistica-listo-nomina-participantes" type="checkbox" value="1" class="colorinput-input" />
                            <span id="logistica-listo-nomina-participantes-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td>
                        <div id="logistica-text-nomina-participantes">Nómina Participantes</div>
                    </td>
                    <td class="text-left">
                        <a id="logistica-btn-nomina-participantes" href="/servicio/ingresar_participantes/{{$servicio->id}}" class="btn btn-teal" style="width:43px" title="Ingresar Nómina"><i class="fas fa-list-alt"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="logistica-coordinacion-guardando-datos" style="margin-top:1rem;" class="text-right" hidden>
            <button type="button" class="btn btn-secondary btn-loading">C</button>Guardando
        </div>
        <div id="logistica-coordinacion-validacion-listo" style="margin-top:1rem;" class="text-center" hidden>
            <div id="logistica-coordinacion-validacion-listo-text" class="alert alert-danger" role="alert">
                error.
            </div>
        </div>
        <div id="logistica-coordinacion-error-guardar-datos" style="margin-top:1rem;" class="text-center" hidden>
            <div class="alert alert-danger" role="alert">
                No se pudo guardar los cambios.
            </div>
        </div>
        <div id="logistica-coordinacion-validacion-guardar-datos" style="margin-top:1rem;" class="text-center" hidden>
            <div class="alert alert-danger" role="alert">
                No se guardaron los cambios debido a un error en los datos ingresados.
            </div>
        </div>
    </div>
</div>