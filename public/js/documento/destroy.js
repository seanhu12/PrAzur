$(document).ready(function () {
    /**
     * Enviar documento que se va a deshabilitar
     */
    window.deshabilitarDocumento = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar el documento?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/documento/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/documento");
            },
            error: function(xhr) {
                // console.log(xhr);
            }
        });
    };
});