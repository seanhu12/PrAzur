$(document).ready(function () {
    /**
     * Enviar temática que se va a deshabilitar
     */
    window.deshabilitarTematica = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar la Temática?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/tematica/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/tematica");
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});