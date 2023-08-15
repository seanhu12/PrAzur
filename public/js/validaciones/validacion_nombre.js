$(document).ready(function () {
    /*
     * Validar que el nombre solo tenga letras o un espacio entre letras
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarNombre = function(nombre,id) {
        if (nombre === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        nombreRegex = /^([a-zA-ZÑñáéíóúÁÉÍÓÚ]{1,60})( ?([a-zA-ZÑñáéíóúÁÉÍÓÚ]{1,60}))+$/g;
        if (nombreRegex.test(nombre)) {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'Se debe ingresar un nombre válido.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };
});