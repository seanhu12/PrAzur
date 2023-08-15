$(document).ready(function () {
    /**
     * Enviar contacto otic que se va a deshabilitar
     */
    window.deshabilitarContactoOtic = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar la el Contacto de la OTIC?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/contacto_otic/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/contacto_otic");
            },
            error: function(xhr) {
                // console.log('aj('ajax error');
                // console.logax error');
            }
        });
    };
});