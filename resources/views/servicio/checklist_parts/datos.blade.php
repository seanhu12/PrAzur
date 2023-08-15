<div class="row">
    <div class="col-md-12">
        <ul class="list-group card-list-group">
            <li class="list-group-item">
                <div class="row">
                    <div class="col-lg-2 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Fecha de Ejecución</label>
                            <input id="fecha-ejecucion" type="date" onchange="validarFechaNoPasada(document.getElementById('fecha-ejecucion').value,'fecha-ejecucion');" placeholder="Fecha de Ejecucion" class="form-control" value="{{ $servicio->fecha_ejecucion }}">
                            <div id="fecha-ejecucion-alert" class="invalid-feedback">La fecha no puede ser anterior a la actual.</div>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-9">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-label">Nombre Curso</label>
                                    <input id="curso" type="text" class="form-control" value="{{ $servicio->curso()->nombre_venta }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2 text-right">
                                <button class="btn btn-teal" onclick="mostrarInformacionPropuesta();" title="Informacion de la propuesta" style="width: 43px"><i class="fas fa-info-circle"></i></button>
                                <button class="btn btn-teal" onclick="mostrarContactos();" title="Contactos" style="width: 43px"><i class="fas fa-address-book"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-3">
                        <div class="form-group">
                            <label class="form-label">idP</label>
                            <input id="idp" type="text" class="form-control" value="{{ $servicio->propuesta()->idp }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Empresa</label>
                            <input id="empresa" type="text" class="form-control" value="{{ $servicio->propuesta()->empresa()->nombre }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="form-group">
                            <label class="form-label">Nombre Servicio</label>
                            <input id="empresa" type="text" class="form-control" value="{{ $servicio->nombre }}" readonly>
                        </div>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-xl-2 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Horario Ejecución</label>
                            <input id="horario-ejecucion" onchange="validarHorario(document.getElementById('horario-ejecucion').value,'horario-ejecucion');" value="{{ $servicio->horario }}" placeholder="00:00-00:00" type="text" class="form-control">
                            <div id="horario-ejecucion-alert" class="invalid-feedback">Se debe ingresar como "00:00-00:00".</div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Cantidad de Participantes</label>
                            <input id="cantidad-participantes" value="{{ $servicio->cant_participantes }}" placeholder="" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">ID Acción</label>
                            <input id="id-accion" type="text" value="{{ $servicio->id_accion }}" placeholder="ID Acción" class="form-control" maxlength="30">
                            <div id="id-accion-alert" class="invalid-feedback">Se debe ingresar un número.</div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Código Sence</label>
                            <input id="codigo-sence" type="text" value="{{ $servicio->curso()->codigo_sence }}" placeholder="No Sence" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div id="data-tag-ciudad" data-data='{{ $ciudadesJson }}'></div>
                            <div id="data-tag-ciudad-servicio" data-data='{{ $servicio->ciudad_id }}'></div>
                            <label for="select-beast-ciudad" class="form-label">Ciudad de Realización</label>
                            <select id="select-beast-ciudad" type="text" tabindex="-1" placeholder="Seleccione una ciudad..." class="form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="form-label">Lugar de Realización</label>
                            <input id="lugar" type="text" value="{{ $servicio->lugar_realizacion }}" placeholder="Lugar de Realización" class="form-control" maxlength="191">
                        </div>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <label class="form-label">Detalles del Servicio</label>
                <textarea id="detalles" class="form-control" rows="3" readonly>{{ $servicio->detalles }}</textarea>
                <div id="guardando-datos" style="margin-top:1rem;" class="text-right" hidden>
                    <button type="button" class="btn btn-secondary btn-loading">C</button>Guardando
                </div>
                <div id="error-guardar-datos" style="margin-top:1rem;" class="text-center" hidden>
                    <div class="alert alert-danger" role="alert">
                        No se pudo guardar los cambios.
                    </div>
                </div>
                <div id="validacion-guardar-datos" style="margin-top:1rem;" class="text-center" hidden>
                    <div class="alert alert-danger" role="alert">
                        No se guardaron los cambios debido a un error en los datos ingresados.
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>