$(document).ready(function () {

    $('#logistica-horario-am-coffee').mask('00:00 a 00:00');

    $('#logistica-horario-pm-coffee').mask('00:00 a 00:00');

    $('#logistica-horario-almuerzo').mask('00:00 a 00:00');

    /**
     * Habilitar coffee
     */
    function habilitarCoffee() {
        // hablitar checkbox
        document.getElementById('logistica-listo-coffee').disabled = false;
        document.getElementById('logistica-listo-coffee-color').removeAttribute('class');
        document.getElementById('logistica-listo-coffee-color').setAttribute('class','colorinput-color bg-cyan');
        // habilitar inputs
        document.getElementById('logistica-horario-am-coffee').removeAttribute('readonly');
        document.getElementById('logistica-horario-pm-coffee').removeAttribute('readonly');
        // cambiar color labels
        document.getElementById('logistica-text-coffee').style.color = '#495057';
        document.getElementById('logistica-text-horario-coffee-am').style.color = '#495057';
        document.getElementById('logistica-text-horario-coffee-pm').style.color = '#495057';
    }

    /**
     * Deshabilitar coffee
     */
    function deshabilitarCoffee() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-coffee').disabled = true;
        document.getElementById('logistica-listo-coffee').checked = false;
        document.getElementById('logistica-listo-coffee-color').removeAttribute('class');
        document.getElementById('logistica-listo-coffee-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // deshabilitar inputs
        document.getElementById('logistica-horario-am-coffee').setAttribute('readonly','');
        document.getElementById('logistica-horario-am-coffee').value = '';
        document.getElementById('logistica-horario-pm-coffee').setAttribute('readonly','');
        document.getElementById('logistica-horario-pm-coffee').value = '';
        // cambiar color labels
        document.getElementById('logistica-text-coffee').style.color = 'grey';
        document.getElementById('logistica-text-horario-coffee-am').style.color = 'grey';
        document.getElementById('logistica-text-horario-coffee-pm').style.color = 'grey';
    }

    /**
     * Habilitar almuerzo
     */
    function habilitarAlmuerzo() {
        // hablitar checkbox
        document.getElementById('logistica-listo-almuerzo').disabled = false;
        document.getElementById('logistica-listo-almuerzo-color').removeAttribute('class');
        document.getElementById('logistica-listo-almuerzo-color').setAttribute('class','colorinput-color bg-cyan');
        // habilitar inputs
        document.getElementById('logistica-horario-almuerzo').removeAttribute('readonly');
        // cambiar color labels
        document.getElementById('logistica-text-almuerzo').style.color = '#495057';
    }

    /**
     * Deshabilitar almuerzo
     */
    function deshabilitarAlmuerzo() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-almuerzo').disabled = true;
        document.getElementById('logistica-listo-almuerzo').checked = false;
        document.getElementById('logistica-listo-almuerzo-color').removeAttribute('class');
        document.getElementById('logistica-listo-almuerzo-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // deshabilitar inputs
        document.getElementById('logistica-horario-almuerzo').setAttribute('readonly','');
        document.getElementById('logistica-horario-almuerzo').value = '';
        // cambiar color labels
        document.getElementById('logistica-text-almuerzo').style.color = 'grey';
    }

    // Habilitar/deshabilitar coffee
    $('#logistica-aplica-coffee').change(function() {
        if (this.checked) {
            habilitarCoffee();
        } else {
            deshabilitarCoffee();
        }
        guardarDatos();
    });

    // Habilitar/deshabilitar almuerzo
    $('#logistica-aplica-almuerzo').change(function() {
        if (this.checked) {
            habilitarAlmuerzo();
        } else {
            deshabilitarAlmuerzo();
        }
        guardarDatos();
    });

    $('#logistica-listo-sala').change (function() {
        document.getElementById('logistica-coordinacion-validacion-listo').hidden = true;
        if (this.checked) {
            if (document.getElementById('salon').value === '') {
                this.checked = false;
                document.getElementById('logistica-coordinacion-validacion-listo-text').innerText = 'Se debe ingresar la sala.';
                document.getElementById('logistica-coordinacion-validacion-listo').hidden = false;
                return;
            }
        }
        guardarDatos();
    });

    $('#logistica-listo-coffee').change (function() {
        document.getElementById('logistica-coordinacion-validacion-listo').hidden = true;
        if (this.checked) {
            if (document.getElementById('logistica-horario-am-coffee').value === '' && document.getElementById('logistica-horario-pm-coffee').value === '') {
                this.checked = false;
                document.getElementById('logistica-coordinacion-validacion-listo-text').innerText = 'Se debe ingresar un horario del coffee.';
                document.getElementById('logistica-coordinacion-validacion-listo').hidden = false;
                return;
            }
        }
        guardarDatos();
    });

    $('#logistica-listo-almuerzo').change (function() {
        document.getElementById('logistica-coordinacion-validacion-listo').hidden = true;
        if (this.checked) {
            if (document.getElementById('logistica-horario-almuerzo').value === '') {
                this.checked = false;
                document.getElementById('logistica-coordinacion-validacion-listo-text').innerText = 'Se debe ingresar el horario del almuerzo.';
                document.getElementById('logistica-coordinacion-validacion-listo').hidden = false;
                return;
            }
        }
        guardarDatos();
    });

    $('#logistica-listo-nomina-participantes').change (function() {
        document.getElementById('logistica-coordinacion-validacion-listo').hidden = true;
        if (this.checked) {
            if ($('#data-tag-hay-participantes').data('data') === 0) {
                this.checked = false;
                document.getElementById('logistica-coordinacion-validacion-listo-text').innerText = 'Se debe ingresar los participantes.';
                document.getElementById('logistica-coordinacion-validacion-listo').hidden = false;
                return;
            }
        }
        guardarDatos();
    });

    $('#salon').change (function() {
        guardarDatos();
    });

    $('#logistica-horario-am-coffee').change (function() {
        guardarDatos();
    });

    $('#logistica-horario-pm-coffee').change (function() {
        guardarDatos();
    });

    $('#logistica-horario-almuerzo').change (function() {
        guardarDatos();
    });

    $('#logistica-btn-nomina-participantes').click (function(e) {
        location.reload();
    });

    /**
     * Valida que los datos ingresados cumplan con sus restricciones
     */
    function validarDatos() {
        var valido = true;
        if(!validarHorario(document.getElementById('logistica-horario-am-coffee').value,'logistica-horario-am-coffee')){
            valido = false;
        }
        if(!validarHorario(document.getElementById('logistica-horario-pm-coffee').value,'logistica-horario-pm-coffee')){
            valido = false;
        }
        if(!validarHorario(document.getElementById('logistica-horario-almuerzo').value,'logistica-horario-almuerzo')){
            valido = false;
        }
        return valido;
    }

    /**
     * Envia los datos de la coordinacion para guardarlos en la bd
     */
    function guardarDatos() {
        document.getElementById('logistica-coordinacion-validacion-listo').hidden = true;
        document.getElementById('logistica-coordinacion-validacion-guardar-datos').hidden = true;
        document.getElementById('logistica-coordinacion-error-guardar-datos').hidden = true;
        // Validar los datos
        if (!validarDatos()) {
            document.getElementById('logistica-coordinacion-validacion-guardar-datos').hidden = false;
            return;
        }
        // Mostrar indicador que se estan guardando los datos
        document.getElementById('logistica-coordinacion-guardando-datos').hidden = false;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/guardar_logistica_coordinacion_checklist",
            data: {
                id: $('#servicio-id').data('data'),
                coffee_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-coffee').checked),
                almuerzo_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-almuerzo').checked),
                coordinar_sala_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-sala').checked),
                coffee_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-coffee').checked),
                almuerzo_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-almuerzo').checked),
                nomina_participantes_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-nomina-participantes').checked),
                salon: document.getElementById('salon').value,
                horario_coffee_am: document.getElementById('logistica-horario-am-coffee').value,
                horario_coffee_pm: document.getElementById('logistica-horario-pm-coffee').value,
                horario_almuerzo: document.getElementById('logistica-horario-almuerzo').value,
            },
            success: function(result) {
                // console.log('ajax datos ok');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('logistica-coordinacion-guardando-datos').hidden = true;
            },
            error: function(xhr) {
                // console.log('ajax datos error');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('logistica-coordinacion-guardando-datos').hidden = true;
                document.getElementById('logistica-coordinacion-error-guardar-datos').hidden = false;
            }
        });
    }


    /**
     * Deshabilita los campos de ingreso de datos
     */
    window.deshabilitarCoordinacion = function() {
        // sala
        // aplica
        this.document.getElementById('logistica-aplica-sala').disabled = true;
        this.document.getElementById('logistica-aplica-sala-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-sala-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-sala').disabled = true;
        this.document.getElementById('logistica-listo-sala-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-sala-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // input
        this.document.getElementById('salon').setAttribute('readonly','');
        // coffee
        // aplica
        this.document.getElementById('logistica-aplica-coffee').disabled = true;
        this.document.getElementById('logistica-aplica-coffee-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-coffee-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-coffee').disabled = true;
        this.document.getElementById('logistica-listo-coffee-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-coffee-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // input
        this.document.getElementById('logistica-horario-am-coffee').setAttribute('readonly','');
        this.document.getElementById('logistica-horario-pm-coffee').setAttribute('readonly','');
        // almuerzo
        // aplica
        this.document.getElementById('logistica-aplica-almuerzo').disabled = true;
        this.document.getElementById('logistica-aplica-almuerzo-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-almuerzo-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-almuerzo').disabled = true;
        this.document.getElementById('logistica-listo-almuerzo-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-almuerzo-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // input
        this.document.getElementById('logistica-horario-almuerzo').setAttribute('readonly','');
        // nomina participantes
        // aplica
        this.document.getElementById('logistica-aplica-nomina-participantes').disabled = true;
        this.document.getElementById('logistica-aplica-nomina-participantes-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-nomina-participantes-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-nomina-participantes').disabled = true;
        this.document.getElementById('logistica-listo-nomina-participantes-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-nomina-participantes-color').setAttribute('class','colorinput-color bg-cyan-lighter');
    }

    var checkCoordinacion = $('#data-tag-check-coordinacion').data('data');

    if (checkCoordinacion.coordinar_sala_listo === 1) {
        document.getElementById('logistica-listo-sala').checked = true;
    }

    if (checkCoordinacion.coffee_listo === 1) {
        document.getElementById('logistica-listo-coffee').checked = true;
    }

    if (checkCoordinacion.almuerzo_listo === 1) {
        document.getElementById('logistica-listo-almuerzo').checked = true;
    }

    if (checkCoordinacion.nomina_participantes_listo === 1) {
        document.getElementById('logistica-listo-nomina-participantes').checked = true;
    }

    // Verificar si el coffee esta deshabilitado
    if (checkCoordinacion.coffee_aplica === 1) {
        document.getElementById('logistica-aplica-coffee').checked = true;
        habilitarCoffee();
    } else {
        document.getElementById('logistica-aplica-coffee').checked = false;
        deshabilitarCoffee();
    }

    // Verificar si el almuerzo esta deshabilitado
    if (checkCoordinacion.almuerzo_aplica === 1) {
        document.getElementById('logistica-aplica-almuerzo').checked = true;
        habilitarAlmuerzo();
    } else {
        document.getElementById('logistica-aplica-almuerzo').checked = false;
        deshabilitarAlmuerzo();
    }

});