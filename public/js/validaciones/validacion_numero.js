$(document).ready(function () {
    /*
     * Validar que el valor del id entregado no sea nulo
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarNumero = function(numero, id) {
        if (numero === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        numeroRegex = /^\d*$/;
        if (numeroRegex.test(numero)) {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'Se debe ingresar un número válido.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };
});