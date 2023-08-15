$(document).ready(function () {

    /**
     * Desplegar los archivos
     */
    window.mostrarArchivos = function(archivos,titulo) {
        // Poner el titulo
        document.getElementById('archivos-label').innerText = titulo;
        // Hacer una tabla de html con los archivos
        // Recorrer los cursos para crear las filas de la tabla
        var archivosHtml = '';
        archivos.forEach(function(archivo) {
            archivosHtml = archivosHtml + '<tr>' + '<td>' + archivo.codigo + '</td>' + '<td>' + archivo.nombre + '</td>' + '<td>' + archivo.tipo + '</td>' + '<td class="text-right"><a class="btn btn-primary btn-lime btn-sm" href="/servicio/descargar_documento/' + archivo.documento_id + '" title="Descargar"><i class="fas fa-file-download"></i></a></td>' + '</tr>';
        });
        // Hacer la tabla agregando las filas
        var html = '<table class="table">' + '<tbody>' + archivosHtml + '</tbody>' + '</table>';
        document.getElementById('archivos').innerHTML = html;
        // Activar el pop-up (modal)
        $('#modal-archivos').modal('toggle');
    }

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
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            }
        }
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

    // Arreglo con las encuestas adicionales
    var dataEncuestasAdicionales = $('#data-tag-encuesta-adicionales').data('data');
    // Convertir arreglo a string
    var dataEncuestasAdicionalesJson = JSON.stringify(dataEncuestasAdicionales);
    // Id del relator del servicio
    var dataEncuestasAdicionalesServicio = "[" + $('#data-tag-encuesta-adicionales-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectEncuestasAdicionales = $('#input-tags-encuesta-adicionales').selectize({
        persist: false,
        maxItems: null,
        valueField: 'id',
        labelField: 'codigo',
        items: JSON.parse(dataEncuestasAdicionalesServicio),
        options: JSON.parse(dataEncuestasAdicionalesJson)
    });
    var selectizeControlEncuestasAdicionales = selectEncuestasAdicionales[0].selectize;

    // Arreglo con las encuesta empresa
    var dataEncuestasEmpresa = $('#data-tag-encuesta-empresa').data('data');
    // Convertir arreglo a string
    var dataEncuestasEmpresaJson = JSON.stringify(dataEncuestasEmpresa);
    // Id del relator del servicio
    var dataEncuestasEmpresaServicio = "[" + $('#data-tag-encuesta-empresa-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectEncuestasEmpresa = $('#input-tags-encuesta-empresa').selectize({
        persist: false,
        maxItems: null,
        valueField: 'id',
        labelField: 'codigo',
        items: JSON.parse(dataEncuestasEmpresaServicio),
        options: JSON.parse(dataEncuestasEmpresaJson)
    });
    var selectizeControlEncuestasEmpresa = selectEncuestasEmpresa[0].selectize;

    // Arreglo con las encuesta ads
    var dataEncuestasAds = $('#data-tag-encuesta-ads').data('data');
    // Convertir arreglo a string
    var dataEncuestasAdsJson = JSON.stringify(dataEncuestasAds);
    // Id del relator del servicio
    var dataEncuestasAdsServicio = "[" + $('#data-tag-encuesta-ads-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectEncuestasAds = $('#select-beast-encuesta-ads').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataEncuestasAdsServicio),
        options: JSON.parse(dataEncuestasAdsJson),
        valueField: 'id',
        labelField: 'codigo',
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            }
        }
    });
    var selectizeControlEncuestasAds = selectEncuestasAds[0].selectize;

    var disenioTecnico = $('#data-tag-disenio-tecnico').data('data');

    // Cambiar los valores de los checkbox
    // Verificar si desabilitar la fila
    if (disenioTecnico.manual_aplica === 1) {
        document.getElementById('aplica-manual').checked = true;
        document.getElementById('text-manual').style.color = '#495057';
        document.getElementById('btn-archivos-manual').disabled = false;
    } else {
        document.getElementById('text-manual').style.color = 'grey';
        document.getElementById('btn-archivos-manual').disabled = true;
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.prueba_aplica === 1) {
        document.getElementById('aplica-prueba').checked = true;
        document.getElementById('text-prueba').style.color = '#495057';
        document.getElementById('btn-archivos-prueba').disabled = false;
    } else {
        document.getElementById('text-prueba').style.color = 'grey';
        document.getElementById('btn-archivos-prueba').disabled = true;
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.guia_aplica === 1) {
        document.getElementById('aplica-guia').checked = true;
        document.getElementById('text-guia').style.color = '#495057';
        document.getElementById('btn-archivos-guia').disabled = false;
    } else {
        document.getElementById('text-guia').style.color = 'grey';
        document.getElementById('btn-archivos-guia').disabled = true;
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.encuesta_adicionales_aplica === 1) {
        document.getElementById('aplica-encuesta-adicionales').checked = true;
        document.getElementById('text-encuesta-adicionales').style.color = '#495057';
        document.getElementById('btn-archivos-encuesta-adicionales').disabled = false;
    } else {
        document.getElementById('text-encuesta-adicionales').style.color = 'grey';
        document.getElementById('btn-archivos-encuesta-adicionales').disabled = true;
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.encuesta_empresa_aplica === 1) {
        document.getElementById('aplica-encuesta-empresa').checked = true;
        document.getElementById('text-encuesta-empresa').style.color = '#495057';
        document.getElementById('btn-archivos-encuesta-empresa').disabled = false;
    } else {
        document.getElementById('text-encuesta-empresa').style.color = 'grey';
        document.getElementById('btn-archivos-encuesta-empresa').disabled = true;
    }

    // if (disenioTecnico.diseno_tecnico_listo === '1') {
    //     document.getElementById('listo-disenio-tecnico').checked = true;
    // } else {
    //     document.getElementById('listo-disenio-tecnico').checked = false;
    // }

});