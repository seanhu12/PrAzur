$(document).ready(function () {
    /**
     * Enviar empresa que se va a deshabilitar
     */
    window.deshabilitarEmpresa = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar la empresa?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/empresa/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/empresa");
            },
            error: function(xhr) {
                // console.log('ajax error');
                // console.log(xhr);
            }
        });
    };
});