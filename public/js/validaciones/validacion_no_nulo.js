$(document).ready(function () {
    /*
     * Validar que el valor del id entregado no sea nulo
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarNoNulo = function(notNull, id) {
        if (notNull != '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'El campo es obligatorio.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };
});