<div class="modal fade" id="modal-contactos" tabindex="-1" role="dialog" aria-labelledby="contactos-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contacto-title">Contactos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="data-tag-contacto-empresa" data-data='{{$contactosEmpresaJson}}'></div>
                <div id="data-tag-contactos-otic" data-data='{{$contactosOticJson}}'></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card sin-borde">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="select-beast-contacto-venta" class="form-label">Contacto Venta</label>
                                    @if ($servicio->propuesta()->get_contacto_empresa_propuesta(1) != null)
                                        <div id="data-tag-contacto-venta" data-data="{{$servicio->propuesta()->get_contacto_empresa_propuesta(1)->contacto_empresa_id}}"></div>
                                        <div class="input-group">
                                            <select id="select-beast-contacto-venta" type="text" tabindex="-1" placeholder="Seleccione un contacto empresa..." class="form-control"></select>
                                            <span class="input-group-append">
                                                <a href="/contacto_empresa/show/{{$servicio->propuesta()->get_contacto_empresa_propuesta(1)->contacto_empresa_id}}" class="btn btn-primary" title="Detalles" ><i class="fas fa-info"></i></a>
                                            </span>
                                        </div>
                                    @else
                                        <div id="data-tag-contacto-venta" data-data=""></div>
                                        <select id="select-beast-contacto-venta" type="text" tabindex="-1" placeholder="Seleccione un contacto empresa..." class="form-control"></select>
                                    @endif
                                    <div id="select-beast-contacto-venta-alert" class="invalid-feedback">Se debe seleccionar un contacto de la empresa.</div>
                                </div>
                                @if ($servicio->propuesta()->get_contacto_empresa_propuesta(1) != null)
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Cargo:
                                                </td>
                                                <td>
                                                    {{ $servicio->propuesta()->get_contacto_empresa_propuesta(1)->contacto_empresa()->cargo }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Fono:
                                                </td>
                                                <td>
                                                    {{ $servicio->propuesta()->get_contacto_empresa_propuesta(1)->contacto_empresa()->celular }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Email:
                                                </td>
                                                <td>
                                                    {{ $servicio->propuesta()->get_contacto_empresa_propuesta(1)->contacto_empresa()->mail }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card sin-borde">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="select-beast-contacto-coordinacion" class="form-label">Contacto Coordinación</label>
                                    @if ($servicio->propuesta()->get_contacto_empresa_propuesta(2) != null)
                                        <div id="data-tag-contacto-coordinacion" data-data="{{$servicio->propuesta()->get_contacto_empresa_propuesta(2)->contacto_empresa_id}}"></div>
                                        <div class="input-group">
                                            <select id="select-beast-contacto-coordinacion" type="text" tabindex="-1" placeholder="Seleccione un contacto empresa..." class="form-control"></select>
                                            <span class="input-group-append">
                                                <a href="/contacto_empresa/show/{{$servicio->propuesta()->get_contacto_empresa_propuesta(2)->contacto_empresa_id}}" class="btn btn-primary" title="Detalles" ><i class="fas fa-info"></i></a>
                                            </span>
                                        </div>
                                    @else
                                        <div id="data-tag-contacto-coordinacion" data-data=""></div>
                                        <select id="select-beast-contacto-coordinacion" type="text" tabindex="-1" placeholder="Seleccione un contacto empresa..." class="form-control"></select>
                                    @endif
                                    <div id="select-beast-contacto-coordinacion-alert" class="invalid-feedback">Se debe seleccionar un contacto de la empresa.</div>
                                </div>
                                @if ($servicio->propuesta()->get_contacto_empresa_propuesta(2) != null)
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Cargo:
                                                </td>
                                                <td>
                                                    {{ $servicio->propuesta()->get_contacto_empresa_propuesta(2)->contacto_empresa()->cargo }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Fono:
                                                </td>
                                                <td>
                                                    {{ $servicio->propuesta()->get_contacto_empresa_propuesta(2)->contacto_empresa()->celular }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Email:
                                                </td>
                                                <td>
                                                    {{ $servicio->propuesta()->get_contacto_empresa_propuesta(2)->contacto_empresa()->mail }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card sin-borde">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="select-beast-contacto-administracion" class="form-label">Contacto Administración y Finanza</label>
                                    @if ($servicio->propuesta()->get_contacto_empresa_propuesta(3) != null)
                                        <div id="data-tag-contacto-administracion" data-data="{{$servicio->propuesta()->get_contacto_empresa_propuesta(3)->contacto_empresa_id}}"></div>
                                        <div class="input-group">
                                            <select id="select-beast-contacto-administracion" type="text" tabindex="-1" placeholder="Seleccione un contacto empresa..." class="form-control"></select>
                                            <span class="input-group-append">
                                                <a href="/contacto_empresa/show/{{$servicio->propuesta()->get_contacto_empresa_propuesta(3)->contacto_empresa_id}}" class="btn btn-primary" title="Detalles" ><i class="fas fa-info"></i></a>
                                            </span>
                                        </div>
                                    @else
                                        <div id="data-tag-contacto-administracion" data-data=""></div>
                                        <select id="select-beast-contacto-administracion" type="text" tabindex="-1" placeholder="Seleccione un contacto empresa..." class="form-control"></select>
                                    @endif
                                    <div id="select-beast-contacto-administracion-alert" class="invalid-feedback">Se debe seleccionar un contacto de la empresa.</div>
                                </div>
                                @if ($servicio->propuesta()->get_contacto_empresa_propuesta(3) != null)
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Cargo:
                                                </td>
                                                <td>
                                                    {{ $servicio->propuesta()->get_contacto_empresa_propuesta(3)->contacto_empresa()->cargo }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Fono:
                                                </td>
                                                <td>
                                                    {{ $servicio->propuesta()->get_contacto_empresa_propuesta(3)->contacto_empresa()->celular }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Email:
                                                </td>
                                                <td>
                                                    {{ $servicio->propuesta()->get_contacto_empresa_propuesta(3)->contacto_empresa()->mail }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card sin-borde">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="select-beast-contacto-otic" class="form-label">Contacto OTIC</label>
                                    @if ($servicio->propuesta()->contacto_otic() != null)
                                        <div id="data-tag-contacto-otic" data-data="{{$servicio->propuesta()->contacto_otic()->id}}"></div>
                                        <div class="input-group">
                                            <select id="select-beast-contacto-otic" type="text" tabindex="-1" placeholder="Seleccione un contacto empresa..." class="form-control"></select>
                                            <span class="input-group-append">
                                                <a href="/contacto_otic/show/{{$servicio->propuesta()->contacto_otic()->id}}" class="btn btn-primary" title="Detalles" ><i class="fas fa-info"></i></a>
                                            </span>
                                        </div>
                                    @else
                                        <div id="data-tag-contacto-otic" data-data=""></div>
                                        <select id="select-beast-contacto-otic" type="text" tabindex="-1" placeholder="Seleccione un contacto empresa..." class="form-control"></select>
                                    @endif
                                    <div id="select-beast-contacto-otic-alert" class="invalid-feedback">Se debe seleccionar un contacto otic.</div>
                                </div>
                                @if ($servicio->propuesta()->contacto_otic() != null)
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Fono:
                                                </td>
                                                <td>
                                                    {{ $servicio->propuesta()->contacto_otic()->celular }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Email:
                                                </td>
                                                <td>
                                                    {{ $servicio->propuesta()->contacto_otic()->mail }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-6">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                <div class="col-md-6 text-right">
                    <button id="btn-guardar" hidden onclick="enviarContactos({{ $servicio }})" type="button" class="btn btn-primary" data-dismiss="modal">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>