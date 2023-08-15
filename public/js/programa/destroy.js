$(document).ready(function () {
    /**
     * Enviar programa que se va a deshabilitar
     */
    window.deshabilitarPrograma = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar el programa?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/programa/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/programa");
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});
