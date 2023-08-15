$(document).ready(function () {
    /*
     * Validar que el apellido solo tenga letras o un espacio entre letras
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarApellido = function(apellido,id) {
        if (apellido === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        apellidoRegex = /(^[a-zA-ZñáéíóúÁÉÍÓÚ]{2,60})( ?([a-zA-ZñáéíóúÁÉÍÓÚ]{2,60}))?$/g;
        if (apellidoRegex.test(apellido)) {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'Se debe ingresar un apellido válido.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };
});