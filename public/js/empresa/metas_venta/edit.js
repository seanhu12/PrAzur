$(document).ready(function () {

    $('#monto_meta').change(function() {
        this.setAttribute('class', 'form-control');
    });

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
        if(!validarNoNulo(document.getElementById('monto_meta').value,'monto_meta')){
            valido = false;
        }
        return valido;
    }

    /**
     * Envia los datos de la meta de venta
     */
    window.updateDatos = function(id) {
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
            url: "/metas_venta/update_meta/"+id,
            data: {
                monto_meta: quitarFormatoDinero($('#monto_meta').val())
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/metas_venta/"+result);
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

    document.getElementById('monto_meta').value = formatoDineroShow(quitarFormatoDinero(document.getElementById('monto_meta').value));

});