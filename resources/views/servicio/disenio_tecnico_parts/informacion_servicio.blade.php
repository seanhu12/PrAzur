<div class="modal fade" id="modal-informacion-servicio" tabindex="-1" role="dialog" aria-labelledby="contactos-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contacto-title">Información del servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="informacion" class="row">
                    <div class="col-md-12">
                        <ul class="list-group card-list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Fecha de Ejecución</label>
                                            <div class="form-control-plaintext">{{$servicio->fecha_ejecucion}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Nombre Servicio</label>
                                            <div class="form-control-plaintext">{{$servicio->nombre}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Empresa</label>
                                            <div class="form-control-plaintext">{{$servicio->propuesta()->empresa()->nombre}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">idP</label>
                                            <div class="form-control-plaintext">{{$servicio->propuesta()->idp}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Nombre Curso</label>
                                            <div class="form-control-plaintext">{{$servicio->curso()->nombre_venta}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group">
                                            <label for="select-beast-ciudad" class="form-label">Ciudad de Realización</label>
                                            @if ($servicio->ciudad() != null)
                                                <div class="form-control-plaintext">{{$servicio->ciudad()->nombre}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <label class="form-label">Detalles</label>
                                <div class="form-control-plaintext">{{$servicio->detalles}}</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>