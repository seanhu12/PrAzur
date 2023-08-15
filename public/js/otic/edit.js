$(document).ready(function () {

    $('#telefono_fijo').mask('000 000 0000');

    $('#celular').mask('+000 0000 0000');

    $('#nombre').change(function() {
        window.document.getElementById('nombre').setAttribute('class', 'form-control');
    });

    function validarDatos() {
        var valido = true;
        if(!validarNoNulo(document.getElementById('nombre').value,'nombre')){
            valido = false;
        }
        if(!validarEmail(document.getElementById('mail').value,'mail')){
            valido = false;
        }
        if(!validarNoNulo(document.getElementById('rut').value,'rut')){
            valido = false;
        } else {
            if(!validarRut(document.getElementById('rut').value)){
                valido = false;
            }
        }
        if(!validarTelefonoFijo(document.getElementById('telefono_fijo').value,'telefono_fijo')){
            valido = false;
        }
        if(!validarTelefonoFijo(document.getElementById('celular').value,'celular')){
            valido = false;
        }
        return valido;
    }

    /**
     * Envia los datos de la otic
     */
    window.enviarDatos = function(id) {
        // Validaciones de los datos
        if(!validarDatos()){
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos de la OTIC están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/otic/update/"+ id,
            data: {
                nombre: $('#nombre').val(),
                mail: $('#mail').val(),
                direccion: $('#direccion').val(),
                telefono_fijo: $('#telefono_fijo').val(),
                celular: $('#celular').val()
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/otic/show/"+ id);
            },
            error: function(xhr) {
                var error = '';
                if (!(typeof xhr.responseJSON.errors.rut === 'undefined')) {
                    error = xhr.responseJSON.errors.rut[0];
                }
                window.document.getElementById('error_bd').setAttribute('class', 'alert alert-danger');
                document.getElementById('error_bd').innerHTML = error;
                document.getElementById('error_bd').style.visibility = "visible";
                document.getElementById('error_bd_contorno').style.visibility = "visible";
            }
        });
    };
});