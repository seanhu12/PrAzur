<div class="row">
    <div class="col-md-8">

        @include('servicio.checklist_parts.logistica_parts.coordinacion')

        <hr>

        <div class="row">
            <div class="col-md-6">

                @include('servicio.checklist_parts.logistica_parts.material_participante')

            </div>
            <div class="col-md-6 vertical-line">

                @include('servicio.checklist_parts.logistica_parts.sence')

            </div>
        </div>

        <hr>

        @include('servicio.checklist_parts.logistica_parts.material_relator')
    </div>
    <div class="col-md-4 vertical-line">

        @include('servicio.checklist_parts.logistica_parts.outdoor')

        <hr>

        @include('servicio.checklist_parts.logistica_parts.audio_iluminacion')

    </div>
</div>
<div id="finalizar-logistica" class="row">
    <hr>
    <div class="col-md-12">
        <div id="validacion-finalizar-logistica" style="margin-top:1rem;" class="text-center" hidden>
            <div class="alert alert-danger" role="alert">
                Se deben realizar todas las actividades que aplican.
            </div>
        </div>
    </div>
    <div class="col-md-12 text-right">
        <button id="btn-finalizar-logistica" class="btn btn-cyan">Finalizar Etapa de Logística</button>
    </div>
</div>