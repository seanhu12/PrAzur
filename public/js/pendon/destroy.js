$(document).ready(function () {
    /**
     * Enviar pendón que se va a deshabilitar
     */
    window.deshabilitarPendon = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar el pendón?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/pendon/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/pendon");
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});