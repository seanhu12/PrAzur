$(document).ready(function() {

    $('#ocultar-servicio').click(function() {
        document.getElementById('servicio').hidden = true;
        document.getElementById('ocultar-servicio').hidden = true;
        document.getElementById('mostrar-servicio').hidden = false;
        // document.getElementById('filtro-servicio').hidden = true;
        document.getElementById('filtro-estado-operacional').hidden = true;
        document.getElementById('filtro-fecha-inicio-servicio').hidden = true;
        document.getElementById('filtro-fecha-termino-servicio').hidden = true;
        document.getElementById('filtro-etapa').hidden = true;
    });

    $('#mostrar-servicio').click(function() {
        document.getElementById('servicio').hidden = false;
        document.getElementById('mostrar-servicio').hidden = true;
        document.getElementById('ocultar-servicio').hidden = false;
        // document.getElementById('filtro-servicio').hidden = false;
        document.getElementById('filtro-estado-operacional').hidden = false;
        document.getElementById('filtro-fecha-inicio-servicio').hidden = false;
        document.getElementById('filtro-fecha-termino-servicio').hidden = false;
        document.getElementById('filtro-etapa').hidden = false;
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
    var dynatable = $('#tabla-servicio')
    .bind('dynatable:init', function(e, dynatable) {
        dynatable.queries.functions['select-beast-estado-operacional'] = function(record, queryValue) {
            var nombre;
            dataEstadoJson.forEach(estado => {
                if (estado.id == queryValue) {
                    nombre = estado.nombre;
                }
            });
            if (record.estado.search(nombre) != -1) {
                return true;
            }
            return false;
        };
        dynatable.queries.functions['select-beast-etapa'] = function(record, queryValue) {
            var nombre;
            dataEtapaJson.forEach(etapa => {
                if (etapa.id == queryValue) {
                    nombre = etapa.nombre;
                }
            });
            if (record.etapa.search(nombre) != -1) {
                return true;
            }
            return false;
        };
        dynatable.queries.functions['fecha-inicio'] = function(record, queryValue) {
            var parts = record.fechaEjecución.split('-');
            var fechaRecord = new Date(parts[2],parts[1] - 1, parts[0]);
            var fechaQuery = new Date(queryValue);
            return fechaRecord >= fechaQuery;
        };
        dynatable.queries.functions['fecha-termino'] = function(record, queryValue) {
            var parts = record.fechaEjecución.split('-');
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
            queries: $('#select-beast-estado-operacional, #select-beast-etapa, #fecha-inicio, #fecha-termino'),
        },
        readers: {
            'id': function(el, record) {
                return Number(el.innerHTML) || 0;
            },
            'idp': function(el, record) {
                return Number(el.innerHTML) || 0;
            }
        }
    }).data('dynatable');

    /**
     * Remueve el filtro del estado
     */
    window.removerFiltroEstadoOperacional = function() {
        selectizeControlEstadoOperacional.clear();
    }

    /**
     * Remueve el filtro de la etapa
     */
    window.removerFiltroEtapa = function() {
        selectizeControlEtapa.clear();
    }

    /**
     * Remueve el filtro de la fecha incio
     */
    window.removerFiltroFechaInicio = function() {
        document.getElementById('fecha-inicio').value = '';
        document.getElementById('fecha-inicio').focus();
        document.getElementById('fecha-inicio').blur();
    }

    /**
     * Remueve el filtro de la fecha termino
     */
    window.removerFiltroFechaTermino = function() {
        document.getElementById('fecha-termino').value = '';
        document.getElementById('fecha-termino').focus();
        document.getElementById('fecha-termino').blur();
    }

    // Select estados
    // Arreglo con los datos
    var dataEstado = $('#data-tag-estado-operacional').data('data');
    // Convertir arreglo a string
    var dataEstadoJson = JSON.stringify(dataEstado);
    // Convertir arreglo a json
    var dataEstadoJson = JSON.parse(dataEstadoJson)
    // Crear elinput-tag (selectize)
    var selectEstado = $('#select-beast-estado-operacional').selectize({
        create: false,
        searchField: 'nombre',
        options: dataEstadoJson,
        valueField: 'id',
        labelField: 'nombre',
        allowEmptyOption: true
    });
    var selectizeControlEstadoOperacional = selectEstado[0].selectize;

    // Select etapas
    // Arreglo con los datos
    var dataEtapa = $('#data-tag-etapa').data('data');
    // Convertir arreglo a string
    var dataEtapaJson = JSON.stringify(dataEtapa);
    // Convertir arreglo a json
    var dataEtapaJson = JSON.parse(dataEtapaJson)
    // Crear elinput-tag (selectize)
    var selectEtapa = $('#select-beast-etapa').selectize({
        create: false,
        searchField: 'nombre',
        options: dataEtapaJson,
        valueField: 'id',
        labelField: 'nombre',
        allowEmptyOption: true
    });
    var selectizeControlEtapa = selectEtapa[0].selectize;
});