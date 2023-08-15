$(document).ready(function () {
    /*
     * Función para validar una fecha para que no sea futura
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarFechaNoFutura = function(fecha,id) {
        if (fecha === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        if (!isFutureDate(fecha)) {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'Se debe ingresar una fecha anterior a la actual.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };

    function isFutureDate(idate){
        var today = new Date();
        idate = idate.split("-");
        idate = new Date(idate[0], idate[1] - 1, idate[2]);
        return (today - idate) < 0;
    };
});