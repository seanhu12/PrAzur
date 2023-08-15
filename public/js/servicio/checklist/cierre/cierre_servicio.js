$(document).ready(function () {

    /**
     * Habilitar certificado sence
     */
    function habilitarCertificadoSence() {
        // hablitar checkbox
        document.getElementById('cierre-listo-certificado-sence').disabled = false;
        document.getElementById('cierre-listo-certificado-sence-color').removeAttribute('class');
        document.getElementById('cierre-listo-certificado-sence-color').setAttribute('class','colorinput-color bg-cyan');
        // habilitar inputs
        document.getElementById('numero-certificado-sence').removeAttribute('readonly');
        // habilitar botones
        document.getElementById('btn-cierre-archivo-certificado-sence').disabled = false;
        // cambiar color labels
        document.getElementById('cierre-text-certificado-sence').style.color = '#495057';
    }

    /**
     * Habilitar certificado sence desde otros js
     */
    window.habilitarCertificadoSenceCierre = function() {
        habilitarCertificadoSence();
    };

    /**
     * Deshabilitar certificado sence
     */
    function deshabilitarCertificadoSence() {
        // deshablitar checkbox
        document.getElementById('cierre-listo-certificado-sence').disabled = true;
        document.getElementById('cierre-listo-certificado-sence').checked = false;
        document.getElementById('cierre-listo-certificado-sence-color').removeAttribute('class');
        document.getElementById('cierre-listo-certificado-sence-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // deshabilitar inputs
        document.getElementById('numero-certificado-sence').setAttribute('readonly','');
        document.getElementById('numero-certificado-sence').value = '';
        // deshabilitar botones
        document.getElementById('btn-cierre-archivo-certificado-sence').disabled = true;
        // cambiar color labels
        document.getElementById('cierre-text-certificado-sence').style.color = 'grey';
    }

    /**
     * Deshabilitar certificado sence desde otros js
     */
    window.deshabilitarCertificadoSenceCierre = function() {
        deshabilitarCertificadoSence();
    };

    /**
     * Habilitar notas
     */
    function habilitarNotas() {
        // hablitar checkbox
        document.getElementById('cierre-listo-notas').disabled = false;
        document.getElementById('cierre-listo-notas-color').removeAttribute('class');
        document.getElementById('cierre-listo-notas-color').setAttribute('class','colorinput-color bg-cyan');
        // habilitar botones
        document.getElementById('btn-cierre-notas').hidden = false;
        document.getElementById('btn-cierre-notas-deshabilitado').hidden = true;
        // cambiar color labels
        document.getElementById('cierre-text-notas').style.color = '#495057';
    }

    /**
     * Habilitar notas desde otros js
     */
    window.habilitarNotasCierre = function() {
        habilitarNotas();
    };

    /**
     * Deshabilitar notas
     */
    function deshabilitarNotas() {
        // deshablitar checkbox
        document.getElementById('cierre-listo-notas').disabled = true;
        document.getElementById('cierre-listo-notas').checked = false;
        document.getElementById('cierre-listo-notas-color').removeAttribute('class');
        document.getElementById('cierre-listo-notas-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // deshabilitar botones
        document.getElementById('btn-cierre-notas').hidden = true;
        document.getElementById('btn-cierre-notas-deshabilitado').hidden = false;
        // cambiar color labels
        document.getElementById('cierre-text-notas').style.color = 'grey';
    }

    /**
     * Deshabilitar notas desde otros js
     */
    window.deshabilitarNotasCierre = function() {
        deshabilitarNotas();
    };

    /**
     * Habilitar diploma
     */
    function habilitarDiploma() {
        // hablitar checkbox
        document.getElementById('cierre-listo-diploma').disabled = false;
        document.getElementById('cierre-listo-diploma-color').removeAttribute('class');
        document.getElementById('cierre-listo-diploma-color').setAttribute('class','colorinput-color bg-cyan');
        // habilitar botones
        document.getElementById('btn-cierre-diploma').hidden = false;
        document.getElementById('btn-cierre-diploma-deshabilitado').hidden = true;
        // cambiar color labels
        document.getElementById('cierre-text-diploma').style.color = '#495057';
    }

    /**
     * Deshabilitar diploma
     */
    function deshabilitarDiploma() {
        // deshablitar checkbox
        document.getElementById('cierre-listo-diploma').disabled = true;
        document.getElementById('cierre-listo-diploma').checked = false;
        document.getElementById('cierre-listo-diploma-color').removeAttribute('class');
        document.getElementById('cierre-listo-diploma-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // deshabilitar botones
        document.getElementById('btn-cierre-diploma').hidden = true;
        document.getElementById('btn-cierre-diploma-deshabilitado').hidden = false;
        // document.getElementById('btn-cierre-diploma').setAttribute('onclick','botonDeshabilitado();');
        // cambiar color labels
        document.getElementById('cierre-text-diploma').style.color = 'grey';
    }

    /**
     * Habilitar oc
     */
    function habilitarOC() {
        // hablitar checkbox
        document.getElementById('cierre-listo-oc').disabled = false;
        document.getElementById('cierre-listo-oc-color').removeAttribute('class');
        document.getElementById('cierre-listo-oc-color').setAttribute('class','colorinput-color bg-cyan');
        // habilitar botones
        document.getElementById('btn-cierre-oc').hidden = false;
        document.getElementById('btn-cierre-oc-deshabilitado').hidden = true;
        // cambiar color labels
        document.getElementById('cierre-text-oc').style.color = '#495057';
    }

    /**
     * Habilitar oc desde otros js
     */
    window.habilitarOCCierre = function() {
        habilitarOC();
    };

    /**
     * Deshabilitar oc
     */
    function deshabilitarOC() {
        // deshablitar checkbox
        document.getElementById('cierre-listo-oc').disabled = true;
        document.getElementById('cierre-listo-oc').checked = false;
        document.getElementById('cierre-listo-oc-color').removeAttribute('class');
        document.getElementById('cierre-listo-oc-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // deshabilitar botones
        document.getElementById('btn-cierre-oc').hidden = true;
        document.getElementById('btn-cierre-oc-deshabilitado').hidden = false;
        // cambiar color labels
        document.getElementById('cierre-text-oc').style.color = 'grey';
    }

    /**
     * Deshabilitar oc desde otros js
     */
    window.deshabilitarOCCierre = function() {
        deshabilitarOC();
    };

    // Habilitar/deshabilitar diploma
    $('#cierre-aplica-diploma').change(function() {
        if (this.checked) {
            habilitarDiploma();
        } else {
            deshabilitarDiploma();
        }
        guardarDatos();
    });

    $('#cierre-listo-libro-asistencia').change (function() {
        document.getElementById('cierre-cierre-validacion-listo').hidden = true;
        if (this.checked) {
            var asistencia = $('#data-tag-asistencia-ingresada').data('data');
            if (asistencia == 0) {
                this.checked = false;
                document.getElementById('cierre-cierre-validacion-listo-text').innerText = 'Se debe ingresar la asistencia.';
                document.getElementById('cierre-cierre-validacion-listo').hidden = false;
                return;
            }
            // var archivo = $('#data-tag-archivo-libro-asistencia').data('data');
            // if (archivo === '') {
            //     this.checked = false;
            //     document.getElementById('cierre-cierre-validacion-listo-text').innerText = 'Se debe adjuntar el libro de asistencia.';
            //     document.getElementById('cierre-cierre-validacion-listo').hidden = false;
            //     return;
            // }
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    $('#cierre-listo-certificado-sence').change (function() {
        document.getElementById('cierre-cierre-validacion-listo').hidden = true;
        if (this.checked) {
            if (document.getElementById('numero-certificado-sence').value === '') {
                this.checked = false;
                document.getElementById('cierre-cierre-validacion-listo-text').innerText = 'Se debe ingresar el numero de certificado.';
                document.getElementById('cierre-cierre-validacion-listo').hidden = false;
                return;
            }
            // var archivo = $('#data-tag-archivo-certificado-sence').data('data');
            // if (archivo === '') {
            //     this.checked = false;
            //     document.getElementById('cierre-cierre-validacion-listo-text').innerText = 'Se debe adjuntar el certificado Sence.';
            //     document.getElementById('cierre-cierre-validacion-listo').hidden = false;
            //     return;
            // }
        }
        guardarDatos();
    });

    $('#cierre-listo-encuesta-ads').change (function() {
        document.getElementById('cierre-cierre-validacion-listo').hidden = true;
        if (this.checked) {
            // var encuesta = $('#data-tag-encuesta-ingresada').data('data');
            // if (encuesta == 0) {
            //     this.checked = false;
            //     document.getElementById('cierre-cierre-validacion-listo-text').innerText = 'Se deben ingresar las encuestas.';
            //     document.getElementById('cierre-cierre-validacion-listo').hidden = false;
            //     return;
            // }
            // var archivo = $('#data-tag-archivo-encuesta-ads').data('data');
            // if (archivo === '') {
            //     this.checked = false;
            //     document.getElementById('cierre-cierre-validacion-listo-text').innerText = 'Se debe adjuntar las encuestas.';
            //     document.getElementById('cierre-cierre-validacion-listo').hidden = false;
            //     return;
            // }
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    $('#cierre-listo-notas').change (function() {
        document.getElementById('cierre-cierre-validacion-listo').hidden = true;
        if (this.checked) {
            if (false) { // TODO: revisar si se han ingresado las notas
                this.checked = false;
                document.getElementById('cierre-cierre-validacion-listo-text').innerText = 'Se deben ingresar las notas.';
                document.getElementById('cierre-cierre-validacion-listo').hidden = false;
                return;
            }
        }
        guardarDatos();
    });

    $('#cierre-listo-diploma').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-oc').change (function() {
        document.getElementById('cierre-cierre-validacion-listo').hidden = true;
        if (this.checked) {
            if (false) { // TODO:revisar si se ha ingresado la oc
                this.checked = false;
                document.getElementById('cierre-cierre-validacion-listo-text').innerText = 'Se deben ingresar las notas.';
                document.getElementById('cierre-cierre-validacion-listo').hidden = false;
                return;
            }
        }
        guardarDatos();
    });

    $('#numero-certificado-sence').change (function(e) {
        guardarDatos();
    });

    // Recargar la pagina se se hace click en un boton
    $('#btn-cierre-libro-asistencia').click (function(e) {
        location.reload();
    });

    $('#btn-cierre-subir-libro-asistencia').click (function(e) {
        location.reload();
    });

    $('#btn-cierre-subir-certificado-sence').click (function(e) {
        location.reload();
    });

    $('#btn-cierre-encuesta-ads').click (function(e) {
        location.reload();
    });

    $('#btn-cierre-notas').click (function(e) {
        location.reload();
    });

    $('#btn-cierre-diploma').click (function(e) {
        location.reload();
    });

    $('#btn-cierre-oc').click (function(e) {
        location.reload();
    });

    $('#btn-cierre-archivo-libro-asistencia').click (function(e) {
        var archivo = $('#data-tag-archivo-libro-asistencia').data('data');
        if (archivo !== '') {
            document.getElementById('archivo-1-text').innerText = archivo[0].file_name;
        }
        $('#modal-archivo-libro-asistencia').modal('toggle');
    });

    $('#btn-cierre-archivo-certificado-sence').click (function(e) {
        var archivo = $('#data-tag-archivo-certificado-sence').data('data');
        if (archivo !== '') {
            document.getElementById('archivo-2-text').innerText = archivo[0].file_name;
        }
        $('#modal-archivo-certificado-sence').modal('toggle');
    });

    $('#btn-cierre-archivo-encuesta-ads').click (function(e) {
        var archivo = $('#data-tag-archivo-encuesta-ads').data('data');
        if (archivo !== '') {
            document.getElementById('archivo-3-text').innerText = archivo[0].file_name;
        }
        $('#modal-archivo-encuesta-ads').modal('toggle');
    });

    /**
     * Envia los datos del cierre para guardarlos en la bd
     */
    function guardarDatos() {
        document.getElementById('cierre-cierre-validacion-listo').hidden = true;
        // document.getElementById('cierre-cierre-validacion-guardar-datos').hidden = true;
        document.getElementById('cierre-cierre-error-guardar-datos').hidden = true;
        // // Validar los datos
        // if (!validarDatos()) {
        //     document.getElementById('cierre-cierre-validacion-guardar-datos').hidden = false;
        //     return;
        // }
        // Mostrar indicador que se estan guardando los datos
        document.getElementById('cierre-cierre-guardando-datos').hidden = false;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/guardar_cierre_checklist",
            data: {
                id: $('#servicio-id').data('data'),
                diplomas_aplica: reemplazarTrueFalse(document.getElementById('cierre-aplica-diploma').checked),
                diplomas_listo: reemplazarTrueFalse(document.getElementById('cierre-listo-diploma').checked),
                nota_listo: reemplazarTrueFalse(document.getElementById('cierre-listo-notas').checked),
                certificado_sence_aplica: reemplazarTrueFalse(document.getElementById('cierre-aplica-certificado-sence').checked),
                certificado_sence_listo: reemplazarTrueFalse(document.getElementById('cierre-listo-certificado-sence').checked),
                libro_asistencia_listo: reemplazarTrueFalse(document.getElementById('cierre-listo-libro-asistencia').checked),
                resultado_encuestas_ads_listo: reemplazarTrueFalse(document.getElementById('cierre-listo-encuesta-ads').checked),
                orden_compra_listo: reemplazarTrueFalse(document.getElementById('cierre-listo-oc').checked),
                certificado_sence: document.getElementById('numero-certificado-sence').value
            },
            success: function(result) {
                // console.log('ajax datos cierre ok');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('cierre-cierre-guardando-datos').hidden = true;
            },
            error: function(xhr) {
                // console.log('ajax datos cierre error');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('cierre-cierre-guardando-datos').hidden = true;
                document.getElementById('cierre-cierre-error-guardar-datos').hidden = false;
            }
        });
    }

    window.guardarCierre = function() {
        guardarDatos();
    }


    /**
     * Deshabilita los campos de ingreso de datos
     */
    window.deshabilitarCierreServicio = function() {
        // libro asistencia
        // aplica
        this.document.getElementById('cierre-aplica-libro-asistencia').disabled = true;
        this.document.getElementById('cierre-aplica-libro-asistencia-color').removeAttribute('class');
        this.document.getElementById('cierre-aplica-libro-asistencia-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('cierre-listo-libro-asistencia').disabled = true;
        this.document.getElementById('cierre-listo-libro-asistencia-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-libro-asistencia-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // input
        this.document.getElementById('archivo-1').setAttribute('disabled','');
        // certificado sence
        // aplica
        this.document.getElementById('cierre-aplica-certificado-sence').disabled = true;
        this.document.getElementById('cierre-aplica-certificado-sence-color').removeAttribute('class');
        this.document.getElementById('cierre-aplica-certificado-sence-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('cierre-listo-certificado-sence').disabled = true;
        this.document.getElementById('cierre-listo-certificado-sence-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-certificado-sence-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // input
        this.document.getElementById('archivo-2').setAttribute('disabled','');
        this.document.getElementById('numero-certificado-sence').setAttribute('readonly','');
        // encuesta ads
        // aplica
        this.document.getElementById('cierre-aplica-encuesta-ads').disabled = true;
        this.document.getElementById('cierre-aplica-encuesta-ads-color').removeAttribute('class');
        this.document.getElementById('cierre-aplica-encuesta-ads-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('cierre-listo-encuesta-ads').disabled = true;
        this.document.getElementById('cierre-listo-encuesta-ads-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-encuesta-ads-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // input
        this.document.getElementById('archivo-3').setAttribute('disabled','');
        // notas
        // aplica
        this.document.getElementById('cierre-aplica-notas').disabled = true;
        this.document.getElementById('cierre-aplica-notas-color').removeAttribute('class');
        this.document.getElementById('cierre-aplica-notas-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('cierre-listo-notas').disabled = true;
        this.document.getElementById('cierre-listo-notas-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-notas-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // diploma
        // aplica
        this.document.getElementById('cierre-aplica-diploma').disabled = true;
        this.document.getElementById('cierre-aplica-diploma-color').removeAttribute('class');
        this.document.getElementById('cierre-aplica-diploma-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('cierre-listo-diploma').disabled = true;
        this.document.getElementById('cierre-listo-diploma-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-diploma-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // oc
        // aplica
        this.document.getElementById('cierre-aplica-oc').disabled = true;
        this.document.getElementById('cierre-aplica-oc-color').removeAttribute('class');
        this.document.getElementById('cierre-aplica-oc-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('cierre-listo-oc').disabled = true;
        this.document.getElementById('cierre-listo-oc-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-oc-color').setAttribute('class','colorinput-color bg-cyan-lighter');
    }

    var checkCierre = $('#data-tag-check-cierre').data('data');

    if (checkCierre.diplomas_listo === 1) {
        document.getElementById('cierre-listo-diploma').checked = true;
    }

    if (checkCierre.nota_listo === 1) {
        document.getElementById('cierre-listo-notas').checked = true;
    }

    if (checkCierre.certificado_sence_listo === 1) {
        document.getElementById('cierre-listo-certificado-sence').checked = true;
    }

    if (checkCierre.libro_asistencia_listo === 1) {
        document.getElementById('cierre-listo-libro-asistencia').checked = true;
    }

    if (checkCierre.resultado_encuestas_ads_listo === 1) {
        document.getElementById('cierre-listo-encuesta-ads').checked = true;
    }

    if (checkCierre.orden_compra_listo === 1) {
        document.getElementById('cierre-listo-oc').checked = true;
    }

    var senceAplica = $('#data-tag-aplica-sence').data('data');

    // Verificar si el certificado sence esta deshabilitado
    if (senceAplica === 1) {
        document.getElementById('cierre-aplica-certificado-sence').checked = true;
        habilitarCertificadoSence();
    } else {
        document.getElementById('cierre-aplica-certificado-sence').checked = false;
        deshabilitarCertificadoSence();
    }

    // Verificar si la oc esta deshabilitada
    if (senceAplica === 1) {
        document.getElementById('cierre-aplica-oc').checked = true;
        habilitarOC();
    } else {
        document.getElementById('cierre-aplica-oc').checked = false;
        deshabilitarOC();
    }

    var disenioTecnico = $('#data-tag-disenio-tecnico').data('data');

    // Verificar si notas esta deshabilitado
    if (disenioTecnico.prueba_aplica === 1 || disenioTecnico.guia_aplica === 1) {
        document.getElementById('cierre-aplica-notas').checked = true;
        habilitarNotas();
    } else {
        document.getElementById('cierre-aplica-notas').checked = false;
        deshabilitarNotas();
    }

    // Verificar si diplomas esta deshabilitado
    if (checkCierre.diplomas_aplica === 1) {
        document.getElementById('cierre-aplica-diploma').checked = true;
        habilitarDiploma();
    } else {
        document.getElementById('cierre-aplica-diploma').checked = false;
        deshabilitarDiploma();
    }
});