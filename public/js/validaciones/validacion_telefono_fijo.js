$(document).ready(function () {
    /*
     * Función para validar un teléfono fijo
     * Tiene que recibir el identificador del formulario
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarTelefonoFijo = function(telefonoFijo,id) {
        if (telefonoFijo === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        telefonoFijo = telefonoFijo.replace(/ /g,'');
        telefonoFijoRegex = /[0-9]{6,10}/g;
        if (telefonoFijoRegex.test(telefonoFijo)) {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'Se debe ingresar un teléfono fijo válido.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };
});