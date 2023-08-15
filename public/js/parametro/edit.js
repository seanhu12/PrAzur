$(document).ready(function () {

    window.formatoNumero = function(id) {
        var campo = document.getElementById(id);
        var numero = campo.value;
        campo.value = formatoDecimalInput(numero);
    };

    var etapas = $('#etapas').data('data');
    var parametros = $('#parametros').data('data');

    /**
     * Envia los datos de los parámetros y etapas
     */
    window.enviarDatos = function(id) {
        var noValido=false;
        //Validar etapas
        etapas.forEach(etapa => {
            if(!validarNoNulo(document.getElementById('etapa'+etapa.id).value,'etapa'+etapa.id)){
                noValido=true;
            }else{
                if(!validarNumero(document.getElementById('etapa'+etapa.id).value,'etapa'+etapa.id)){
                    noValido=true;
                }else{
                    etapa.tiempo_limite= document.getElementById('etapa'+etapa.id).value;
                }
            }
        });
        //Validar parametro
        parametros.forEach(parametro => {
            if(!validarNoNulo(document.getElementById('parametro'+parametro.id).value,'parametro'+parametro.id)){
                noValido=true;
            }else{
                if(!validarNumero(document.getElementById('parametro'+parametro.id).value,'parametro'+parametro.id)){
                    noValido=true;
                }else{
                    parametro.tiempo_limite= document.getElementById('parametro'+parametro.id).value;
                }
            }
        });
        if(noValido){
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/parametro/update_parametros",
            data: {
                etapas: etapas,
                parametros: parametros,
            },
            success: function(result) {
                // console.log('ajax ok');
                document.getElementById('success_bd_contorno').hidden = false;
            },
            error: function(xhr) {
                // console.log('ajax error');
                document.getElementById('error_bd_contorno').hidden = false;
            }
        });
    };


});