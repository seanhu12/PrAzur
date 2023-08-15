$(document).ready(function () {

    /**
     * Habilitar sence cargado en notebook
     */
    function habilitarSenceNotebook() {
        // hablitar checkbox
        document.getElementById('logistica-listo-sence-notebook').disabled = false;
        document.getElementById('logistica-listo-sence-notebook-color').removeAttribute('class');
        document.getElementById('logistica-listo-sence-notebook-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-sence-notebook').style.color = '#495057';
        // habilitar codigo sence
        document.getElementById('codigo-sence').value = $('#data-tag-codigo-sence').data('data');
        // // habilitar certificado sence
        // document.getElementById('cierre-aplica-certificado-sence').checked = true;
        // habilitarCertificadoSenceCierre();
        // // habilitar oc
        // document.getElementById('cierre-aplica-oc').checked = true;
        // habilitarOCCierre();
    }

    /**
     * Deshabilitar sence cargado en notebook
     */
    function deshabilitarSenceNotebook() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-sence-notebook').disabled = true;
        document.getElementById('logistica-listo-sence-notebook').checked = false;
        document.getElementById('logistica-listo-sence-notebook-color').removeAttribute('class');
        document.getElementById('logistica-listo-sence-notebook-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-sence-notebook').style.color = 'grey';
        // deshabilitar codigo sence
        document.getElementById('codigo-sence').value = '';
        // // deshabilitar certificado sence
        // document.getElementById('cierre-aplica-certificado-sence').checked = false;
        // deshabilitarCertificadoSenceCierre();
        // // deshabilitar oc
        // document.getElementById('cierre-aplica-oc').checked = false;
        // deshabilitarOCCierre();
    }

    /**
     * Habilitar lector biometrico
     */
    function habilitarLectorBiometrico() {
        // hablitar checkbox
        document.getElementById('logistica-listo-lector-biometrico').disabled = false;
        document.getElementById('logistica-listo-lector-biometrico-color').removeAttribute('class');
        document.getElementById('logistica-listo-lector-biometrico-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-lector-biometrico').style.color = '#495057';
    }

    /**
     * Deshabilitar lector biometrico
     */
    function deshabilitarLectorBiometrico() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-lector-biometrico').disabled = true;
        document.getElementById('logistica-listo-lector-biometrico').checked = false;
        document.getElementById('logistica-listo-lector-biometrico-color').removeAttribute('class');
        document.getElementById('logistica-listo-lector-biometrico-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-lector-biometrico').style.color = 'grey';
    }

    /**
     * Habilitar reglamento sence
     */
    function habilitarReglamentoSence() {
        // hablitar checkbox
        document.getElementById('logistica-listo-reglamento-sence').disabled = false;
        document.getElementById('logistica-listo-reglamento-sence-color').removeAttribute('class');
        document.getElementById('logistica-listo-reglamento-sence-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-reglamento-sence').style.color = '#495057';
    }

    /**
     * Deshabilitar reglamento sence
     */
    function deshabilitarReglamentoSence() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-reglamento-sence').disabled = true;
        document.getElementById('logistica-listo-reglamento-sence').checked = false;
        document.getElementById('logistica-listo-reglamento-sence-color').removeAttribute('class');
        document.getElementById('logistica-listo-reglamento-sence-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-reglamento-sence').style.color = 'grey';
    }

    // Habilitar/deshabilitar sence cargado notebook
    $('#logistica-aplica-sence-notebook').change(function() {
        if (this.checked) {
            document.getElementById('logistica-aplica-lector-biometrico').checked = true;
            document.getElementById('logistica-aplica-reglamento-sence').checked = true;
            habilitarSenceNotebook();
            habilitarLectorBiometrico();
            habilitarReglamentoSence();
            habilitarLectorBiometricoCierre();
        } else {
            document.getElementById('logistica-aplica-lector-biometrico').checked = false;
            document.getElementById('logistica-aplica-reglamento-sence').checked = false;
            deshabilitarSenceNotebook();
            deshabilitarLectorBiometrico();
            deshabilitarReglamentoSence();
            deshabilitarLectorBiometricoCierre();
        }
        guardarDatos();
        guardarCierre();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar sence cargado notebook
    $('#logistica-aplica-lector-biometrico').change(function() {
        if (this.checked) {
            document.getElementById('logistica-aplica-sence-notebook').checked = true;
            document.getElementById('logistica-aplica-reglamento-sence').checked = true;
            habilitarSenceNotebook();
            habilitarLectorBiometrico();
            habilitarReglamentoSence();
            habilitarLectorBiometricoCierre();
        } else {
            document.getElementById('logistica-aplica-sence-notebook').checked = false;
            document.getElementById('logistica-aplica-reglamento-sence').checked = false;
            deshabilitarSenceNotebook();
            deshabilitarLectorBiometrico();
            deshabilitarReglamentoSence();
            deshabilitarLectorBiometricoCierre();
        }
        guardarDatos();
        guardarCierre();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar sence cargado notebook
    $('#logistica-aplica-reglamento-sence').change(function() {
        if (this.checked) {
            document.getElementById('logistica-aplica-sence-notebook').checked = true;
            document.getElementById('logistica-aplica-lector-biometrico').checked = true;
            habilitarSenceNotebook();
            habilitarLectorBiometrico();
            habilitarReglamentoSence();
            habilitarLectorBiometricoCierre();
        } else {
            document.getElementById('logistica-aplica-sence-notebook').checked = false;
            document.getElementById('logistica-aplica-lector-biometrico').checked = false;
            deshabilitarSenceNotebook();
            deshabilitarLectorBiometrico();
            deshabilitarReglamentoSence();
            deshabilitarLectorBiometricoCierre();
        }
        guardarDatos();
        guardarCierre();
        guardarRecepcionCierre();
    });

    $('#logistica-listo-sence-notebook').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-lector-biometrico').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-reglamento-sence').change (function() {
        guardarDatos();
    });

    /**
     * Envia los datos de la coordinacion para guardarlos en la bd
     */
    function guardarDatos() {
        document.getElementById('logistica-sence-error-guardar-datos').hidden = true;
        // Mostrar indicador que se estan guardando los datos
        document.getElementById('logistica-sence-guardando-datos').hidden = false;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/guardar_logistica_sence_checklist",
            data: {
                id: $('#servicio-id').data('data'),
                sence_id_cargado_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-sence-notebook').checked),
                sence_id_cargado_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-sence-notebook').checked),
                verificar_lector_bio_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-lector-biometrico').checked),
                verificar_lector_bio_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-lector-biometrico').checked),
                reglamento_sence_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-reglamento-sence').checked),
                reglamento_sence_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-reglamento-sence').checked),
                sence_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-sence-notebook').checked),
            },
            success: function(result) {
                // console.log('ajax datos ok');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('logistica-sence-guardando-datos').hidden = true;
            },
            error: function(xhr) {
                // console.log('ajax datos error');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('logistica-sence-guardando-datos').hidden = true;
                document.getElementById('logistica-sence-error-guardar-datos').hidden = false;
            }
        });
    }


    /**
     * Deshabilita los campos de ingreso de datos
     */
    window.deshabilitarSence = function() {
        // sence notebook
        // aplica
        this.document.getElementById('logistica-aplica-sence-notebook').disabled = true;
        this.document.getElementById('logistica-aplica-sence-notebook-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-sence-notebook-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-sence-notebook').disabled = true;
        this.document.getElementById('logistica-listo-sence-notebook-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-sence-notebook-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // lector biometrico
        // aplica
        this.document.getElementById('logistica-aplica-lector-biometrico').disabled = true;
        this.document.getElementById('logistica-aplica-lector-biometrico-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-lector-biometrico-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-lector-biometrico').disabled = true;
        this.document.getElementById('logistica-listo-lector-biometrico-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-lector-biometrico-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // reglamento sence
        // aplica
        this.document.getElementById('logistica-aplica-reglamento-sence').disabled = true;
        this.document.getElementById('logistica-aplica-reglamento-sence-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-reglamento-sence-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-reglamento-sence').disabled = true;
        this.document.getElementById('logistica-listo-reglamento-sence-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-reglamento-sence-color').setAttribute('class','colorinput-color bg-cyan-lighter');
    }

    var checkSence = $('#data-tag-check-sence').data('data');

    var senceAplica = $('#data-tag-aplica-sence').data('data');

    // Cargar los listos de la bd
    if (checkSence.sence_id_cargado_listo === 1) {
        document.getElementById('logistica-listo-sence-notebook').checked = true;
    }

    if (checkSence.verificar_lector_bio_listo === 1) {
        document.getElementById('logistica-listo-lector-biometrico').checked = true;
    }

    if (checkSence.reglamento_sence_listo === 1) {
        document.getElementById('logistica-listo-reglamento-sence').checked = true;
    }

    // Verificar si sence esta deshabilitado
    if (senceAplica === 1) {
        document.getElementById('logistica-aplica-sence-notebook').checked = true;
        document.getElementById('logistica-aplica-lector-biometrico').checked = true;
        document.getElementById('logistica-aplica-reglamento-sence').checked = true;
        habilitarSenceNotebook();
        habilitarLectorBiometrico();
        habilitarReglamentoSence();
        habilitarLectorBiometricoCierre();
    } else {
        document.getElementById('logistica-aplica-sence-notebook').checked = false;
        document.getElementById('logistica-aplica-lector-biometrico').checked = false;
        document.getElementById('logistica-aplica-reglamento-sence').checked = false;
        deshabilitarSenceNotebook();
        deshabilitarLectorBiometrico();
        deshabilitarReglamentoSence();
        deshabilitarLectorBiometricoCierre();
    }

});