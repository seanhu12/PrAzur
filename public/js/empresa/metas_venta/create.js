$(document).ready(function () {

    $('#anio').mask('0000');

    $('#monto_meta').change(function() {
        this.setAttribute('class', 'form-control');
    });

    // Convertir arreglo a string
    var meses = [{
        "nombre": "Enero",
        "id": 1,
    }, {
        "nombre": "Febrero",
        "id": 2,
    }, {
        "nombre": "Marzo",
        "id": 3,
    }, {
        "nombre": "Abril",
        "id": 4,
    }, {
        "nombre": "Mayo",
        "id": 5,
    }, {
        "nombre": "Junio",
        "id": 6,
    }, {
        "nombre": "Julio",
        "id": 7,
    }, {
        "nombre": "Agosto",
        "id": 8,
    }, {
        "nombre": "Septiembre",
        "id": 9,
    }, {
        "nombre": "Octubre",
        "id": 10,
    }, {
        "nombre": "Noviembre",
        "id": 11,
    }, {
        "nombre": "Diciembre",
        "id": 12,
    }];
    var selectMes = $('#select_beast_meses').selectize({
        create: false,
        searchField: 'nombre',
        options: meses,
        valueField: 'id',
        labelField: 'nombre',
        onChange: function() {
            document.getElementById('select_beast_meses').setAttribute('class','form-control');
        }
    });
    var selectizeControlMeses = selectMes[0].selectize;


    $('#monto_meta').keyup(function() {
        var cantHoras = document.getElementById('monto_meta');
        var numeroCantHoras = cantHoras.value;
        cantHoras.value = formatoDineroInput(numeroCantHoras);
    });

    /**
     * Validacion de los datos
     */
    function validarDatos() {
        var valido = true;
        if(!validarNoNulo(document.getElementById('anio').value, 'anio')) {
            valido = false;
        } else {
            if(!validarAnioFuturo(document.getElementById('anio').value,'anio')){
                valido = false;
            }
        }
        // console.log(selectizeControlMeses.items);
        if(!validarNoNulo(selectizeControlMeses.items.length, 'select_beast_meses')) {
            valido = false;
        }
        if(!validarNoNulo(document.getElementById('monto_meta').value,'monto_meta')){
            valido = false;
        }
        return valido;
    }

    /**
     * Envia los datos de la meta de venta
     */
    window.enviarDatos = function(id) {
        // Validaciones de los datos
        if(!validarDatos()){
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que la meta ingresada está correcta?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/metas_venta/store_meta/"+id,
            data: {
                anio: $('#anio').val(),
                mes: selectizeControlMeses.getValue(),
                monto_meta: quitarFormatoDinero($('#monto_meta').val())
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/metas_venta/"+id);
            },
            error: function(xhr) {
                var error = '';
                if(xhr.responseJSON.responseText===undefined){
                    error= error + "Ya existe una meta para esta empresa en ese año y mes."
                }else{
                    if (!(typeof xhr.responseJSON.errors.anio === 'undefined')) {
                        error = xhr.responseJSON.errors.anio[0];
                        error= error.replace("anio","año");
                        if (!(typeof xhr.responseJSON.errors.mes === 'undefined')) {
                            error = error + "<br>" + xhr.responseJSON.errors.mes[0];
                        }
                    }
                    else {
                        if (!(typeof xhr.responseJSON.errors.mes === 'undefined')) {
                            error = xhr.responseJSON.errors.mes[0];
                        }
                    }
                }
                window.document.getElementById('error_bd').setAttribute('class', 'alert alert-danger');
                document.getElementById('error_bd').innerHTML = error;
                document.getElementById('error_bd').style.visibility = "visible";
                document.getElementById('error_bd_contorno').style.visibility = "visible";
            }
        });
    };
});