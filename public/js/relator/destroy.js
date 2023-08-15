$(document).ready(function () {
    /**
     * Enviar empresa que se va a deshabilitar
     */
    window.deshabilitarRelator = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar al relator?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/relator/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/relator");
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});
