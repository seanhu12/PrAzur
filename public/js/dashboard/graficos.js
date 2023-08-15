
$(document).ready(function(){

    var cantServiciosMes = $('#data-tag-servicios-mes').data('data');
    var cantServiciosMes = JSON.parse(JSON.stringify(cantServiciosMes));

    var meses = $('#data-tag-meses').data('data');
    var meses = JSON.parse(JSON.stringify(meses));

    var serviciosMes = c3.generate({
        bindto: '#servicios-mes',
        data: {
            columns: [
                cantServiciosMes
            ],
            type: 'bar', // default type of chart
            colors: {
                'servicios': '#17a2b8'
            },
            names: {
                // name of each serie
                'servicios': 'Servicios'
            },
            labels: true
        },
        size: {
            height: 200
        },
        axis: {
            x: {
                type: 'category',
                // name of each category
                categories: meses
            },
        },
        bar: {
            width: {
                ratio: 0.5 // this makes bar width 50% of length between ticks
            }
        },
        legend: {
            show: false, //hide legend
        }
    });

    var cantServiciosEtapa = $('#data-tag-servicios-etapa').data('data');
    var cantServiciosEtapa = JSON.parse(JSON.stringify(cantServiciosEtapa));

    var serviciosEtapa = c3.generate({
        bindto: '#servicios-etapa',
        data: {
            columns: [
                cantServiciosEtapa
            ],
            type: 'bar', // default type of chart
            colors: {
                'servicios': '#17a2b8'
            },
            names: {
                // name of each serie
                'servicios': 'Servicios'
            },
            labels: true
        },
        size: {
            height: 200
        },
        axis: {
            x: {
                type: 'category',
                // name of each category
                categories: ['Diseño', 'Logística', 'Preparado', 'Ejecución', 'Cierre']
            },
        },
        bar: {
            width: {
                ratio: 0.5 // this makes bar width 50% of length between ticks
            }
        },
        legend: {
            show: false, //hide legend
        }
    });
});