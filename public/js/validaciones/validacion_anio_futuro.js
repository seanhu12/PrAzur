$(document).ready(function () {
    /*
     * Validar que el anio sea en el futuro
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarAnioFuturo = function(numero, id) {
        if (numero === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        numeroRegex = /^[0-9]{4,4}$/g;
        anio=new Date().getFullYear();
        if (numeroRegex.test(numero) && numero>=anio && numero<=9999) {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'Se debe ingresar un año posterior al actual.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };
});