$(document).ready(function () {
    /**
     * Enviar usuario que se va a deshabilitar
     */
    window.eliminarPropuesta = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar la propuesta?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/propuesta/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/propuesta");
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});