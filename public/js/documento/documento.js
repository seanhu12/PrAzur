$(document).ready(function () {
    // Select tipos
    // Arreglo con los datos
    var dataTipo = $('#data-tag-tipo').data('data');
    // Convertir arreglo a string
    var dataTipoJson = JSON.stringify(dataTipo);
    // Convertir arreglo a json
    var dataTipoJson = JSON.parse(dataTipoJson)
    // Crear elinput-tag (selectize)
    var selectTipo = $('#select-beast-tipo').selectize({
        create: false,
        searchField: 'nombre',
        options: dataTipoJson,
        valueField: 'id',
        labelField: 'nombre',
        allowEmptyOption: true
    });
    var selectizeControlTipo = selectTipo[0].selectize;
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
            dynatable.queries.functions['select-beast-tipo'] = function (record, queryValue) {
                var nombre;
                dataTipoJson.forEach(tipo =>{
                    if(tipo.id == queryValue){
                    nombre = tipo.nombre;
                }
            })
                ;
                // console.log(record);
                return nombre === record.tipo;
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
            readers: {
                'id': function(el, record) {
                    return Number(el.innerHTML) || 0;
                }
            },
            inputs: {
                queries: $('#select-beast-tipo'),
            }
        }).data('dynatable');

    /**
     * Remueve el filtro de la empresa
     */
    window.removerFiltroTipo = function () {
        selectizeControlTipo.clear();
    }
});