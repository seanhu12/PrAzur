$(document).ready(function () {
    // Select tematicas
    // Arreglo con los datos
    var dataTematica = $('#data-tag-tematica').data('data');
    // Convertir arreglo a string
    var dataTematicaJson = JSON.stringify(dataTematica);
    // Convertir arreglo a json
    dataTematicaJson = JSON.parse(dataTematicaJson)
    // Crear elinput-tag (selectize)
    var selectTematica = $('#select-beast-tematica').selectize({
        create: false,
        searchField: 'nombre',
        options: dataTematicaJson,
        valueField: 'id',
        labelField: 'nombre',
        allowEmptyOption: true
    });
    var selectizeControlTematica = selectTematica[0].selectize;

    /**
     * Cambiar color table header
     */
    $('tr').each(function () {
        $(this).find('th').addClass('blue');
    })

    /**
     * Dynatable
     */
    var dynatable = $('#tabla')
        .bind('dynatable:init', function (e, dynatable) {
            dynatable.queries.functions['select-beast-tematica'] = function (record, queryValue) {
                var nombre;
                dataTematicaJson.forEach(tematica =>{
                    if(tematica.id == queryValue){
                    nombre = tematica.nombre;
                }
            });
                if (record.temáticas.search(nombre) != -1) {
                    return true;
                }
                return false;
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
                queries: $('#select-beast-tematica'),
            },
            readers: {
                'id': function(el, record) {
                    return Number(el.innerHTML) || 0;
                }
            }
        }).data('dynatable');


    /**
     * Remueve el filtro de la temática
     */
    window.removerFiltroTematica = function () {
        selectizeControlTematica.clear();
    }

});