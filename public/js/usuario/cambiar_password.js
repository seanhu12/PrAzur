$(document).ready(function () {
    /**
     * Envia los datos del usuario
     */
    window.enviarDatos = function(id) {
        // Validaciones de los datos
        var noValido = false;
        if (!validarNoNulo(document.getElementById('password').value,'password')) {
            noValido = true;
        } else {
            if(!validarContrasenia(document.getElementById('password').value,'password')){
                noValido = true;
            }
        }
        if (!validarNoNulo(document.getElementById('confirmar_password').value,'confirmar_password')) {
            noValido = true;
        } else {
            if(!confirmarContrasenia(document.getElementById('confirmar_password').value)){
                noValido = true;
            }
        }
        if (noValido) {
            return;
        }
        // // Confirmacion de datos
        // var respuesta = confirm("¿Esta seguro que la contraseña del usuario esta correcta?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/usuario/actualizar_password/" + id,
            data: {
                password: $('#password').val()
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/usuario/show/"+id);
            },
            error: function(xhr) {
                // console.log('ajax error')
                var error = '';
            }
        });
    };
});