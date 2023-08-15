$(document).ready(function () {

    $('#buscar-anio').mask('0000');

    /**
     * Cambiar color table header
     */
    $('tr').each(function () {
        $(this).find('th').addClass('blue');
    })


    var metas = $('#metas').data('data');
    metas.forEach(meta => {
        // console.log(formatoDineroShow(document.getElementById('monto'+meta.id).innerText));
        document.getElementById('monto'+meta.id).innerText = formatoDineroShow(document.getElementById('monto'+meta.id).innerText);
    });

    /**
     * Dynatable
     */
    var dynatable = $('#tabla')
        .bind('dynatable:init', function(e, dynatable) {

            dynatable.queries.functions['buscar-anio'] = function(record, queryValue) {
                return queryValue === record.año;
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
                'montoSort': function(el, record) {
                    return Number(el.innerHTML) || 0;
                }
            },
            inputs: {
                queries: $('#buscar-anio'),
            }
        }).data('dynatable');

    /**
     * Remueve el filtro del año
     */
    window.removerFiltroAnio = function() {
        document.getElementById('buscar-anio').value = '';
        document.getElementById('buscar-anio').focus();
        document.getElementById('buscar-anio').blur();
    }




});