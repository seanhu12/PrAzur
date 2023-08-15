$(document).ready(function () {
    /**
     * Enviar oc que se va a deshabilitar
     */
    window.deshabilitarOrdenCompra = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar la Orden de Compra?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/orden_compra/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/orden_compra/"+result);
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});
