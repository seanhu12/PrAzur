$(document).ready(function () {
    /*
     * Función para validar una dirección de correo
     * Tiene que recibir el identificador del formulario
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarEmail = function(email,id) {
        if (email === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
        if (emailRegex.test(email)) {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'Se debe ingresar un correo electrónico válido.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };
});