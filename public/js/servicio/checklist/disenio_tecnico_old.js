$(document).ready(function () {

    $('#aplica-manual').change(function() {
        if (document.getElementById('aplica-manual').checked) {
            document.getElementById('listo-manual').disabled = false;
            document.getElementById('text-manual').style.color = 'black';
            selectizeControlManual.enable();
        } else {
            document.getElementById('listo-manual').disabled = true;
            document.getElementById('text-manual').style.color = 'grey';
            selectizeControlManual.disable();
            selectizeControlManual.clear();
            document.getElementById('listo-manual').checked = false;
        }
    });

    $('#aplica-prueba').change(function() {
        if (document.getElementById('aplica-prueba').checked) {
            document.getElementById('listo-prueba').disabled = false;
            document.getElementById('text-prueba').style.color = 'black';
            selectizeControlPrueba.enable();
        } else {
            document.getElementById('listo-prueba').disabled = true;
            document.getElementById('text-prueba').style.color = 'grey';
            selectizeControlPrueba.disable();
            selectizeControlPrueba.clear();
            document.getElementById('listo-prueba').checked = false;
        }
    });

    $('#aplica-guia').change(function() {
        if (document.getElementById('aplica-guia').checked) {
            document.getElementById('listo-guia').disabled = false;
            document.getElementById('text-guia').style.color = 'black';
            selectizeControlGuia.enable();
        } else {
            document.getElementById('listo-guia').disabled = true;
            document.getElementById('text-guia').style.color = 'grey';
            selectizeControlGuia.disable();
            selectizeControlGuia.clear();
            document.getElementById('listo-guia').checked = false;
        }
    });

    $('#aplica-encuesta-diagnostica').change(function() {
        if (document.getElementById('aplica-encuesta-diagnostica').checked) {
            document.getElementById('listo-encuesta-diagnostica').disabled = false;
            document.getElementById('text-encuesta-diagnostica').style.color = 'black';
            selectizeControlEncuestasDiagnostica.enable();
        } else {
            document.getElementById('listo-encuesta-diagnostica').disabled = true;
            document.getElementById('text-encuesta-diagnostica').style.color = 'grey';
            selectizeControlEncuestasDiagnostica.disable();
            selectizeControlEncuestasDiagnostica.clear();
            document.getElementById('listo-encuesta-diagnostica').checked = false;
        }
    });

    $('#aplica-compras').change(function() {
        if (document.getElementById('aplica-compras').checked) {
            document.getElementById('text-compras').style.color = 'black';
            document.getElementById('compras').removeAttribute('readonly','');
        } else {
            document.getElementById('text-compras').style.color = 'grey';
            document.getElementById('compras').value = '';
            document.getElementById('compras').setAttribute('readonly','');
        }
    });

    // Arreglo con los datos de los relatores
    var dataRelator = $('#data-tag-relator').data('data');
    // Convertir arreglo a string
    var dataRelatorJson = JSON.stringify(dataRelator);
    // Id del relator del servicio
    var dataRelatorServicio = "[" + $('#data-tag-relator-servicio').data('data') + "]";
    var selectRelator = $('#select-beast-relator').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataRelatorServicio),
        options: JSON.parse(dataRelatorJson),
        valueField: 'id',
        labelField: 'nombre',
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.nombre) + ' '
                    + escape(item.apellido)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.nombre) + ' '
                    + escape(item.apellido)
                    + '</div>';
            }
        }
    });
    var selectizeControlRelator = selectRelator[0].selectize;

    // Arreglo con los datos de las estructuras del curso
    var dataEstructuras = $('#data-tag-estructura').data('data');
    // Convertir arreglo a string
    var dataEstructurasJson = JSON.stringify(dataEstructuras);
    // Id del relator del servicio
    var dataEstructuraServicio = "[" + $('#data-tag-estructura-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectEstructura = $('#select-beast-estructura').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataEstructuraServicio),
        options: JSON.parse(dataEstructurasJson),
        valueField: 'id',
        labelField: 'codigo',
    });
    var selectizeControlEstructuras = selectEstructura[0].selectize;

    // Arreglo con los manuales
    var dataManuales = $('#data-tag-manual').data('data');
    // Convertir arreglo a string
    var dataManualesJson = JSON.stringify(dataManuales);
    // Id del relator del servicio
    var dataManualesServicio = "[" + $('#data-tag-manual-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectManual = $('#input-tags-manual').selectize({
        persist: false,
        maxItems: null,
        valueField: 'id',
        labelField: 'codigo',
        items: JSON.parse(dataManualesServicio),
        options: JSON.parse(dataManualesJson)
    });
    var selectizeControlManual = selectManual[0].selectize;

    // Arreglo con las pruebas
    var dataPruebas = $('#data-tag-prueba').data('data');
    // Convertir arreglo a string
    var dataPruebasJson = JSON.stringify(dataPruebas);
    // Id del relator del servicio
    var dataPruebasServicio = "[" + $('#data-tag-prueba-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectPrueba = $('#input-tags-prueba').selectize({
        persist: false,
        maxItems: null,
        valueField: 'id',
        labelField: 'codigo',
        items: JSON.parse(dataPruebasServicio),
        options: JSON.parse(dataPruebasJson)
    });
    var selectizeControlPrueba = selectPrueba[0].selectize;

    // Arreglo con las guias
    var dataGuias = $('#data-tag-guia').data('data');
    // Convertir arreglo a string
    var dataGuiasJson = JSON.stringify(dataGuias);
    // Id del relator del servicio
    var dataGuiasServicio = "[" + $('#data-tag-guia-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectGuia = $('#input-tags-guia').selectize({
        persist: false,
        maxItems: null,
        valueField: 'id',
        labelField: 'codigo',
        items: JSON.parse(dataGuiasServicio),
        options: JSON.parse(dataGuiasJson)
    });
    var selectizeControlGuia = selectGuia[0].selectize;

    // Arreglo con las encuestas
    var dataEncuestasDiagnostica = $('#data-tag-encuesta-diagnostica').data('data');
    // Convertir arreglo a string
    var dataEncuestasDiagnosticaJson = JSON.stringify(dataEncuestasDiagnostica);
    // Id del relator del servicio
    var dataEncuestasDiagnosticaServicio = "[" + $('#data-tag-encuesta-diagnostica-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectEncuestasDiagnostica = $('#input-tags-encuesta-diagnostica').selectize({
        persist: false,
        maxItems: null,
        valueField: 'id',
        labelField: 'codigo',
        items: JSON.parse(dataEncuestasDiagnosticaServicio),
        options: JSON.parse(dataEncuestasDiagnosticaJson)
    });
    var selectizeControlEncuestasDiagnostica = selectEncuestasDiagnostica[0].selectize;

    var disenioTecnico = $('#data-tag-disenio-tecnico').data('data');

    // Cambiar los valores de los checkbox
    // Verificar si desabilitar la fila
    if (disenioTecnico.manual_aplica === 1) {
        document.getElementById('aplica-manual').checked = true;
        document.getElementById('listo-manual').disabled = false;
        document.getElementById('text-manual').style.color = 'black';
        selectizeControlManual.enable();
    } else {
        document.getElementById('listo-manual').disabled = true;
        document.getElementById('text-manual').style.color = 'grey';
        selectizeControlManual.disable();
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.prueba_aplica === 1) {
        document.getElementById('aplica-prueba').checked = true;
        document.getElementById('listo-prueba').disabled = false;
        document.getElementById('text-prueba').style.color = 'black';
        selectizeControlPrueba.enable();
    } else {
        document.getElementById('listo-prueba').disabled = true;
        document.getElementById('text-prueba').style.color = 'grey';
        selectizeControlPrueba.disable();
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.guia_aplica === 1) {
        document.getElementById('aplica-guia').checked = true;
        document.getElementById('listo-guia').disabled = false;
        document.getElementById('text-guia').style.color = 'black';
        selectizeControlGuia.enable();
    } else {
        document.getElementById('listo-guia').disabled = true;
        document.getElementById('text-guia').style.color = 'grey';
        selectizeControlGuia.disable();
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.encuesta_diagnostica_aplica === 1) {
        document.getElementById('aplica-encuesta-diagnostica').checked = true;
        document.getElementById('listo-encuesta-diagnostica').disabled = false;
        document.getElementById('text-encuesta-diagnostica').style.color = 'black';
        selectizeControlEncuestasDiagnostica.enable();
    } else {
        document.getElementById('listo-encuesta-diagnostica').disabled = true;
        document.getElementById('text-encuesta-diagnostica').style.color = 'grey';
        selectizeControlEncuestasDiagnostica.disable();
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.compras_aplica === 1) {
        document.getElementById('aplica-compras').checked = true;
        document.getElementById('text-compras').style.color = 'black';
        document.getElementById('compras').removeAttribute('readonly','');
    } else {
        document.getElementById('text-compras').style.color = 'grey';
        document.getElementById('compras').value = '';
        document.getElementById('compras').setAttribute('readonly','');
    }

    if (disenioTecnico.relator_listo === '1') {
        document.getElementById('listo-relator').checked = true;
    }

    if (disenioTecnico.estructura_curso_listo === '1') {
        document.getElementById('listo-estructura').checked = true;
    }

    if (disenioTecnico.manual_listo === '1') {
        document.getElementById('listo-manual').checked = true;
    }

    if (disenioTecnico.prueba_listo === '1') {
        document.getElementById('listo-prueba').checked = true;
    }

    if (disenioTecnico.guia_listo === '1') {
        document.getElementById('listo-guia').checked = true;
    }

    if (disenioTecnico.encuesta_diagnostica_listo === '1') {
        document.getElementById('listo-encuesta-diagnostico').checked = true;
    }

});