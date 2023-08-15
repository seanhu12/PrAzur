<div class="modal fade" id="modal-informacion-propuesta" tabindex="-1" role="dialog" aria-labelledby="contactos-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contacto-title">Información de la propuesta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="informacion" class="row">
                    <div class="col-md-12">
                        <ul class="list-group card-list-group">
                            <li class="list-group-item py-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Urgencia</label>
                                            @if ($servicio->propuesta()->urgencia() != null)
                                                <div class="form-control-plaintext">{{$servicio->propuesta()->urgencia()->nombre}}</div>
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label class="form-label">Complejidad del Grupo</label>
                                            @if ($servicio->propuesta()->complejidad_grupo() != null)
                                                <div class="form-control-plaintext">{{$servicio->propuesta()->complejidad_grupo()->nombre}}</div>
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label class="form-label">Experiencia con ADS</label>
                                            @if ($servicio->propuesta()->experiencia_ads == 1)
                                                <div class="form-control-plaintext">Si, {{$servicio->propuesta()->experiencia_en}}</div>
                                            @else
                                                @if ($servicio->propuesta()->experiencia_ads == 0)
                                                    @if ($servicio->propuesta()->experiencia_ads !== null)
                                                        <div class="form-control-plaintext">No</div>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label class="form-label">Experiencia con la Temática</label>
                                            @if ($servicio->propuesta()->experiencia_tematica == 1)
                                                <div class="form-control-plaintext">Si</div>
                                            @else
                                                @if ($servicio->propuesta()->experiencia_tematica == 0)
                                                    @if ($servicio->propuesta()->experiencia_tematica !== null)
                                                        <div class="form-control-plaintext">No</div>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 vertical-line">
                                        <div class="form-group">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <label class="form-label">Perfil Participante</label>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($servicio->propuesta()->participante_perfil() as $perfil)
                                                    <tr>
                                                        <td>- {{$perfil->nombre}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <label class="form-label">Foco Intervención</label>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($servicio->propuesta()->foco_intervencion() as $foco)
                                                    <tr>
                                                        <td>- {{$foco->nombre}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <label class="form-label">Contexto</label>
                                <div class="form-control-plaintext">{{$servicio->propuesta()->observaciones}}</div>
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