$(document).ready(function() {

    /**
     * Enviar notificacion que se va a leer
     */
    window.leerEnLista = function(id, direccion) {
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
                location.reload();
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };

    /**
     * Enviar notificaciones que se van a leer
     */
    window.leerTodasEnLista = function(id, notificaciones) {
        // Confirmacion de datos
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/usuario/leer_todas_notificaciones",
            data: {
                id: id
            },
            success: function(result) {
                // console.log('ajax ok');
                location.reload();
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };

    /**
     * Enviar notificacion que se va a deshabilitar
     */
    window.deshabilitarNotificacionEnLista = function(id) {
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
                location.reload();
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };

    /**
     * Cambiar color table header
     */
    $('tr').each(function(){
        $(this).find('th').addClass('blue');
    })

    /**
     * Dynatable
     */
    var dynatable = $('#tabla')
    .dynatable({
        features: {
            paginate: true,
            recordCount: true,
            sorting: true,
            search: true,
            perPageSelect: true
        }
    }).data('dynatable');
});