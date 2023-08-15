$(document).ready(function () {
    /*
     * Validar que el anio sea pasado
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarAnioPasado = function(numero, id) {
        if (numero === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        numeroRegex = /^[0-9]{4,4}$/g;
        anio=new Date().getFullYear();
        if (numeroRegex.test(numero) && numero<=anio && numero>=1900) {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'Se debe ingresar un año anterior al actual y posterior a 1900.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };
});