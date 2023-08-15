$(document).ready(function () {
    /**
     * Enviar notificacion que se va a deshabilitar
     */
    window.deshabilitarNotificacion = function(id) {
        // Confirmacion de datos
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/usuario/destroy_notificacion",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.document.getElementById('notificacion-' + id).outerHTML = '';
                // window.document.getElementById('notificacion-' + id).href = '';
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});
