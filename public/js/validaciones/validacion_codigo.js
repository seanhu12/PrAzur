$(document).ready(function () {
    /*
     * Validar que el codigo solo tenga letras y números
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarCodigo = function(nombre,id) {
        if (nombre === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        nombreRegex = /^([a-zA-Z]{2,60}[0-9]{1,60})$/g;
        if (nombreRegex.test(nombre)) {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'Se debe ingresar un código válido.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };
});