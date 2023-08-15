$(document).ready(function () {
    /**
     * Enviar proyector que se va a deshabilitar
     */
    window.deshabilitarProyector = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar el proyector?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/proyector/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/proyector");
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});