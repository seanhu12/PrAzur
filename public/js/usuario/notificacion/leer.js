$(document).ready(function () {
    /**
     * Enviar notificacion que se va a leer
     */
    window.leer = function(id, direccion) {
        // Confirmacion de datos
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/usuario/leer_notificacion",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace(direccion);
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };

    /**
     * Enviar notificaciones que se van a leer
     */
    window.leerTodas = function(id, notificaciones) {
        // Confirmacion de datos
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/usuario/leer_varias_notificaciones",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                // window.document.getElementById('sin-leer').hidden = true;
                notificaciones = JSON.parse(notificaciones);
                notificaciones.forEach(notificacion => {
                    notificacionTexto = document.getElementById('notificacion-mensaje-' + notificacion.id);
                    notificacionTextoNoLeida = notificacionTexto.innerHTML;
                    notificacionTextoLeida = notificacionTextoNoLeida.replace('\<strong\>','').replace('\<\/strong\>','');
                    notificacionTexto.innerHTML = notificacionTextoLeida;
                });
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };
});
