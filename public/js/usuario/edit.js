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
        if(!validarNotNull(document.getElementById('input-tags').value)){
            valido = false;
        }
        return valido;
    }

    /**
     * Envia los datos del usuario
     */
    window.enviarDatos = function(id) {
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
            url: "/usuario/update/" + id,
            data: {
                nombre: $('#nombre').val(),
                apellido: $('#apellido').val(),
                mail: $('#mail').val(),
                password: $('#password').val(),
                roles: selectizeControl.getValue(),
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/usuario/show/"+id);
            },
            error: function(xhr) {
                // console.log('ajax error')
                var error = '';
                if (!(typeof xhr.responseJSON.errors.mail === 'undefined')) {
                    error = xhr.responseJSON.errors.mail[0];
                }
                window.document.getElementById('error_bd').setAttribute('class', 'alert alert-danger');
                document.getElementById('error_bd').innerHTML = error;
                document.getElementById('error_bd').style.visibility = "visible";
                document.getElementById('error_bd_contorno').style.visibility = "visible";
            }
        });
    };

    // Arreglo con los datos
    var data = $('#data-tag').data('data');
    // Convertir arreglo a string
    var dataJson = JSON.stringify(data);
    // Arreglo con los datos del usuario
    var dataUser = $('#data-tag-user').data('data');
    // Convertir arreglo con los datos del usuario a string
    var dataUserJson = JSON.stringify(dataUser);
    // Crear elinput-tag (selectize)
    var select = $('#input-tags').selectize({
        persist: false,
        maxItems: null,
        items: JSON.parse(dataUserJson),
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