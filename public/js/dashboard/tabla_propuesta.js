$(document).ready(function() {

    $('#ocultar-propuesta').click(function() {
        document.getElementById('propuesta').hidden = true;
        document.getElementById('ocultar-propuesta').hidden = true;
        document.getElementById('mostrar-propuesta').hidden = false;
        // document.getElementById('filtro-propuesta').hidden = true;
        document.getElementById('filtro-fecha-inicio-propuesta').hidden = true;
        document.getElementById('filtro-fecha-termino-propuesta').hidden = true;
        document.getElementById('filtro-estado').hidden = true;
    });

    $('#mostrar-propuesta').click(function() {
        document.getElementById('propuesta').hidden = false;
        document.getElementById('mostrar-propuesta').hidden = true;
        document.getElementById('ocultar-propuesta').hidden = false;
        // document.getElementById('filtro-propuesta').hidden = false;
        document.getElementById('filtro-fecha-inicio-propuesta').hidden = false;
        document.getElementById('filtro-fecha-termino-propuesta').hidden = false;
        document.getElementById('filtro-estado').hidden = false;
    });

    /**
     * Cambiar color table header
     */
    $('tr').each(function(){
        $(this).find('th').addClass('blue');
    })

    /**
     * Dynatable
     */
    var dynatable = $('#tabla-propuesta')
    .bind('dynatable:init', function(e, dynatable) {
        dynatable.queries.functions['select-beast-estado'] = function(record, queryValue) {
            var nombre;
            dataEstadoJson.forEach(estado => {
                if (estado.id == queryValue) {
                    nombre = estado.nombre;
                }
            });
            return nombre === record.estado;
        };
        dynatable.queries.functions['fecha-inicio-propuesta'] = function(record, queryValue) {
            var parts = record.fecha_Compromiso.split('-');
            var fechaRecord = new Date(parts[2],parts[1] - 1, parts[0]);
            var fechaQuery = new Date(queryValue);
            return fechaRecord >= fechaQuery;
        };
        dynatable.queries.functions['fecha-termino-propuesta'] = function(record, queryValue) {
            var parts = record.fecha_Compromiso.split('-');
            var fechaRecord = new Date(parts[2],parts[1] - 1, parts[0]);
            var fechaQuery = new Date(queryValue);
            return fechaRecord <= fechaQuery;
        };
    })
    .dynatable({
        features: {
            paginate: true,
            recordCount: true,
            sorting: true,
            search: true,
            perPageSelect: true
        },
        inputs: {
            queries: $('#select-beast-estado, #fecha-inicio-propuesta, #fecha-termino-propuesta'),
            // queries: $('#select-beast-estado'),
        },
        readers: {
            'idp': function(el, record) {
                return Number(el.innerHTML) || 0;
            }
        }
    }).data('dynatable');

    /**
     * Remueve el filtro del estado
     */
    window.removerFiltroEstado = function() {
        selectizeControlEstado.clear();
    }

    /**
     * Remueve el filtro de la fecha incio
     */
    window.removerFiltroFechaInicioPropuesta = function() {
        document.getElementById('fecha-inicio-propuesta').value = '';
        document.getElementById('fecha-inicio-propuesta').focus();
        document.getElementById('fecha-inicio-propuesta').blur();
    }

    /**
     * Remueve el filtro de la fecha termino
     */
    window.removerFiltroFechaTerminoPropuesta = function() {
        document.getElementById('fecha-termino-propuesta').value = '';
        document.getElementById('fecha-termino-propuesta').focus();
        document.getElementById('fecha-termino-propuesta').blur();
    }

    // Select estados
    // Arreglo con los datos
    var dataEstado = $('#data-tag-estado').data('data');
    // Convertir arreglo a string
    var dataEstadoJson = JSON.stringify(dataEstado);
    // Convertir arreglo a json
    var dataEstadoJson = JSON.parse(dataEstadoJson)
    // Crear elinput-tag (selectize)
    var selectEstado = $('#select-beast-estado').selectize({
        create: false,
        searchField: 'nombre',
        options: dataEstadoJson,
        valueField: 'id',
        labelField: 'nombre',
        allowEmptyOption: true
    });
    var selectizeControlEstado = selectEstado[0].selectize;
});