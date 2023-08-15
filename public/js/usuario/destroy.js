$(document).ready(function () {
    /**
     * Enviar usuario que se va a deshabilitar
     */
    window.eliminarUsuario = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar el usuario?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/usuario/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/usuario");
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});