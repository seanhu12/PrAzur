$(document).ready(function () {
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
            dynatable.queries.functions['select-beast-empresa'] = function (record, queryValue) {
                var nombre;
                dataEmpresaJson.forEach(empresa =>{
                    if(empresa.id == queryValue){
                    nombre = empresa.nombre;
                }
            })
                ;
                return nombre === record.empresa;
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
                queries: $('#select-beast-empresa'),
            }
        }).data('dynatable');


    /**
     * Remueve el filtro de la empresa
     */
    window.removerFiltroEmpresa = function () {
        selectizeControlEmpresa.clear();
    }

});