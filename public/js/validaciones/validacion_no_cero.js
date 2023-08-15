$(document).ready(function () {
    /*
     * Validar que el valor entregado no sea cero
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarNoCero = function(noCero, id) {
        // if (noCero === '') {
        //     window.document.getElementById(id).setAttribute('class', 'form-control');
        //     return true;
        // }
        if (noCero !== '' && noCero !== '0') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'Se debe ingresar un valor distinto de 0.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };
});