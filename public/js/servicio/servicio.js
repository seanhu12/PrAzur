$(document).ready(function() {
    /**
     * Cambiar color table header
     */
    $('tr').each(function(){
        $(this).find('th').addClass('blue');
    })

    /**
     * Dynatable
     */
    var dynatable = $('#tabla')
    .bind('dynatable:init', function(e, dynatable) {
        dynatable.queries.functions['select-beast-estado'] = function(record, queryValue) {
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
        dynatable.queries.functions['select-beast-empresa'] = function(record, queryValue) {
            var nombre;
            dataEmpresaJson.forEach(empresa => {
                if (empresa.id == queryValue) {
                    nombre = empresa.nombre;
                }
            });
            return nombre === record.empresa;
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
        dynatable.queries.functions['select-beast-curso'] = function(record, queryValue) {
            var nombre;
            dataCursoJson.forEach(curso => {
                if (curso.id == queryValue) {
                    nombre = curso.nombre_venta;
                }
            });
            return nombre === $.trim(record.curso);
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
            queries: $('#select-beast-estado, #select-beast-empresa, #select-beast-etapa, #select-beast-curso, #fecha-inicio, #fecha-termino'),
        },
        readers: {
            'ot': function(el, record) {
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
    window.removerFiltroEstado = function() {
        selectizeControlEstado.clear();
    }

    /**
     * Remueve el filtro de la empresa
     */
    window.removerFiltroEmpresa = function() {
        selectizeControlEmpresa.clear();
    }

    /**
     * Remueve el filtro de la programa
     */
    window.removerFiltroEtapa = function() {
        selectizeControlEtapa.clear();
    }

    /**
     * Remueve el filtro de la curso
     */
    window.removerFiltroCurso = function() {
        selectizeControlCurso.clear();
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

    // Select empresas
    // Arreglo con los datos
    var dataEmpresa = $('#data-tag-empresa').data('data');
    // Convertir arreglo a string
    var dataEmpresaJson = JSON.stringify(dataEmpresa);
    // Convertir arreglo a json
    var dataEmpresaJson = JSON.parse(dataEmpresaJson)
    // Crear elinput-tag (selectize)
    var selectEmpresa = $('#select-beast-empresa').selectize({
        create: false,
        searchField: 'nombre',
        options: dataEmpresaJson,
        valueField: 'id',
        labelField: 'nombre',
        allowEmptyOption: true
    });
    var selectizeControlEmpresa = selectEmpresa[0].selectize;

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

    // Select curso
    // Arreglo con los datos
    var dataCurso = $('#data-tag-curso').data('data');
    // Convertir arreglo a string
    var dataCursoJson = JSON.stringify(dataCurso);
    // Convertir arreglo a json
    var dataCursoJson = JSON.parse(dataCursoJson)
    // Crear elinput-tag (selectize)
    var selectCurso = $('#select-beast-curso').selectize({
        create: false,
        searchField: 'nombre_venta',
        options: dataCursoJson,
        valueField: 'id',
        labelField: 'nombre_venta',
        allowEmptyOption: true
    });
    var selectizeControlCurso = selectCurso[0].selectize;
});