<div class="row">
    <div class="col-md-12">
        <div class="form-label">
            <h4>Cierre del Servicio</h4>
        </div>
        <div id="data-tag-check-cierre" data-data='{{$servicio->check_cierre()}}'></div>
        <div id="data-tag-asistencia-ingresada" data-data='{{$servicio->verificar_ingreso_asistencia()}}'></div>
        <div id="data-tag-encuesta-ingresada" data-data='{{$servicio->verificar_ingreso_encuesta()}}'></div>
        {{-- <div id="data-tag-nota-ingresada" data-data='{{$servicio->verificar_ingreso_notas()}}'></div> --}}
        {{-- <div id="data-tag-encuesta-ingresada" data-data='{{$servicio->verificar_ingreso_encuesta()}}'></div> --}}
        <table class="table">
            <tbody>
                <tr>
                    <td width="36" style="vertical-align: middle">
                        <label class="custom-switch">
                            <input id="cierre-aplica-libro-asistencia" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span id="cierre-aplica-libro-asistencia-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" style="vertical-align: middle" class="text-center">
                        <label class="colorinput">
                            <input id="cierre-listo-libro-asistencia" type="checkbox" value="1" class="colorinput-input" />
                            <span id="cierre-listo-libro-asistencia-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td width="160" style="vertical-align: middle">
                        <div id="cierre-text-libro-asistencia">Libro de Asistencia</div>
                    </td>
                    <td class="text-left">
                        <a id="btn-cierre-libro-asistencia" style="width: 43px; margin-right: 0.25rem; margin-left: 0.25rem;; margin-bottom: 0.10rem; margin-top: 0.10rem;" href="/servicio/ingresar_participantes/{{$servicio->id}}" class="btn btn-teal" title="Ingresar"><i class="fas fa-file-alt"></i></a>
                        <button id="btn-cierre-archivo-libro-asistencia" style="width: 43px; margin-right: 0.25rem; margin-left: 0.25rem;; margin-bottom: 0.10rem; margin-top: 0.10rem;" class="btn btn-cyan" title="Archivo"><i class="fas fa-folder"></i></button>
                    </td>
                </tr>
                <tr>
                    <td width="36" style="vertical-align: middle">
                        <label class="custom-switch">
                            <input id="cierre-aplica-certificado-sence" type="checkbox" class="custom-switch-input" value="1" disabled>
                            <span id="cierre-aplica-certificado-sence-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" style="vertical-align: middle" class="text-center">
                        <label class="colorinput">
                            <input id="cierre-listo-certificado-sence" type="checkbox" value="1" class="colorinput-input" />
                            <span id="cierre-listo-certificado-sence-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td width="160" style="vertical-align: middle">
                        <div id="cierre-text-certificado-sence">Certificado Sence</div>
                    </td>
                    <td class="text-left">
                        <div class="row">
                            <div class="col-xl-8 col-lg-12 col-md-12">
                                {{-- <input id="numero-certificado-sence" onchange="validarNumero(document.getElementById('numero-certificado-sence'),'numero-certificado-sence')" type="text" value="{{ $servicio->numero_certificado_sence }}" style="margin-bottom: 0.25rem" placeholder="Número de Certificado" class="form-control" maxlength="191"> --}}
                                <input id="numero-certificado-sence" style="margin-bottom: 0.10rem; margin-top: 0.10rem; margin-left: 0.25rem" value="{{$servicio->certificado_sence}}" placeholder="Número de Certificado" class="form-control" maxlength="191">
                                <div id="numero-certificado-sence-alert" class="invalid-feedback">Se debe ingresar un numero.</div>
                            </div>
                            <div class="col-xl-4 col-md-12">
                                <button id="btn-cierre-archivo-certificado-sence" style="width: 43px; margin-right: 0.25rem; margin-left: 0.25rem;; margin-bottom: 0.10rem; margin-top: 0.10rem;" class="btn btn-cyan" title="Archivo"><i class="fas fa-folder"></i></button>
                            </div>
                        </div>
                    </td>
                </tr>
                {{-- <tr>
                    <td></td>
                    <td></td>
                    <td>Número de Certificado</td>
                    <td>
                        <div class="row">
                            <div class="col-md-12">
                                <input id="numero-certificado-sence" type="text" value="{{ $servicio->numero_certificado_sence }}" placeholder="Número de Certificado" class="form-control" maxlength="191">
                            </div>
                        </div>
                    </td>
                </tr> --}}
                <tr>
                    <td width="36" style="vertical-align: middle">
                        <label class="custom-switch">
                            <input id="cierre-aplica-encuesta-ads" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span id="cierre-aplica-encuesta-ads-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" style="vertical-align: middle" class="text-center">
                        <label class="colorinput">
                            <input id="cierre-listo-encuesta-ads" type="checkbox" value="1" class="colorinput-input" />
                            <span id="cierre-listo-encuesta-ads-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td width="160" style="vertical-align: middle">
                        <div id="cierre-text-encuesta-ads">Encuesta ADS</div>
                    </td>
                    <td class="text-left">
                        <a id="btn-cierre-encuesta-ads" href="/servicio/ingresar_encuestas_ads/{{$servicio->id}}" style="width: 43px; margin-right: 0.25rem; margin-left: 0.25rem; margin-bottom: 0.10rem; margin-top: 0.10rem;" class="btn btn-teal" title="Ingresar"><i class="fas fa-file-alt"></i></a>
                        <button id="btn-cierre-archivo-encuesta-ads" style="width: 43px; margin-right: 0.25rem; margin-left: 0.25rem;; margin-bottom: 0.10rem; margin-top: 0.10rem;" class="btn btn-cyan" title="Archivo"><i class="fas fa-folder"></i></button>
                    </td>
                </tr>
                <tr>
                    <td width="36" style="vertical-align: middle">
                        <label class="custom-switch">
                            <input id="cierre-aplica-notas" type="checkbox" class="custom-switch-input" value="1" disabled>
                            <span id="cierre-aplica-notas-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" style="vertical-align: middle" class="text-center">
                        <label class="colorinput">
                            <input id="cierre-listo-notas" type="checkbox" value="1" class="colorinput-input" />
                            <span id="cierre-listo-notas-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td width="160" style="vertical-align: middle">
                        <div id="cierre-text-notas">Notas</div>
                    </td>
                    <td class="text-left">
                        <a id="btn-cierre-notas" style="width: 43px; margin-right: 0.25rem; margin-left: 0.25rem; margin-top: 0.10rem;" href="/servicio/ingresar_participantes/{{$servicio->id}}" class="btn btn-teal" title="Ingresar"><i class="fas fa-file-alt"></i></a>
                        <button id="btn-cierre-notas-deshabilitado" style="width: 43px; margin-right: 0.25rem; margin-left: 0.25rem; margin-top: 0.10rem;" class="btn btn-teal" title="Ingresar" disabled hidden><i class="fas fa-file-alt"></i></button>
                    </td>
                </tr>
                <tr>
                    <td width="36" style="vertical-align: middle">
                        <label class="custom-switch">
                            <input id="cierre-aplica-diploma" type="checkbox" class="custom-switch-input" value="1">
                            <span id="cierre-aplica-diploma-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" style="vertical-align: middle" class="text-center">
                        <label class="colorinput">
                            <input id="cierre-listo-diploma" type="checkbox" value="1" class="colorinput-input" />
                            <span id="cierre-listo-diploma-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td width="160" style="vertical-align: middle">
                        <div id="cierre-text-diploma">Diplomas Curso</div>
                    </td>
                    <td class="text-left">
                        <a id="btn-cierre-diploma" style="width: 43px; margin-right: 0.25rem; margin-left: 0.25rem; margin-top: 0.10rem;" href="/servicio/diploma_servicio/{{$servicio->id}}" class="btn btn-teal" title="Generar"><i class="fas fa-medal"></i></a>
                        <button id="btn-cierre-diploma-deshabilitado" style="width: 43px; margin-right: 0.25rem; margin-left: 0.25rem; margin-top: 0.10rem;" class="btn btn-teal" title="Generar" disabled hidden><i class="fas fa-medal"></i></button>
                    </td>
                </tr>
                <tr>
                    <td width="36" style="vertical-align: middle">
                        <label class="custom-switch">
                            <input id="cierre-aplica-oc" type="checkbox" class="custom-switch-input" value="1" checked disabled>
                            <span id="cierre-aplica-oc-color" class="custom-switch-indicator"></span>
                        </label>
                    </td>
                    <td width="50" style="vertical-align: middle" class="text-center">
                        <label class="colorinput">
                            <input id="cierre-listo-oc" type="checkbox" value="1" class="colorinput-input" />
                            <span id="cierre-listo-oc-color" class="colorinput-color bg-cyan"></span>
                        </label>
                    </td>
                    <td width="160" style="vertical-align: middle">
                        <div id="cierre-text-oc">Orden de Compra</div>
                    </td>
                    <td class="text-left">
                        <a id="btn-cierre-oc" style="width: 43px; margin-right: 0.25rem; margin-left: 0.25rem" href="/orden_compra/{{$servicio->id}}" class="btn btn-teal" title="OC"><i class="fas fa-donate"></i></a>
                        <button id="btn-cierre-oc-deshabilitado" style="width: 43px; margin-right: 0.25rem; margin-left: 0.25rem" class="btn btn-teal" title="OC" disabled hidden><i class="fas fa-donate"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="cierre-cierre-guardando-datos" style="margin-top:1rem;" class="text-right" hidden>
            <button type="button" class="btn btn-secondary btn-loading">C</button>Guardando
        </div>
        <div id="cierre-cierre-validacion-listo" style="margin-top:1rem;" class="text-center" hidden>
            <div id="cierre-cierre-validacion-listo-text" class="alert alert-danger" role="alert">
                error.
            </div>
        </div>
        <div id="cierre-cierre-error-guardar-datos" style="margin-top:1rem;" class="text-center" hidden>
            <div class="alert alert-danger" role="alert">
                No se pudo guardar los cambios.
            </div>
        </div>
        <div id="cierre-cierre-validacion-guardar-datos" style="margin-top:1rem;" class="text-center" hidden>
            <div class="alert alert-danger" role="alert">
                No se guardaron los cambios debido a un error en los datos ingresados.
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="modal-archivo-libro-asistencia" tabindex="-1" role="dialog" aria-labelledby="contactos-label" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contacto-title">Libro de Asistencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (count($servicio->get_documentos_checklist_tipo(1)) != 0)
                    <div id="data-tag-archivo-libro-asistencia" data-data="{{$servicio->get_documentos_checklist_tipo(1)}}"></div>
                @else
                    <div id="data-tag-archivo-libro-asistencia" data-data=""></div>
                @endif
                <div class="row">
                    <div class="col-md-10">
                        <div class="custom-file">
                            <input id="archivo-1" type="file" onchange="enviarDatosArchivo('{{$servicio->id}}',1)" class="custom-file-input">
                            <label id="archivo-1-text" class="custom-file-label" for="archivo-libro-asistencia">Adjuntar Libro de Asistencia</label>
                            <div id="archivo-1-alert" class="invalid-feedback">El archivo no es valido.</div>
                        </div>
                    </div>
                    <div class="col-md-2 text-right">
                        <a id="btn-cierre-descargar-libro-asistencia" style="width: 43px;" href="/servicio/download_archivo_checklist/{{$servicio->id}}/1" class="btn btn-teal" title="Descargar"><i class="fas fa-file-download"></i></a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="modal-archivo-certificado-sence" tabindex="-1" role="dialog" aria-labelledby="contactos-label" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contacto-title">Certificado Sence</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (count($servicio->get_documentos_checklist_tipo(2)) != 0)
                    <div id="data-tag-archivo-certificado-sence" data-data="{{$servicio->get_documentos_checklist_tipo(2)}}"></div>
                @else
                    <div id="data-tag-archivo-certificado-sence" data-data=""></div>
                @endif
                <div class="row">
                    <div class="col-md-10">
                        <div class="custom-file">
                            <input id="archivo-2" type="file"  onchange="enviarDatosArchivo('{{$servicio->id}}',2)" class="custom-file-input">
                            <label id="archivo-2-text" class="custom-file-label" for="archivo-certificado-sence">Adjuntar Certificado Sence</label>
                            <div id="archivo-2-alert" class="invalid-feedback">El archivo no es valido.</div>
                        </div>
                    </div>
                    <div class="col-md-2 text-right">
                        <a id="btn-cierre-descargar-certificado-sence" style="width: 43px;" href="/servicio/download_archivo_checklist/{{$servicio->id}}/2" class="btn btn-teal" title="Descargar"><i class="fas fa-file-download"></i></a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="modal-archivo-encuesta-ads" tabindex="-1" role="dialog" aria-labelledby="contactos-label" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contacto-title">Encuesta ADS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @if (count($servicio->get_documentos_checklist_tipo(3)) != 0)
                        <div id="data-tag-archivo-encuesta-ads" data-data="{{$servicio->get_documentos_checklist_tipo(3)}}"></div>
                    @else
                        <div id="data-tag-archivo-encuesta-ads" data-data=""></div>
                    @endif
                    <div class="col-md-10">
                        <div class="custom-file">
                            <input id="archivo-3" type="file"  onchange="enviarDatosArchivo('{{$servicio->id}}',3)" class="custom-file-input">
                            <label id="archivo-3-text" class="custom-file-label" for="archivo-encuesta-ads">Adjuntar Encuestas ADS</label>
                            <div id="archivo-3-alert" class="invalid-feedback">El archivo no es valido.</div>
                        </div>
                    </div>
                    <div class="col-md-2 text-right">
                        <a id="btn-cierre-descargar-encuesta-ads" style="width: 43px;" href="/servicio/download_archivo_checklist/{{$servicio->id}}/3" class="btn btn-teal" title="Descargar"><i class="fas fa-file-download"></i></a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>