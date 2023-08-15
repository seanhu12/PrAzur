$(document).ready(function () {
    // Select otics
    // Arreglo con los datos
    var dataOtic = $('#data-tag-otic').data('data');
    // Convertir arreglo a string
    var dataOticJson = JSON.stringify(dataOtic);
    // Convertir arreglo a json
    var dataOticJson = JSON.parse(dataOticJson)
    // Crear elinput-tag (selectize)
    var selectOtic = $('#select-beast-otic').selectize({
        create: false,
        searchField: 'nombre',
        options: dataOticJson,
        valueField: 'id',
        labelField: 'nombre',
        allowEmptyOption: true
    });
    var selectizeControlOtic = selectOtic[0].selectize;

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
            dynatable.queries.functions['select-beast-otic'] = function (record, queryValue) {
                var nombre;
                dataOticJson.forEach(otic =>{
                    if(otic.id == queryValue){
                    nombre = otic.nombre;
                }
            })
                ;
                return nombre === record.otic;
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
                queries: $('#select-beast-otic'),
            }
        }).data('dynatable');


    /**
     * Remueve el filtro de la otic
     */
    window.removerFiltroOtic = function () {
        selectizeControlOtic.clear();
    }

});