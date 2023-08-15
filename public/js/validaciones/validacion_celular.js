$(document).ready(function () {
    /*
     * Función para validar un celular
     * Tiene que recibir el identificador del formulario
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarCelular = function(celular,id) {
        if (celular === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        celular = celular.replace(/ /g,'');
        celularRegex = /^(\+[0-9]{3})[0-9]{8}$/g;
        if (celularRegex.test(celular)) {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'Se debe ingresar un teléfono móvil válido.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };
});