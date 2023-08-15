$(document).ready(function () {
    /*
     * Función para validar una fecha para que no sea pasada ni actual
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarFechaNoPasada = function(fecha,id) {
        if (fecha === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        if (!isPastDate(fecha)) {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'Se debe ingresar una fecha posterior a la actual.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };

    function isPastDate(idate){
        var today = new Date();
        idate = idate.split("-");
        idate = new Date(idate[0], idate[1] - 1, idate[2]);
        return (today - idate) >= 0;
    };
});