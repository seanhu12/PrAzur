<div class="modal fade" id="modal-agregar-servicio" tabindex="-1" role="dialog" aria-labelledby="agregar-servicio-label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregar-servicio-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label class="form-label">Nombre del Servicio*</label>
                            <input id="nombre-servicio" placeholder="Nombre del Servicio" type="text" class="form-control" maxlength="191" autofocus>
                            <div id="nombre-servicio-alert" class="invalid-feedback">El dato ingresado no es valido.</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Fecha de Ejecución*</label>
                            <input id="fecha-ejecucion" onchange="validarFechaNoPasada(document.getElementById('fecha-ejecucion').value,'fecha-ejecucion');" placeholder="Fecha de Ejecucion" type="date" class="form-control">
                            <div id="fecha-ejecucion-alert" class="invalid-feedback">La fecha no puede ser anterior a la actual.</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Monto*</label>
                            <input id="monto" placeholder="Monto" type="text" class="form-control" maxlength="13">
                            <div id="monto-alert" class="invalid-feedback">El monto puede tener máximo 9 digitos.</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Horario</label>
                            <input id="horario" onchange="validarHorario(document.getElementById('horario').value,'horario');" placeholder="00:00-00:00" type="text" class="form-control">
                            <div id="horario-alert" class="invalid-feedback">Se debe ingresar como "00:00-00:00".</div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label class="form-label">Código Sence</label>
                            <div class="row gutters-xs">
                                <div class="col">
                                <input id="codigo-sence" placeholder="Código Sence" type="text" class="form-control" readonly>
                                    <div id="codigo-sence-alert" class="invalid-feedback">Se debe ingresar un numero.</div>
                                </div>
                                <span class="col-auto">
                                    <label class="custom-switch">
                                        <input id="sence-si-no" type="checkbox" class="custom-switch-input" onclick="elegirSence()" checked>
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Número de Horas</label>
                            <input id="numero-horas" onchange="validarMaxMinNumeroHoras();" placeholder="Número de Horas" type="text" class="form-control" maxlength="11">
                            <div id="numero-horas-alert" class="invalid-feedback">Se debe ingresar un valor entre 0,0 y 99,9.</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Número de Participantes</label>
                            <input id="numero-participantes" onchange="validarMaxMinNumeroParticipantes();" placeholder="Número de Participantes" type="text" class="form-control" maxlength="11">
                            <div id="numero-participantes-alert" class="invalid-feedback">Se debe ingresar un valor entre 0 y 99.</div>
                        </div>
                        <div class="form-group">
                            <label for="select-beast-relator" class="form-label">Relator</label>
                            <select id="select-beast-relator" type="text" tabindex="-1" placeholder="Seleccione un relator..." class="form-control"></select>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="select-beast-ciudad" class="form-label">Ciudad de Realización</label>
                            <select id="select-beast-ciudad" type="text" tabindex="-1" placeholder="Seleccione una ciudad..." class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Lugar de Realización</label>
                        <input id="lugar" value="{{ $propuesta->empresa()->direccion }}" placeholder="Lugar de Realización" type="text" class="form-control" maxlength="191">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Salón</label>
                            <input id="salon" placeholder="Salón" type="text" class="form-control" maxlength="191">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <label class="custom-control custom-checkbox">
                            <input id="coffee" type="checkbox" class="custom-control-input" value="1" checked>
                            <span class="custom-control-label">Coffee</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="almuerzo" type="checkbox" class="custom-control-input" value="1" checked>
                            <span class="custom-control-label">Almuerzo</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="encuesta-empresa" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Encuesta Empresa</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="encuesta-adicionales" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Encuestas Adicionales</span>
                        </label>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <label class="custom-control custom-checkbox">
                            <input id="diploma-curso" type="checkbox" class="custom-control-input" value="1" checked>
                            <span class="custom-control-label">Diploma Curso</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="outdoor" onclick="mostrarOutdoor()" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Outdoor</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="audio-iluminacion" onclick="mostrarAudioIluminacion()" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Audio e Iluminación</span>
                        </label>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <label class="custom-control custom-checkbox">
                            <input id="pruebas" type="checkbox" class="custom-control-input" value="1" checked>
                            <span class="custom-control-label">Aplicar Pruebas</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="carpeta-participantes" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Carpeta ADS Participantes</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="velobind" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Velobind</span>
                        </label>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <label class="custom-control custom-checkbox">
                            <input id="guias" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Aplicar Guías</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="bitacora" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Bitácora Aprendizaje</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="lapices" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Lápices</span>
                        </label>
                    </div>
                </div>
                <hr id="separacion-outdoor">
                <h4 id="titulo-outdoor">Outdoor</h4>
                <div id="opciones-outdoor" class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <label class="custom-control custom-checkbox">
                            <input id="venda" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Venda</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="pvc" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">PVC</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="pelota" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Pelota</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="plumones" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Plumones</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="papel-kraft" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Papel Kraft</span>
                        </label>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <label class="custom-control custom-checkbox">
                            <input id="pechera" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Pechera</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="masking" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Masking</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="bolsa-basura" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Bolsa de Basura</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="cono" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Cono</span>
                        </label>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <label class="custom-control custom-checkbox">
                            <input id="plato" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Plato</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="aro-madera" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Aro de Madera</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="tijera" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Tijera</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="esqui" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Esquí</span>
                        </label>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="form-group">
                            <textarea id="otros-outdoor" class="form-control" placeholder="Materiales adicionales" rows="4" maxlength="9999"></textarea>
                        </div>
                    </div>
                </div>
                <hr id="separacion-audio-iluminacion">
                <h4 id="titulo-audio-iluminacion">Audio e Iluminación</h4>
                <div id="opciones-audio-iluminacion" class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <label class="custom-control custom-checkbox">
                            <input id="parlantes" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Parlantes</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="atril" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Atril</span>
                        </label>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <label class="custom-control custom-checkbox">
                            <input id="alargador" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Alargador</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="foco" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Foco</span>
                        </label>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <label class="custom-control custom-checkbox">
                            <input id="microfono-cintillo" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Micrófono Cintillo</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="microfono-inalambrico" type="checkbox" class="custom-control-input" value="1">
                            <span class="custom-control-label">Micrófono Inalámbrico</span>
                        </label>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="form-group">
                            <textarea id="otros-audio-iluminacion" class="form-control" placeholder="Materiales adicionales" rows="1" maxlength="9999"></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Detalles del Servicio</label>
                            <textarea id="detalles" class="form-control" rows="4" maxlength="9999"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-6">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                <div class="col-md-6 text-right">
                    <button id="btn-agregar-servicio" type="button" onclick="agregarServicio()" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</div>