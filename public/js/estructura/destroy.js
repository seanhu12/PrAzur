$(document).ready(function () {
    /**
     * Enviar documento que se va a deshabilitar
     */
    window.deshabilitarEstructura = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar la estructura?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/estructura/destroy_estructura",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/estructura/"+result);
            },
            error: function(xhr) {
                // console.log(xhr);
            }
        });
    };
});
