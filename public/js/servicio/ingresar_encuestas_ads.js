$(document).ready(function () {

    function encuestaVacia(encuesta) {
        if (encuesta === '' || encuesta === null) {
            return true;
        }
        if (encuesta.r1 !== '' && encuesta.r1 !== null) {
            return false;
        }
        if (encuesta.r2 !== '' && encuesta.r2 !== null) {
            return false;
        }
        if (encuesta.r3 !== '' && encuesta.r3 !== null) {
            return false;
        }
        if (encuesta.r4 !== '' && encuesta.r4 !== null) {
            return false;
        }
        if (encuesta.r5 !== '' && encuesta.r5 !== null) {
            return false;
        }
        if (encuesta.r6 !== '' && encuesta.r6 !== null) {
            return false;
        }
        if (encuesta.r7 !== '' && encuesta.r7 !== null) {
            return false;
        }
        return true;
    }

    function valorValido(valor) {
        if (valor === null) {
            valor = '';
        }
        valorRegex = /^(1|2|3|4)?$/g;
        if (valorRegex.test(valor)) {
            return true;
        }
        return false;
    }

    function validarDatosIngresados() {
        // esconder los mensajes de validaciones
        document.getElementById('error-datos').hidden = true;
        document.getElementById('validacion-valor').hidden = true;
        document.getElementById('validacion-valor-ingresado').hidden = true;
        valido = true;
        data.forEach(encuesta => {
            if (!encuestaVacia(encuesta)) {
                // r1
                // validar no vacio
                if (encuesta.r1 == '' || encuesta.r1 === null) {
                    valido = false;
                    document.getElementById('validacion-valor-ingresado').hidden = false;
                } else {
                    // validar valor
                    if (!valorValido(encuesta.r1)) {
                        valido = false;
                        document.getElementById('validacion-valor').hidden = false;
                    }
                }
                // r2
                // validar no vacio
                if (encuesta.r2 == '' || encuesta.r2 === null) {
                    valido = false;
                    document.getElementById('validacion-valor-ingresado').hidden = false;
                } else {
                    // validar valor
                    if (!valorValido(encuesta.r2)) {
                        valido = false;
                        document.getElementById('validacion-valor').hidden = false;
                    }
                }
                // r3
                // validar no vacio
                if (encuesta.r3 == '' || encuesta.r3 === null) {
                    valido = false;
                    document.getElementById('validacion-valor-ingresado').hidden = false;
                } else {
                    // validar valor
                    if (!valorValido(encuesta.r3)) {
                        valido = false;
                        document.getElementById('validacion-valor').hidden = false;
                    }
                }
                // r4
                // validar no vacio
                if (encuesta.r4 == '' || encuesta.r4 === null) {
                    valido = false;
                    document.getElementById('validacion-valor-ingresado').hidden = false;
                } else {
                    // validar valor
                    if (!valorValido(encuesta.r4)) {
                        valido = false;
                        document.getElementById('validacion-valor').hidden = false;
                    }
                }
                // r5
                // validar no vacio
                if (encuesta.r5 == '' || encuesta.r5 === null) {
                    valido = false;
                    document.getElementById('validacion-valor-ingresado').hidden = false;
                } else {
                    // validar valor
                    if (!valorValido(encuesta.r5)) {
                        valido = false;
                        document.getElementById('validacion-valor').hidden = false;
                    }
                }
                // r6
                // validar no vacio
                if (encuesta.r6 == '' || encuesta.r6 === null) {
                    valido = false;
                    document.getElementById('validacion-valor-ingresado').hidden = false;
                } else {
                    // validar valor
                    if (!valorValido(encuesta.r6)) {
                        valido = false;
                        document.getElementById('validacion-valor').hidden = false;
                    }
                }
                // r7
                // validar no vacio
                if (encuesta.r7 == '' || encuesta.r7 === null) {
                    valido = false;
                    document.getElementById('validacion-valor-ingresado').hidden = false;
                } else {
                    // validar valor
                    if (!valorValido(encuesta.r7)) {
                        valido = false;
                        document.getElementById('validacion-valor').hidden = false;
                    }
                }
            }
        });
        if (!valido) {
            document.getElementById('error-datos').hidden = false;
        }
        return valido;
    }

    $('#btn-guardar').click (function() {
        document.getElementById('error-guardar-datos').hidden = true;
        // Validaciones de los datos
        if (!validarDatosIngresados()) {
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos están correctos?");
        // if(respuesta == false){
        //     return;
        // }
        // Mostrar indicador que se estan guardando los datos
        document.getElementById('guardando-datos').hidden = false;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/guardar_encuestas_ads",
            data: {
                servicio_id: servicioId,
                data: data
            },
            success: function(result) {
                // console.log('ajax datos ok');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('guardando-datos').hidden = true;
            },
            error: function(xhr) {
                // console.log('ajax datos error');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('guardando-datos').hidden = true;
                document.getElementById('error-guardar-datos').hidden = false;
            }
        });
    });

    function verificarEtapa() {
        if (etapa === 5) {
            return false;
        }
        return true;
    }

    var etapa = $('#data-tag-etapa').data('data');

    if (etapa !== 5) {
        document.getElementById('btn-guardar').hidden = true;
    }

    var servicioId = $('#data-tag-servicio-id').data('data');

    var data = $('#data-tag-encuestas').data('data');

    var container = document.getElementById('encuestas');
    var tablaEncuestas = new Handsontable(container, {
        data: data,
        rowHeaders: true,
        colHeaders: ['R1','R2','R3','R4','R5','R6','R7'],
        maxCols: 7,
        maxRows: 50,
        // filters: true,
        // dropdownMenu: true,
        // colWidths: 100,
        width: 400,
        // height: 614,
        height: 300,
        rowHeights: 23,
        columns: [
            {data: 'r1', readOnly: verificarEtapa()},
            {data: 'r2', readOnly: verificarEtapa()},
            {data: 'r3', readOnly: verificarEtapa()},
            {data: 'r4', readOnly: verificarEtapa()},
            {data: 'r5', readOnly: verificarEtapa()},
            {data: 'r6', readOnly: verificarEtapa()},
            {data: 'r7', readOnly: verificarEtapa()},
        ]
    });

});