$(document).ready(function () {

    // Arreglo con los datos
    var dataEmpresa = $('#data-tag-empresa').data('data');
    // Convertir arreglo a json
    var dataEmpresaJson = JSON.stringify(dataEmpresa);
    // Convertir arreglo a json
    dataEmpresaJson = JSON.parse(dataEmpresaJson);
    // Crear elinput-tag (selectize)
    var selectEmpresa = $('#select-beast-empresas').selectize({
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
            dynatable.queries.functions['select-beast-empresas'] = function (record, queryValue) {
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
                queries: $('#select-beast-empresas'),
            }
        }).data('dynatable');


    /**
     * Remueve el filtro de la empresa
     */
    window.removerFiltroEmpresa = function () {
        selectizeControlEmpresa.clear();
    }

});