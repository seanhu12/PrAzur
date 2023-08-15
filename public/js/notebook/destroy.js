$(document).ready(function () {
    /**
     * Enviar notebook que se va a deshabilitar
     */
    window.deshabilitarNotebook = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar el notebook?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/notebook/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/notebook");
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});
