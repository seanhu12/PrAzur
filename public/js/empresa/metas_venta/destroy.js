$(document).ready(function () {
    /**
     * Enviar meta de venta que se va a deshabilitar
     */
    window.deshabilitarMetaVenta = function(idMeta,idEmpresa) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar la Meta de Venta?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/metas_venta/destroy_meta",
            data: {
                id: idMeta
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/metas_venta/"+idEmpresa);
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});