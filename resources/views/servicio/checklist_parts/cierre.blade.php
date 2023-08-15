<div class="row">
    <div class="col-md-6">

        @include('servicio.checklist_parts.cierre_parts.cierre')

    </div>
    <div class="col-md-6 vertical-line">
        <div class="row">
            <div class="col-md-12">

                @include('servicio.checklist_parts.cierre_parts.material_relator')

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">

                @include('servicio.checklist_parts.cierre_parts.sence')

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">

                @include('servicio.checklist_parts.cierre_parts.outdoor')

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">

                @include('servicio.checklist_parts.cierre_parts.audio_iluminacion')


                <div id="cierre-recepcion-guardando-datos" style="margin-top:1rem;" class="text-right" hidden>
                    <button type="button" class="btn btn-secondary btn-loading">C</button>Guardando
                </div>
                <div id="cierre-recepcion-error-guardar-datos" style="margin-top:1rem;" class="text-center" hidden>
                    <div class="alert alert-danger" role="alert">
                        No se pudo guardar los cambios.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div id="finalizar-cierre" class="row">
    <div class="col-md-12">
        <div id="validacion-finalizar-cierre" style="margin-top:1rem;" class="text-center" hidden>
            <div class="alert alert-danger" role="alert">
                Se deben realizar todas las actividades que aplican.
            </div>
        </div>
    </div>
    <div class="col-md-12 text-right">
        <button id="btn-finalizar-cierre" class="btn btn-cyan">Finalizar Etapa de Cierre</button>
    </div>
</div>