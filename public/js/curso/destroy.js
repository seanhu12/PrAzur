$(document).ready(function () {
    /**
     * Enviar curso que se va a deshabilitar
     */
    window.deshabilitarCurso = function(id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Esta seguro que desea eliminar el curso?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/curso/destroy",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/curso");
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});