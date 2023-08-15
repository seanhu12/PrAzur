$(document).ready(function () {
    /**
     * Enviar contacto empresa que se va a deshabilitar
     */
    window.deshabilitarContactoEmpresa = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar la el Contacto de la Empresa?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/contacto_empresa/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/contacto_empresa");
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});