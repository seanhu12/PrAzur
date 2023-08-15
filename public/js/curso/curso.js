$(document).ready(function () {

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
            }
        }).data('dynatable');

});