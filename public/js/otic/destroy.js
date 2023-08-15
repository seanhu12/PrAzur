$(document).ready(function () {
    /**
     * Enviar otic que se va a deshabilitar
     */
    window.deshabilitarOtic = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar la OTIC?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/otic/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/otic");
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});
