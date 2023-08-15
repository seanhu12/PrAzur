$(document).ready(function () {

    $('#observaciones-checklist').change(function() {
        guardarDatos();
    });

    /**
     * Envia los datos de la coordinacion para guardarlos en la bd
     */
    function guardarDatos() {
        document.getElementById('observaciones-error-guardar-datos').hidden = true;
        // Mostrar indicador que se estan guardando los datos
        document.getElementById('observaciones-guardando-datos').hidden = false;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/guardar_observaciones_checklist",
            data: {
                id: $('#servicio-id').data('data'),
                observaciones_checklist: document.getElementById('observaciones-checklist').value
            },
            success: function(result) {
                // console.log('ajax observaciones ok');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('observaciones-guardando-datos').hidden = true;
            },
            error: function(xhr) {
                // console.log('ajax observaciones error');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('observaciones-guardando-datos').hidden = true;
                document.getElementById('observaciones-error-guardar-datos').hidden = false;
            }
        });
    }

});