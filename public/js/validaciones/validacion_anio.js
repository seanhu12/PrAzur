$(document).ready(function () {
    /*
     * Validar que se ingreso un anio
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarAnio = function(numero, id) {
        if (numero === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        numeroRegex = /^[0-9]{4,4}$/g;
        if (numeroRegex.test(numero)) {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'Se debe ingresar un año válido.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };
});