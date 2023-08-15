$(document).ready(function () {

    /**
     * Habilitar parlante
     */
    function habilitarParlante() {
        // hablitar checkbox
        document.getElementById('logistica-listo-parlante').disabled = false;
        document.getElementById('logistica-listo-parlante-color').removeAttribute('class');
        document.getElementById('logistica-listo-parlante-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-parlante').style.color = '#495057';
    }

    /**
     * Deshabilitar parlante
     */
    function deshabilitarParlante() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-parlante').disabled = true;
        document.getElementById('logistica-listo-parlante').checked = false;
        document.getElementById('logistica-listo-parlante-color').removeAttribute('class');
        document.getElementById('logistica-listo-parlante-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-parlante').style.color = 'grey';
    }

    /**
     * Habilitar atril
     */
    function habilitarAtril() {
        // hablitar checkbox
        document.getElementById('logistica-listo-atril').disabled = false;
        document.getElementById('logistica-listo-atril-color').removeAttribute('class');
        document.getElementById('logistica-listo-atril-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-atril').style.color = '#495057';
    }

    /**
     * Deshabilitar atril
     */
    function deshabilitarAtril() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-atril').disabled = true;
        document.getElementById('logistica-listo-atril').checked = false;
        document.getElementById('logistica-listo-atril-color').removeAttribute('class');
        document.getElementById('logistica-listo-atril-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-atril').style.color = 'grey';
    }

    /**
     * Habilitar alargador
     */
    function habilitarAlargador() {
        // hablitar checkbox
        document.getElementById('logistica-listo-alargador').disabled = false;
        document.getElementById('logistica-listo-alargador-color').removeAttribute('class');
        document.getElementById('logistica-listo-alargador-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-alargador').style.color = '#495057';
    }

    /**
     * Deshabilitar alargador
     */
    function deshabilitarAlargador() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-alargador').disabled = true;
        document.getElementById('logistica-listo-alargador').checked = false;
        document.getElementById('logistica-listo-alargador-color').removeAttribute('class');
        document.getElementById('logistica-listo-alargador-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-alargador').style.color = 'grey';
    }

    /**
     * Habilitar foco
     */
    function habilitarFoco() {
        // hablitar checkbox
        document.getElementById('logistica-listo-foco').disabled = false;
        document.getElementById('logistica-listo-foco-color').removeAttribute('class');
        document.getElementById('logistica-listo-foco-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-foco').style.color = '#495057';
    }

    /**
     * Deshabilitar foco
     */
    function deshabilitarFoco() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-foco').disabled = true;
        document.getElementById('logistica-listo-foco').checked = false;
        document.getElementById('logistica-listo-foco-color').removeAttribute('class');
        document.getElementById('logistica-listo-foco-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-foco').style.color = 'grey';
    }

    /**
     * Habilitar microfono cintillo
     */
    function habilitarMicrofonoCintillo() {
        // hablitar checkbox
        document.getElementById('logistica-listo-microfono-cintillo').disabled = false;
        document.getElementById('logistica-listo-microfono-cintillo-color').removeAttribute('class');
        document.getElementById('logistica-listo-microfono-cintillo-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-microfono-cintillo').style.color = '#495057';
    }

    /**
     * Deshabilitar microfono cintillo
     */
    function deshabilitarMicrofonoCintillo() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-microfono-cintillo').disabled = true;
        document.getElementById('logistica-listo-microfono-cintillo').checked = false;
        document.getElementById('logistica-listo-microfono-cintillo-color').removeAttribute('class');
        document.getElementById('logistica-listo-microfono-cintillo-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-microfono-cintillo').style.color = 'grey';
    }

    /**
     * Habilitar microfono inalambrico
     */
    function habilitarMicrofonoInalambrico() {
        // hablitar checkbox
        document.getElementById('logistica-listo-microfono-inalambrico').disabled = false;
        document.getElementById('logistica-listo-microfono-inalambrico-color').removeAttribute('class');
        document.getElementById('logistica-listo-microfono-inalambrico-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-microfono-inalambrico').style.color = '#495057';
    }

    /**
     * Deshabilitar microfono inalambrico
     */
    function deshabilitarMicrofonoInalambrico() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-microfono-inalambrico').disabled = true;
        document.getElementById('logistica-listo-microfono-inalambrico').checked = false;
        document.getElementById('logistica-listo-microfono-inalambrico-color').removeAttribute('class');
        document.getElementById('logistica-listo-microfono-inalambrico-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-microfono-inalambrico').style.color = 'grey';
    }

    // Habilitar/deshabilitar parlante
    $('#logistica-aplica-parlante').change(function() {
        if (this.checked) {
            habilitarParlante();
            habilitarParlanteCierre();
        } else {
            deshabilitarParlante();
            deshabilitarParlanteCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar atril
    $('#logistica-aplica-atril').change(function() {
        if (this.checked) {
            habilitarAtril();
            habilitarAtrilCierre();
        } else {
            deshabilitarAtril();
            deshabilitarAtrilCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar alargador
    $('#logistica-aplica-alargador').change(function() {
        if (this.checked) {
            habilitarAlargador();
            habilitarAlargadorCierre();
        } else {
            deshabilitarAlargador();
            deshabilitarAlargadorCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar foco
    $('#logistica-aplica-foco').change(function() {
        if (this.checked) {
            habilitarFoco();
            habilitarFocoCierre();
        } else {
            deshabilitarFoco();
            deshabilitarFocoCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar microfono cintillo
    $('#logistica-aplica-microfono-cintillo').change(function() {
        if (this.checked) {
            habilitarMicrofonoCintillo();
            habilitarMicrofonoCintilloCierre();
        } else {
            deshabilitarMicrofonoCintillo();
            deshabilitarMicrofonoCintilloCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar microfono inalambrico
    $('#logistica-aplica-microfono-inalambrico').change(function() {
        if (this.checked) {
            habilitarMicrofonoInalambrico();
            habilitarMicrofonoInalambricoCierre();
        } else {
            deshabilitarMicrofonoInalambrico();
            deshabilitarMicrofonoInalambricoCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    $('#logistica-listo-parlante').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-atril').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-alargador').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-foco').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-microfono-cintillo').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-microfono-inalambrico').change (function() {
        guardarDatos();
    });

    $('#logistica-audio-iluminacion-otros').change (function() {
        guardarDatos();
    });

    /**
     * Envia los datos de la coordinacion para guardarlos en la bd
     */
    function guardarDatos() {
        document.getElementById('logistica-audio-iluminacion-error-guardar-datos').hidden = true;
        // Mostrar indicador que se estan guardando los datos
        document.getElementById('logistica-audio-iluminacion-guardando-datos').hidden = false;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/guardar_logistica_audio_iluminacion_checklist",
            data: {
                id: $('#servicio-id').data('data'),
                parlantes_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-parlante').checked),
                parlantes_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-parlante').checked),
                atril_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-atril').checked),
                atril_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-atril').checked),
                alargador_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-alargador').checked),
                alargador_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-alargador').checked),
                foco_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-foco').checked),
                foco_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-foco').checked),
                microfono_cintillo_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-microfono-cintillo').checked),
                microfono_cintillo_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-microfono-cintillo').checked),
                microfono_inalambrico_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-microfono-inalambrico').checked),
                microfono_inalambrico_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-microfono-inalambrico').checked),
                otros: document.getElementById('logistica-audio-iluminacion-otros').value
            },
            success: function(result) {
                // console.log('ajax datos ok');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('logistica-audio-iluminacion-guardando-datos').hidden = true;
            },
            error: function(xhr) {
                // console.log('ajax datos error');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('logistica-audio-iluminacion-guardando-datos').hidden = true;
                document.getElementById('logistica-audio-iluminacion-error-guardar-datos').hidden = false;
            }
        });
    }


    /**
     * Deshabilita los campos de ingreso de datos
     */
    window.deshabilitarAudioIluminacion = function() {
        // parlante
        // aplica
        this.document.getElementById('logistica-aplica-parlante').disabled = true;
        this.document.getElementById('logistica-aplica-parlante-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-parlante-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-parlante').disabled = true;
        this.document.getElementById('logistica-listo-parlante-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-parlante-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // atril
        // aplica
        this.document.getElementById('logistica-aplica-atril').disabled = true;
        this.document.getElementById('logistica-aplica-atril-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-atril-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-atril').disabled = true;
        this.document.getElementById('logistica-listo-atril-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-atril-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // alarador
        // aplica
        this.document.getElementById('logistica-aplica-alargador').disabled = true;
        this.document.getElementById('logistica-aplica-alargador-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-alargador-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-alargador').disabled = true;
        this.document.getElementById('logistica-listo-alargador-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-alargador-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // foco
        // aplica
        this.document.getElementById('logistica-aplica-foco').disabled = true;
        this.document.getElementById('logistica-aplica-foco-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-foco-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-foco').disabled = true;
        this.document.getElementById('logistica-listo-foco-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-foco-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // microfono cintillo
        // aplica
        this.document.getElementById('logistica-aplica-microfono-cintillo').disabled = true;
        this.document.getElementById('logistica-aplica-microfono-cintillo-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-microfono-cintillo-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-microfono-cintillo').disabled = true;
        this.document.getElementById('logistica-listo-microfono-cintillo-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-microfono-cintillo-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // microfono inalambrico
        // aplica
        this.document.getElementById('logistica-aplica-microfono-inalambrico').disabled = true;
        this.document.getElementById('logistica-aplica-microfono-inalambrico-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-microfono-inalambrico-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-microfono-inalambrico').disabled = true;
        this.document.getElementById('logistica-listo-microfono-inalambrico-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-microfono-inalambrico-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // otros
        this.document.getElementById('logistica-audio-iluminacion-otros').setAttribute('readonly','');
    }

    var checkAudioIluminacion = $('#data-tag-check-audio-iluminacion').data('data');

    // Cargar los listos de la bd
    if (checkAudioIluminacion.parlantes_listo === 1) {
        document.getElementById('logistica-listo-parlante').checked = true;
    }

    if (checkAudioIluminacion.atril_listo === 1) {
        document.getElementById('logistica-listo-atril').checked = true;
    }

    if (checkAudioIluminacion.alargador_listo === 1) {
        document.getElementById('logistica-listo-alargador').checked = true;
    }

    if (checkAudioIluminacion.foco_listo === 1) {
        document.getElementById('logistica-listo-foco').checked = true;
    }

    if (checkAudioIluminacion.microfono_cintillo_listo === 1) {
        document.getElementById('logistica-listo-microfono-cintillo').checked = true;
    }

    if (checkAudioIluminacion.microfono_inalambrico_listo === 1) {
        document.getElementById('logistica-listo-microfono-inalambrico').checked = true;
    }

    // Verificar si parlante esta deshabilitado
    if (checkAudioIluminacion.parlantes_aplica === 1) {
        document.getElementById('logistica-aplica-parlante').checked = true;
        habilitarParlante();
        habilitarParlanteCierre();
    } else {
        document.getElementById('logistica-aplica-parlante').checked = false;
        deshabilitarParlante();
        deshabilitarParlanteCierre();
    }

    // Verificar si atril esta deshabilitado
    if (checkAudioIluminacion.atril_aplica === 1) {
        document.getElementById('logistica-aplica-atril').checked = true;
        habilitarAtril();
        habilitarAtrilCierre();
    } else {
        document.getElementById('logistica-aplica-atril').checked = false;
        deshabilitarAtril();
        deshabilitarAtrilCierre();
    }

    // Verificar si alargador esta deshabilitado
    if (checkAudioIluminacion.alargador_aplica === 1) {
        document.getElementById('logistica-aplica-alargador').checked = true;
        habilitarAlargador();
        habilitarAlargadorCierre();
    } else {
        document.getElementById('logistica-aplica-alargador').checked = false;
        deshabilitarAlargador();
        deshabilitarAlargadorCierre();
    }

    // Verificar si foco esta deshabilitado
    if (checkAudioIluminacion.foco_aplica === 1) {
        document.getElementById('logistica-aplica-foco').checked = true;
        habilitarFoco();
        habilitarFocoCierre();
    } else {
        document.getElementById('logistica-aplica-foco').checked = false;
        deshabilitarFoco();
        deshabilitarFocoCierre();
    }

    // Verificar si microfono cintillo esta deshabilitado
    if (checkAudioIluminacion.microfono_cintillo_aplica === 1) {
        document.getElementById('logistica-aplica-microfono-cintillo').checked = true;
        habilitarMicrofonoCintillo();
        habilitarMicrofonoCintilloCierre();
    } else {
        document.getElementById('logistica-aplica-microfono-cintillo').checked = false;
        deshabilitarMicrofonoCintillo();
        deshabilitarMicrofonoCintilloCierre();
    }

    // Verificar si microfono inalambrico esta deshabilitado
    if (checkAudioIluminacion.microfono_inalambrico_aplica === 1) {
        document.getElementById('logistica-aplica-microfono-inalambrico').checked = true;
        habilitarMicrofonoInalambrico();
        habilitarMicrofonoInalambricoCierre();
    } else {
        document.getElementById('logistica-aplica-microfono-inalambrico').checked = false;
        deshabilitarMicrofonoInalambrico();
        deshabilitarMicrofonoInalambricoCierre();
    }

});