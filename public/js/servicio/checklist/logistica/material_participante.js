$(document).ready(function () {

    /**
     * Habilitar gafete
     */
    function habilitarGafete() {
        // hablitar checkbox
        document.getElementById('logistica-listo-gafete').disabled = false;
        document.getElementById('logistica-listo-gafete-color').removeAttribute('class');
        document.getElementById('logistica-listo-gafete-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-gafete').style.color = '#495057';
    }

    /**
     * Deshabilitar gafete
     */
    function deshabilitarGafete() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-gafete').disabled = true;
        document.getElementById('logistica-listo-gafete').checked = false;
        document.getElementById('logistica-listo-gafete-color').removeAttribute('class');
        document.getElementById('logistica-listo-gafete-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-gafete').style.color = 'grey';
    }

    /**
     * Habilitar bitacora
     */
    function habilitarBitacora() {
        // hablitar checkbox
        document.getElementById('logistica-listo-bitacora').disabled = false;
        document.getElementById('logistica-listo-bitacora-color').removeAttribute('class');
        document.getElementById('logistica-listo-bitacora-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-bitacora').style.color = '#495057';
    }

    /**
     * Deshabilitar bitacora
     */
    function deshabilitarBitacora() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-bitacora').disabled = true;
        document.getElementById('logistica-listo-bitacora').checked = false;
        document.getElementById('logistica-listo-bitacora-color').removeAttribute('class');
        document.getElementById('logistica-listo-bitacora-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-bitacora').style.color = 'grey';
    }

    /**
     * Habilitar carpeta
     */
    function habilitarCarpeta() {
        // hablitar checkbox
        document.getElementById('logistica-listo-carpeta').disabled = false;
        document.getElementById('logistica-listo-carpeta-color').removeAttribute('class');
        document.getElementById('logistica-listo-carpeta-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-carpeta').style.color = '#495057';
    }

    /**
     * Deshabilitar carpeta
     */
    function deshabilitarCarpeta() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-carpeta').disabled = true;
        document.getElementById('logistica-listo-carpeta').checked = false;
        document.getElementById('logistica-listo-carpeta-color').removeAttribute('class');
        document.getElementById('logistica-listo-carpeta-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-carpeta').style.color = 'grey';
    }

    /**
     * Habilitar velobind
     */
    function habilitarVelobind() {
        // hablitar checkbox
        document.getElementById('logistica-listo-velobind').disabled = false;
        document.getElementById('logistica-listo-velobind-color').removeAttribute('class');
        document.getElementById('logistica-listo-velobind-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-velobind').style.color = '#495057';
    }

    /**
     * Deshabilitar velobind
     */
    function deshabilitarVelobind() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-velobind').disabled = true;
        document.getElementById('logistica-listo-velobind').checked = false;
        document.getElementById('logistica-listo-velobind-color').removeAttribute('class');
        document.getElementById('logistica-listo-velobind-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-velobind').style.color = 'grey';
    }

    /**
     * Habilitar lapices
     */
    function habilitarLapices() {
        // hablitar checkbox
        document.getElementById('logistica-listo-lapices').disabled = false;
        document.getElementById('logistica-listo-lapices-color').removeAttribute('class');
        document.getElementById('logistica-listo-lapices-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-lapices').style.color = '#495057';
    }

    /**
     * Deshabilitar lapices
     */
    function deshabilitarLapices() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-lapices').disabled = true;
        document.getElementById('logistica-listo-lapices').checked = false;
        document.getElementById('logistica-listo-lapices-color').removeAttribute('class');
        document.getElementById('logistica-listo-lapices-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-lapices').style.color = 'grey';
    }

    // Habilitar/deshabilitar gafete
    $('#logistica-aplica-gafete').change(function() {
        if (this.checked) {
            habilitarGafete();
        } else {
            deshabilitarGafete();
        }
        guardarDatos();
    });

    // Habilitar/deshabilitar bitacora
    $('#logistica-aplica-bitacora').change(function() {
        if (this.checked) {
            habilitarBitacora();
        } else {
            deshabilitarBitacora();
        }
        guardarDatos();
    });

    // Habilitar/deshabilitar carpeta
    $('#logistica-aplica-carpeta').change(function() {
        if (this.checked) {
            habilitarCarpeta();
        } else {
            deshabilitarCarpeta();
        }
        guardarDatos();
    });

    // Habilitar/deshabilitar velobind
    $('#logistica-aplica-velobind').change(function() {
        if (this.checked) {
            habilitarVelobind();
        } else {
            deshabilitarVelobind();
        }
        guardarDatos();
    });

    // Habilitar/deshabilitar lapices
    $('#logistica-aplica-lapices').change(function() {
        if (this.checked) {
            habilitarLapices();
        } else {
            deshabilitarLapices();
        }
        guardarDatos();
    });

    $('#logistica-listo-gafete').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-bitacora').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-carpeta').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-velobind').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-lapices').change (function() {
        guardarDatos();
    });

    /**
     * Envia los datos de la coordinacion para guardarlos en la bd
     */
    function guardarDatos() {
        document.getElementById('logistica-material-participante-error-guardar-datos').hidden = true;
        // Mostrar indicador que se estan guardando los datos
        document.getElementById('logistica-material-participante-guardando-datos').hidden = false;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/guardar_logistica_material_participante_checklist",
            data: {
                id: $('#servicio-id').data('data'),
                gafete_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-gafete').checked),
                gafete_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-gafete').checked),
                bitacora_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-bitacora').checked),
                bitacora_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-bitacora').checked),
                carpeta_ads_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-carpeta').checked),
                carpeta_ads_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-carpeta').checked),
                lapices_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-lapices').checked),
                lapices_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-lapices').checked),
                velobind_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-velobind').checked),
                velobind_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-velobind').checked),
            },
            success: function(result) {
                // console.log('ajax datos ok');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('logistica-material-participante-guardando-datos').hidden = true;
            },
            error: function(xhr) {
                // console.log('ajax datos error');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('logistica-material-participante-guardando-datos').hidden = true;
                document.getElementById('logistica-material-participante-error-guardar-datos').hidden = false;
            }
        });
    }


    /**
     * Deshabilita los campos de ingreso de datos
     */
    window.deshabilitarMaterialParticipante = function() {
        // gafetes
        // aplica
        this.document.getElementById('logistica-aplica-gafete').disabled = true;
        this.document.getElementById('logistica-aplica-gafete-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-gafete-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-gafete').disabled = true;
        this.document.getElementById('logistica-listo-gafete-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-gafete-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // bitacora
        // aplica
        this.document.getElementById('logistica-aplica-bitacora').disabled = true;
        this.document.getElementById('logistica-aplica-bitacora-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-bitacora-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-bitacora').disabled = true;
        this.document.getElementById('logistica-listo-bitacora-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-bitacora-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // carpeta ads
        // aplica
        this.document.getElementById('logistica-aplica-carpeta').disabled = true;
        this.document.getElementById('logistica-aplica-carpeta-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-carpeta-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-carpeta').disabled = true;
        this.document.getElementById('logistica-listo-carpeta-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-carpeta-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // velobind
        // aplica
        this.document.getElementById('logistica-aplica-velobind').disabled = true;
        this.document.getElementById('logistica-aplica-velobind-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-velobind-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-velobind').disabled = true;
        this.document.getElementById('logistica-listo-velobind-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-velobind-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // lapices
        // aplica
        this.document.getElementById('logistica-aplica-lapices').disabled = true;
        this.document.getElementById('logistica-aplica-lapices-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-lapices-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-lapices').disabled = true;
        this.document.getElementById('logistica-listo-lapices-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-lapices-color').setAttribute('class','colorinput-color bg-cyan-lighter');
    }

    var checkMaterialParticipante = $('#data-tag-check-material-participante').data('data');

    // Cargar los listos de la bd
    if (checkMaterialParticipante.gafete_listo === 1) {
        document.getElementById('logistica-listo-gafete').checked = true;
    }

    if (checkMaterialParticipante.bitacora_listo === 1) {
        document.getElementById('logistica-listo-bitacora').checked = true;
    }

    if (checkMaterialParticipante.carpeta_ads_listo === 1) {
        document.getElementById('logistica-listo-carpeta').checked = true;
    }

    if (checkMaterialParticipante.velobind_listo === 1) {
        document.getElementById('logistica-listo-velobind').checked = true;
    }

    if (checkMaterialParticipante.lapices_listo === 1) {
        document.getElementById('logistica-listo-lapices').checked = true;
    }

    // Verificar si el gafete esta deshabilitado
    if (checkMaterialParticipante.gafete_aplica === 1) {
        document.getElementById('logistica-aplica-gafete').checked = true;
        habilitarGafete();
    } else {
        document.getElementById('logistica-aplica-gafete').checked = false;
        deshabilitarGafete();
    }

    // Verificar si la bitacora esta deshabilitada
    if (checkMaterialParticipante.bitacora_aplica === 1) {
        document.getElementById('logistica-aplica-bitacora').checked = true;
        habilitarBitacora();
    } else {
        document.getElementById('logistica-aplica-bitacora').checked = false;
        deshabilitarBitacora();
    }

    // Verificar si la carpeta esta deshabilitada
    if (checkMaterialParticipante.carpeta_ads_aplica === 1) {
        document.getElementById('logistica-aplica-carpeta').checked = true;
        habilitarCarpeta();
    } else {
        document.getElementById('logistica-aplica-carpeta').checked = false;
        deshabilitarCarpeta();
    }

    // Verificar si el velobind esta deshabilitado
    if (checkMaterialParticipante.velobind_aplica === 1) {
        document.getElementById('logistica-aplica-velobind').checked = true;
        habilitarVelobind();
    } else {
        document.getElementById('logistica-aplica-velobind').checked = false;
        deshabilitarVelobind();
    }

    // Verificar si lapices esta deshabilitado
    if (checkMaterialParticipante.lapices_aplica === 1) {
        document.getElementById('logistica-aplica-lapices').checked = true;
        habilitarLapices();
    } else {
        document.getElementById('logistica-aplica-lapices').checked = false;
        deshabilitarLapices();
    }

});