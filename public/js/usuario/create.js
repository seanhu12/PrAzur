$(document).ready(function () {

    /*
    * Validar que el input-tags no sea nulo
    */
    window.validarNotNull = function(notNull) {
        if (notNull != '') {
            window.document.getElementById('input-tags').setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById('input-tags-alert').innerText = 'El campo es obligatorio.';
            window.document.getElementById('input-tags').setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };

    /**
     * Valida que los datos cumplan con sus restricciones
     */
    function validarDatos() {
        var valido = true;
        if (!validarNoNulo(document.getElementById('nombre').value,'nombre')) {
            valido = false;
        } else {
            if(!validarNombre(document.getElementById('nombre').value,'nombre')){
                valido = false;
            }
        }
        if (!validarNoNulo(document.getElementById('apellido').value,'apellido')) {
            valido = false;
        } else {
            if(!validarApellido(document.getElementById('apellido').value,'apellido')){
                valido = false;
            }
        }
        if (!validarNoNulo(document.getElementById('mail').value,'mail')) {
            valido = false;
        } else {
            if(!validarEmail(document.getElementById('mail').value,'mail')){
                valido = false;
            }
        }
        if (!validarNoNulo(document.getElementById('rut').value,'rut')) {
            valido = false;
        } else {
            if(!validarRut(document.getElementById('rut').value,'rut')){
                valido = false;
            }
        }
        if (!validarNoNulo(document.getElementById('password').value,'password')) {
            valido = false;
        } else {
            if(!validarContrasenia(document.getElementById('password').value,'password')){
                valido = false;
            }
        }
        if (!validarNoNulo(document.getElementById('confirmar_password').value,'confirmar_password')) {
            valido = false;
        } else {
            if(!confirmarContrasenia(document.getElementById('confirmar_password').value,'confirmar_password')){
                valido = false;
            }
        }
        if(!validarNotNull(document.getElementById('input-tags').value)){
            valido = false;
        }
        return valido;
    }

    /**
     * Envia los datos del usuario
     */
    window.enviarDatos = function() {
        // Validaciones de los datos
        if (!validarDatos()) {
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos del usuario están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/usuario/store",
            data: {
                nombre: $('#nombre').val(),
                apellido: $('#apellido').val(),
                mail: $('#mail').val(),
                rut: $('#rut').val(),
                password: $('#password').val(),
                roles: selectizeControl.getValue(),
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/usuario");
            },
            error: function(xhr) {
                // console.log('ajax error');
                var error = '';
                if (!(typeof xhr.responseJSON.errors.mail === 'undefined')) {
                    error = xhr.responseJSON.errors.mail[0];
                    if (!(typeof xhr.responseJSON.errors.rut === 'undefined')) {
                        error = error + "<br>" + xhr.responseJSON.errors.rut[0];
                    }
                }
                else {
                    if (!(typeof xhr.responseJSON.errors.rut === 'undefined')) {
                        error = xhr.responseJSON.errors.rut[0];
                    }
                }
                document.getElementById('error_bd').innerHTML = error;
                document.getElementById('error_bd_contorno').hidden = false;
            }
        });
    };

    // Arreglo con los datos
    var data = $('#data-tag').data('data');
    // Convertir arreglo a string
    var dataJson = JSON.stringify(data);
    // Crear elinput-tag (selectize)
    var select = $('#input-tags').selectize({
        persist: false,
        maxItems: null,
        valueField: 'id',
        labelField: 'nombre',
        options: JSON.parse(dataJson),
        onChange: function() {
            if (selectizeControl.items.length !== 0) {
                window.document.getElementById('input-tags').setAttribute('class', 'form-control');
            }
        }
    });
    var selectizeControl = select[0].selectize;
});