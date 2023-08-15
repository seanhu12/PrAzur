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
    // .bind('dynatable:init', function(e, dynatable) {
    //     dynatable.queries.functions['inactivos'] = function(record, queryValue) {
    //         return queryValue === $.trim(record.estado);
    //     };
    // })
    .dynatable({
        features: {
            paginate: true,
            recordCount: true,
            sorting: true,
            search: true,
            perPageSelect: true
        },
        // inputs: {
        //     queries: $('#inactivos'),
        // }
    }).data('dynatable');

    // $('#inactivos').change(function() {
    //     if(!document.getElementById('inactivos').checked) {
    //         document.getElementById('inactivos').value = '';
    //         document.getElementById('inactivos').focus();
    //         document.getElementById('inactivos').blur();
    //     } else {
    //         document.getElementById('inactivos').value = 'Activo';
    //         document.getElementById('inactivos').focus();
    //         document.getElementById('inactivos').blur();
    //     }
    // });

    // document.getElementById('inactivos').value = 'Activo';
    // document.getElementById('inactivos').checked = true;
    // document.getElementById('inactivos').focus();
    // document.getElementById('inactivos').blur();
});