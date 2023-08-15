$(document).ready(function () {

    $('#password').change( function() {
        confirmarContrasenia(document.getElementById('confirmar_password').value);
    });

    /*
     * Confirma que la contrasenia de confirmacion sea iguala la original
     */
    window.confirmarContrasenia = function(confirmarPassword) {
        if (confirmarPassword === '') {
            window.document.getElementById('confirmar_password').setAttribute('class', 'form-control');
            return true;
        }
        /* Verificar que la contrasenia tenga entre 8 y 16 caracteres,
        al menos un dígito, al menos una minúscula y al menos una mayúscula.
        No puede tener otros símbolos.*/
        passwordRegex = /(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}/g;
        if (passwordRegex.test(confirmarPassword)) {
            var password = document.getElementById('password').value;
            if (password == confirmarPassword) {
                window.document.getElementById('confirmar_password').setAttribute('class', 'form-control is-valid');
                return true;
            } else {
                window.document.getElementById('confirmar_password-alert').innerText = 'Las contraseñas no coinciden.';
                window.document.getElementById('confirmar_password').setAttribute('class', 'form-control is-invalid');
                return false;
            }
        } else {
            window.document.getElementById('confirmar_password-alert').innerText = 'Se debe ingresar una contraseña válida.';
            window.document.getElementById('confirmar_password').setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };
});