$(document).ready(function () {

    /**
     * Habilitar proyector
     */
    function habilitarProyector() {
        // hablitar checkbox
        document.getElementById('logistica-listo-proyector').disabled = false;
        document.getElementById('logistica-listo-proyector-color').removeAttribute('class');
        document.getElementById('logistica-listo-proyector-color').setAttribute('class','colorinput-color bg-cyan');
        // habilitar inputs
        selectizeControlProyector.enable();
        // cambiar color labels
        document.getElementById('logistica-text-proyector').style.color = '#495057';
    }

    /**
     * Deshabilitar proyector
     */
    function deshabilitarProyector() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-proyector').disabled = true;
        document.getElementById('logistica-listo-proyector').checked = false;
        document.getElementById('logistica-listo-proyector-color').removeAttribute('class');
        document.getElementById('logistica-listo-proyector-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // deshabilitar inputs
        selectizeControlProyector.disable();
        selectizeControlProyector.clear();
        // cambiar color labels
        document.getElementById('logistica-text-proyector').style.color = 'grey';
    }

    /**
     * Habilitar notebook
     */
    function habilitarNotebook() {
        // hablitar checkbox
        document.getElementById('logistica-listo-notebook').disabled = false;
        document.getElementById('logistica-listo-notebook-color').removeAttribute('class');
        document.getElementById('logistica-listo-notebook-color').setAttribute('class','colorinput-color bg-cyan');
        // habilitar inputs
        selectizeControlNotebook.enable();
        // cambiar color labels
        document.getElementById('logistica-text-notebook').style.color = '#495057';
    }

    /**
     * Deshabilitar notebook
     */
    function deshabilitarNotebook() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-notebook').disabled = true;
        document.getElementById('logistica-listo-notebook').checked = false;
        document.getElementById('logistica-listo-notebook-color').removeAttribute('class');
        document.getElementById('logistica-listo-notebook-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // deshabilitar inputs
        selectizeControlNotebook.disable();
        selectizeControlNotebook.clear();
        // cambiar color labels
        document.getElementById('logistica-text-notebook').style.color = 'grey';
    }

    /**
     * Habilitar encuesta empresa
     */
    function habilitarEncuestaEmpresa() {
        // hablitar checkbox
        document.getElementById('logistica-listo-encuesta-empresa').disabled = false;
        document.getElementById('logistica-listo-encuesta-empresa-color').removeAttribute('class');
        document.getElementById('logistica-listo-encuesta-empresa-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-encuesta-empresa').style.color = '#495057';
    }

    /**
     * Deshabilitar encuesta empresa
     */
    function deshabilitarEncuestaEmpresa() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-encuesta-empresa').disabled = true;
        document.getElementById('logistica-listo-encuesta-empresa').checked = false;
        document.getElementById('logistica-listo-encuesta-empresa-color').removeAttribute('class');
        document.getElementById('logistica-listo-encuesta-empresa-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-encuesta-empresa').style.color = 'grey';
    }

    /**
     * Habilitar encuesta adicionales
     */
    function habilitarEncuestaAdicionales() {
        // hablitar checkbox
        document.getElementById('logistica-listo-encuesta-adicionales').disabled = false;
        document.getElementById('logistica-listo-encuesta-adicionales-color').removeAttribute('class');
        document.getElementById('logistica-listo-encuesta-adicionales-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-encuesta-adicionales').style.color = '#495057';
    }

    /**
     * Deshabilitar encuesta adicionales
     */
    function deshabilitarEncuestaAdicionales() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-encuesta-adicionales').disabled = true;
        document.getElementById('logistica-listo-encuesta-adicionales').checked = false;
        document.getElementById('logistica-listo-encuesta-adicionales-color').removeAttribute('class');
        document.getElementById('logistica-listo-encuesta-adicionales-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-encuesta-adicionales').style.color = 'grey';
    }

    /**
     * Habilitar guia
     */
    function habilitarGuia() {
        // hablitar checkbox
        document.getElementById('logistica-listo-guia').disabled = false;
        document.getElementById('logistica-listo-guia-color').removeAttribute('class');
        document.getElementById('logistica-listo-guia-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-guia').style.color = '#495057';
        // hablitar notas cierre
        if (document.getElementById('logistica-aplica-prueba').checked === false) {
            document.getElementById('cierre-aplica-notas').checked = true;
            habilitarNotasCierre();
        }
    }

    /**
     * Deshabilitar guia
     */
    function deshabilitarGuia() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-guia').disabled = true;
        document.getElementById('logistica-listo-guia').checked = false;
        document.getElementById('logistica-listo-guia-color').removeAttribute('class');
        document.getElementById('logistica-listo-guia-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-guia').style.color = 'grey';
        // deshabilitar notas cierre
        if (document.getElementById('logistica-aplica-prueba').checked === false) {
            document.getElementById('cierre-aplica-notas').checked = false;
            deshabilitarNotasCierre();
        }
    }

    /**
     * Habilitar prueba
     */
    function habilitarPrueba() {
        // hablitar checkbox
        document.getElementById('logistica-listo-prueba').disabled = false;
        document.getElementById('logistica-listo-prueba-color').removeAttribute('class');
        document.getElementById('logistica-listo-prueba-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-prueba').style.color = '#495057';
        // hablitar notas cierre
        if (document.getElementById('logistica-aplica-guia').checked === false) {
            document.getElementById('cierre-aplica-notas').checked = true;
            habilitarNotasCierre();
        }
    }

    /**
     * Deshabilitar prueba
     */
    function deshabilitarPrueba() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-prueba').disabled = true;
        document.getElementById('logistica-listo-prueba').checked = false;
        document.getElementById('logistica-listo-prueba-color').removeAttribute('class');
        document.getElementById('logistica-listo-prueba-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-prueba').style.color = 'grey';
        // deshabilitar notas cierre
        if (document.getElementById('logistica-aplica-guia').checked === false) {
            document.getElementById('cierre-aplica-notas').checked = false;
            deshabilitarNotasCierre();
        }
    }

    /**
     * Habilitar plumones
     */
    function habilitarPlumones() {
        // hablitar checkbox
        document.getElementById('logistica-listo-plumones').disabled = false;
        document.getElementById('logistica-listo-plumones-color').removeAttribute('class');
        document.getElementById('logistica-listo-plumones-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-plumones').style.color = '#495057';
    }

    /**
     * Deshabilitar plumones
     */
    function deshabilitarPlumones() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-plumones').disabled = true;
        document.getElementById('logistica-listo-plumones').checked = false;
        document.getElementById('logistica-listo-plumones-color').removeAttribute('class');
        document.getElementById('logistica-listo-plumones-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-plumones').style.color = 'grey';
    }

    // Habilitar/deshabilitar proyector
    $('#logistica-aplica-proyector').change(function() {
        if (this.checked) {
            habilitarProyector();
            habilitarProyectorCierre();
        } else {
            deshabilitarProyector();
            deshabilitarProyectorCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar notebook
    $('#logistica-aplica-notebook').change(function() {
        if (this.checked) {
            habilitarNotebook();
            habilitarNotebookCierre();
        } else {
            deshabilitarNotebook();
            deshabilitarNotebookCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar encuesta empresa
    $('#logistica-aplica-encuesta-empresa').change(function() {
        if (this.checked) {
            habilitarEncuestaEmpresa();
            habilitarEncuestaEmpresaCierre();
        } else {
            deshabilitarEncuestaEmpresa();
            deshabilitarEncuestaEmpresaCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar encuesta adicional
    $('#logistica-aplica-encuesta-adicionales').change(function() {
        if (this.checked) {
            habilitarEncuestaAdicionales();
            habilitarEncuestaAdicionalesCierre();
        } else {
            deshabilitarEncuestaAdicionales();
            deshabilitarEncuestaAdicionalesCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar guia
    $('#logistica-aplica-guia').change(function() {
        if (this.checked) {
            habilitarGuia();
            habilitarGuiaCierre();
        } else {
            deshabilitarGuia();
            deshabilitarGuiaCierre();
        }
        guardarDatos();
        guardarCierre();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar prueba
    $('#logistica-aplica-prueba').change(function() {
        if (this.checked) {
            habilitarPrueba();
            habilitarPruebaCierre();
        } else {
            deshabilitarPrueba();
            deshabilitarPruebaCierre();
        }
        guardarDatos();
        guardarCierre();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar plumones
    $('#logistica-aplica-plumones').change(function() {
        if (this.checked) {
            habilitarPlumones();
            habilitarPlumonesCierre();
        } else {
            deshabilitarPlumones();
            deshabilitarPlumonesCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    $('#logistica-listo-libro-asistencia').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-pendon').change (function() {
        document.getElementById('logistica-material-relator-validacion-listo').hidden = true;
        if (this.checked) {
            if (selectizeControlPendon.items.length === 0) {
                this.checked = false;
                document.getElementById('logistica-material-relator-validacion-listo-text').innerText = 'Se debe agregar un pendon.';
                document.getElementById('logistica-material-relator-validacion-listo').hidden = false;
                return;
            }
        }
        guardarDatos();
    });

    $('#logistica-listo-proyector').change (function() {
        document.getElementById('logistica-material-relator-validacion-listo').hidden = true;
        if (this.checked) {
            if (selectizeControlProyector.items.length === 0) {
                this.checked = false;
                document.getElementById('logistica-material-relator-validacion-listo-text').innerText = 'Se debe seleccionar un proyector.';
                document.getElementById('logistica-material-relator-validacion-listo').hidden = false;
                return;
            }
        }
        guardarDatos();
    });

    $('#logistica-listo-notebook').change (function() {
        document.getElementById('logistica-material-relator-validacion-listo').hidden = true;
        if (this.checked) {
            if (selectizeControlNotebook.items.length === 0) {
                this.checked = false;
                document.getElementById('logistica-material-relator-validacion-listo-text').innerText = 'Se debe seleccionar un notebook.';
                document.getElementById('logistica-material-relator-validacion-listo').hidden = false;
                return;
            }
        }
        guardarDatos();
    });

    $('#logistica-listo-encuesta-ads').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-encuesta-empresa').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-encuesta-adicionales').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-guia').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-prueba').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-plumones').change (function() {
        guardarDatos();
    });

    $('#input-tags-logistica-pendon').change (function() {
        guardarDatos();
    });

    $('#select-beast-logistica-proyector').change (function() {
        guardarDatos();
    });

    $('#select-beast-logistica-notebook').change (function() {
        guardarDatos();
    });

    /**
     * Envia los datos de la coordinacion para guardarlos en la bd
     */
    function guardarDatos() {
        document.getElementById('logistica-material-relator-validacion-listo').hidden = true;
        document.getElementById('logistica-material-relator-error-guardar-datos').hidden = true;
        // Mostrar indicador que se estan guardando los datos
        document.getElementById('logistica-material-relator-guardando-datos').hidden = false;
        // Verificar si hay notebook
        hayNotebook = true;
        if (selectizeControlNotebook.items.length === 0) {
            hayNotebook = false;
        }
        // Verificar si hay proyector
        hayProyector = true;
        if (selectizeControlProyector.items.length === 0) {
            hayProyector = false;
        }
        // Verificar si hay pendones
        hayPendones = true;
        if (selectizeControlPendon.items.length === 0) {
            hayPendones = false;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/guardar_logistica_material_relator_checklist",
            data: {
                id: $('#servicio-id').data('data'),
                libro_asistencia_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-libro-asistencia').checked),
                encuesta_ads_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-encuesta-ads').checked),
                encuesta_empresa_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-encuesta-empresa').checked),
                encuesta_empresa_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-encuesta-empresa').checked),
                pendones_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-pendon').checked),
                proyector_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-proyector').checked),
                proyector_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-proyector').checked),
                preparar_guia_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-guia').checked),
                preparar_guia_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-guia').checked),
                preparar_prueba_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-prueba').checked),
                preparar_prueba_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-prueba').checked),
                plumones_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-plumones').checked),
                plumones_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-plumones').checked),
                notebook_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-notebook').checked),
                notebook_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-notebook').checked),
                encuesta_adicional_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-encuesta-adicionales').checked),
                encuesta_adicional_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-encuesta-adicionales').checked),
                hayNotebook: hayNotebook,
                notebook_id: selectizeControlNotebook.items[0],
                hayProyector: hayProyector,
                proyector_id: selectizeControlProyector.items[0],
                hayPendones: hayPendones,
                pendones_ids: selectizeControlPendon.items
            },
            success: function(result) {
                // console.log('ajax datos ok');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('logistica-material-relator-guardando-datos').hidden = true;
            },
            error: function(xhr) {
                // console.log('ajax datos error');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('logistica-material-relator-guardando-datos').hidden = true;
                document.getElementById('logistica-material-relator-error-guardar-datos').hidden = false;
            }
        });
    }


    /**
     * Deshabilita los campos de ingreso de datos
     */
    window.deshabilitarMaterialRelator = function() {
        // libro asistencia
        // aplica
        this.document.getElementById('logistica-aplica-libro-asistencia').disabled = true;
        this.document.getElementById('logistica-aplica-libro-asistencia-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-libro-asistencia-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-libro-asistencia').disabled = true;
        this.document.getElementById('logistica-listo-libro-asistencia-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-libro-asistencia-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // pendon
        // aplica
        this.document.getElementById('logistica-aplica-pendon').disabled = true;
        this.document.getElementById('logistica-aplica-pendon-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-pendon-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-pendon').disabled = true;
        this.document.getElementById('logistica-listo-pendon-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-pendon-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // inputs
        selectizeControlPendon.disable();
        // proyector
        // aplica
        this.document.getElementById('logistica-aplica-proyector').disabled = true;
        this.document.getElementById('logistica-aplica-proyector-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-proyector-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-proyector').disabled = true;
        this.document.getElementById('logistica-listo-proyector-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-proyector-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // inputs
        selectizeControlProyector.disable();
        // notebook
        // aplica
        this.document.getElementById('logistica-aplica-notebook').disabled = true;
        this.document.getElementById('logistica-aplica-notebook-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-notebook-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-notebook').disabled = true;
        this.document.getElementById('logistica-listo-notebook-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-notebook-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // inputs
        selectizeControlNotebook.disable();
        // encuesta ads
        // aplica
        this.document.getElementById('logistica-aplica-encuesta-ads').disabled = true;
        this.document.getElementById('logistica-aplica-encuesta-ads-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-encuesta-ads-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-encuesta-ads').disabled = true;
        this.document.getElementById('logistica-listo-encuesta-ads-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-encuesta-ads-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // encuesta empresa
        // aplica
        this.document.getElementById('logistica-aplica-encuesta-empresa').disabled = true;
        this.document.getElementById('logistica-aplica-encuesta-empresa-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-encuesta-empresa-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-encuesta-empresa').disabled = true;
        this.document.getElementById('logistica-listo-encuesta-empresa-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-encuesta-empresa-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // encuesta adicionales
        // aplica
        this.document.getElementById('logistica-aplica-encuesta-adicionales').disabled = true;
        this.document.getElementById('logistica-aplica-encuesta-adicionales-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-encuesta-adicionales-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-encuesta-adicionales').disabled = true;
        this.document.getElementById('logistica-listo-encuesta-adicionales-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-encuesta-adicionales-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // guia
        // aplica
        this.document.getElementById('logistica-aplica-guia').disabled = true;
        this.document.getElementById('logistica-aplica-guia-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-guia-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-guia').disabled = true;
        this.document.getElementById('logistica-listo-guia-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-guia-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // prueba
        // aplica
        this.document.getElementById('logistica-aplica-prueba').disabled = true;
        this.document.getElementById('logistica-aplica-prueba-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-prueba-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-prueba').disabled = true;
        this.document.getElementById('logistica-listo-prueba-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-prueba-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // plumones
        // aplica
        this.document.getElementById('logistica-aplica-plumones').disabled = true;
        this.document.getElementById('logistica-aplica-plumones-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-plumones-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-plumones').disabled = true;
        this.document.getElementById('logistica-listo-plumones-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-plumones-color').setAttribute('class','colorinput-color bg-cyan-lighter');
    }


    // Configuracion de los selectize
    // Arreglo con los pendones
    var dataPendones = $('#data-tag-logistica-pendon').data('data');
    // Convertir arreglo a string
    var dataPendonesJson = JSON.stringify(dataPendones);
    // Id del relator del servicio
    var dataPendonesServicio = "[" + $('#data-tag-logistica-pendon-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectPendon = $('#input-tags-logistica-pendon').selectize({
        persist: false,
        maxItems: 4,
        valueField: 'id',
        labelField: 'codigo',
        items: JSON.parse(dataPendonesServicio),
        options: JSON.parse(dataPendonesJson)
    });
    var selectizeControlPendon = selectPendon[0].selectize;

    // Arreglo con los datos de los proyectores
    var dataProyector = $('#data-tag-logistica-proyector').data('data');
    // Convertir arreglo a string
    var dataProyectorJson = JSON.stringify(dataProyector);
    // Id del relator del servicio
    var dataProyectorServicio = "[" + $('#data-tag-logistica-proyector-servicio').data('data') + "]";
    var selectProyector = $('#select-beast-logistica-proyector').selectize({
        create: false,
        searchField: 'codigo',
        items: JSON.parse(dataProyectorServicio),
        options: JSON.parse(dataProyectorJson),
        valueField: 'id',
        labelField: 'codigo'
    });
    var selectizeControlProyector = selectProyector[0].selectize;

    // Arreglo con los datos de los notebooks
    var dataNotebook = $('#data-tag-logistica-notebook').data('data');
    // Convertir arreglo a string
    var dataNotebookJson = JSON.stringify(dataNotebook);
    // Id del relator del servicio
    var dataNotebookServicio = "[" + $('#data-tag-logistica-notebook-servicio').data('data') + "]";
    var selectNotebook = $('#select-beast-logistica-notebook').selectize({
        create: false,
        searchField: 'codigo',
        items: JSON.parse(dataNotebookServicio),
        options: JSON.parse(dataNotebookJson),
        valueField: 'id',
        labelField: 'codigo'
    });
    var selectizeControlNotebook = selectNotebook[0].selectize;

    var checkMaterialRelator = $('#data-tag-check-material-relator').data('data');

    var disenioTecnico = $('#data-tag-disenio-tecnico').data('data');

    // Cargar los listos de la bd
    if (checkMaterialRelator.libro_asistencia_listo === 1) {
        document.getElementById('logistica-listo-libro-asistencia').checked = true;
    }

    if (checkMaterialRelator.pendones_listo === 1) {
        document.getElementById('logistica-listo-pendon').checked = true;
    }

    if (checkMaterialRelator.proyector_listo === 1) {
        document.getElementById('logistica-listo-proyector').checked = true;
    }

    if (checkMaterialRelator.notebook_listo === 1) {
        document.getElementById('logistica-listo-notebook').checked = true;
    }

    if (checkMaterialRelator.encuesta_ads_listo === 1) {
        document.getElementById('logistica-listo-encuesta-ads').checked = true;
    }

    if (checkMaterialRelator.encuesta_empresa_listo === 1) {
        document.getElementById('logistica-listo-encuesta-empresa').checked = true;
    }

    if (checkMaterialRelator.encuesta_adicional_listo === 1) {
        document.getElementById('logistica-listo-encuesta-adicionales').checked = true;
    }

    if (checkMaterialRelator.preparar_guia_listo === 1) {
        document.getElementById('logistica-listo-guia').checked = true;
    }

    if (checkMaterialRelator.preparar_prueba_listo === 1) {
        document.getElementById('logistica-listo-prueba').checked = true;
    }

    if (checkMaterialRelator.plumones_listo === 1) {
        document.getElementById('logistica-listo-plumones').checked = true;
    }

    // Verificar si el proyector esta deshabilitado
    if (checkMaterialRelator.proyector_aplica === 1) {
        document.getElementById('logistica-aplica-proyector').checked = true;
        habilitarProyector();
        habilitarProyectorCierre();
    } else {
        document.getElementById('logistica-aplica-proyector').checked = false;
        deshabilitarProyector();
        deshabilitarProyectorCierre();
    }

    // Verificar si el notebook esta deshabilitado
    if (checkMaterialRelator.notebook_aplica === 1) {
        document.getElementById('logistica-aplica-notebook').checked = true;
        habilitarNotebook();
        habilitarNotebookCierre();
    } else {
        document.getElementById('logistica-aplica-notebook').checked = false;
        deshabilitarNotebook();
        deshabilitarNotebookCierre();
    }

    // Verificar si encuesta empresa esta deshabilitada
    if (disenioTecnico.encuesta_empresa_aplica === 1) {
        document.getElementById('logistica-aplica-encuesta-empresa').checked = true;
        habilitarEncuestaEmpresa();
        habilitarEncuestaEmpresaCierre();
    } else {
        document.getElementById('logistica-aplica-encuesta-empresa').checked = false;
        deshabilitarEncuestaEmpresa();
        deshabilitarEncuestaEmpresaCierre();
    }

    // Verificar si encuesta adicionales esta deshabilitado
    if (disenioTecnico.encuesta_adicionales_aplica === 1) {
        document.getElementById('logistica-aplica-encuesta-adicionales').checked = true;
        habilitarEncuestaAdicionales();
        habilitarEncuestaAdicionalesCierre();
    } else {
        document.getElementById('logistica-aplica-encuesta-adicionales').checked = false;
        deshabilitarEncuestaAdicionales();
        deshabilitarEncuestaAdicionalesCierre();
    }

    // Verificar si guia esta deshabilitado
    if (disenioTecnico.guia_aplica === 1) {
        document.getElementById('logistica-aplica-guia').checked = true;
        habilitarGuia();
        habilitarGuiaCierre();
    } else {
        document.getElementById('logistica-aplica-guia').checked = false;
        deshabilitarGuia();
        deshabilitarGuiaCierre();
    }

    // Verificar si prueba esta deshabilitado
    if (disenioTecnico.prueba_aplica === 1) {
        document.getElementById('logistica-aplica-prueba').checked = true;
        habilitarPrueba();
        habilitarPruebaCierre();
    } else {
        document.getElementById('logistica-aplica-prueba').checked = false;
        deshabilitarPrueba();
        deshabilitarPruebaCierre();
    }

    // Verificar si plumones esta deshabilitado
    if (checkMaterialRelator.plumones_aplica === 1) {
        document.getElementById('logistica-aplica-plumones').checked = true;
        habilitarPlumones();
        habilitarPlumonesCierre();
    } else {
        document.getElementById('logistica-aplica-plumones').checked = false;
        deshabilitarPlumones();
        deshabilitarPlumonesCierre();
    }

});