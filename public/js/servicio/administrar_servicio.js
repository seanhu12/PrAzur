$(document).ready(function () {

    $('#btn-mostrar-reanudar').click (function(e) {
        $('#modal-reanudar').modal('toggle');
    });

    function validarDatos() {
        var valido = true;
        if(!validarNoNulo(document.getElementById('fecha-ejecucion').value,'fecha-ejecucion')){
            valido = false;
        } else {
            if(!validarFechaNoPasada(document.getElementById('fecha-ejecucion').value,'fecha-ejecucion')){
                valido = false;
            }
        }
        return valido;
    }

    window.reanudar = function (servicioId) {
        // Validaciones de los datos
        if (!validarDatos()) {
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que desea detener el servicio?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/reanudar_servicio",
            data: {
                servicioId: servicioId,
                fecha_ejecucion: $('#fecha-ejecucion').val()
            },
            success: function(result) {
                // console.log('ajax reiniciar etapas ok');
                window.location.replace("/servicio");
            },
            error: function(xhr) {
                // console.log('ajax reiniciar etapas error');
            }
        });
    };

    window.detener = function (servicioId) {
        // Confirmacion de datos
        var respuesta = confirm("¿Está seguro que desea detener el servicio?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/detener_servicio",
            data: {
                servicioId: servicioId
            },
            success: function(result) {
                // console.log('ajax reiniciar etapas ok');
                window.location.replace("/servicio");
            },
            error: function(xhr) {
                // console.log('ajax reiniciar etapas error');
            }
        });
    };

    window.cancelar = function (servicioId) {
        // Confirmacion de datos
        var respuesta = confirm("¿Está seguro que desea cancelar el servicio?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/cancelar_servicio",
            data: {
                servicioId: servicioId
            },
            success: function(result) {
                // console.log('ajax reiniciar etapas ok');
                window.location.replace("/servicio");
            },
            error: function(xhr) {
                // console.log('ajax reiniciar etapas error');
            }
        });
    };

    window.reiniciarEtapas = function (servicioId) {
        // Confirmacion de datos
        var respuesta = confirm("¿Está seguro que desea reiniciar las etapas del servicio?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/reniciar_etapas",
            data: {
                servicioId: servicioId
            },
            success: function(result) {
                // console.log('ajax reiniciar etapas ok');
                window.location.replace("/servicio");
            },
            error: function(xhr) {
                // console.log('ajax reiniciar etapas error');
            }
        });
    };

});