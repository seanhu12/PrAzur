$(document).ready(function () {

    /**
     * Indica en la vista que hubo un error
     * @param {int} id
     * @param {string} mensaje
     */
    function invalid(id,mensaje) {
        mensajeError = window.document.getElementById(id + '-alert');
        mensajeError.innerHTML = mensaje;
        error = window.document.getElementById(id);
        error.setAttribute('class', 'form-control is-invalid');
        return false;
    }

    /**
     * Validar los rangos del horario entre 0-23 y 0-59 si tiene dos horas
     * @param {string} horario
     * @param {int} id
     */
    function validarHorarioLargo(horario, id) {
        if (horario === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        var horarioSeparado = horario.split(' a ');
        var horarioInicio = horarioSeparado[0].split(':');
        var horarioFin = horarioSeparado[1].split(':');
        var horaInicio = parseInt(horarioInicio[0]);
        var minutoInicio = parseInt(horarioInicio[1]);
        var horaFin = parseInt(horarioFin[0]);
        var minutoFin = parseInt(horarioFin[1]);
        if (horaInicio > 23 || horaInicio < 0) {
            return invalid(id,'El horario ingresado es invalido.');
        }
        if (minutoInicio > 59 || minutoInicio < 0) {
            return invalid(id,'El horario ingresado es invalido.');
        }
        if (horaFin > 24 || horaFin < 0) {
            return invalid(id,'El horario ingresado es invalido.');
        }
        if (minutoFin > 59 || minutoFin < 0) {
            return invalid(id,'El horario ingresado es invalido.');
        }
        window.document.getElementById(id).setAttribute('class', 'form-control');
        return true;
    }

    /**
     * Validar los rangos del horario entre 0-23 y 0-59 si tiene una hora
     * @param {string} horario
     * @param {int} id
     */
    function validarHorarioCorto(horario, id) {
        if (horario === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        var horarioSeparado = horario.split(':');
        var hora = parseInt(horarioSeparado[0]);
        var minuto = parseInt(horarioSeparado[1]);
        if (hora > 23 || hora < 0) {
            return invalid(id,'El horario ingresado es invalido.');
        }
        if (minuto > 59 || minuto < 0) {
            return invalid(id,'El horario ingresado es invalido.');
        }
        window.document.getElementById(id).setAttribute('class', 'form-control');
        return true;
    }

    /**
     * Validar que el horario cumpla con el formato 00:00-00:00
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarHorario = function(horario,id) {
        if (horario === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        horarioRegex = /^(\d\d:\d\d( a \d\d:\d\d)?)?$/g;
        if (horarioRegex.test(horario)) {
            if (horario.search(' a ') != -1) {
                return validarHorarioLargo(horario, id);
            } else {
                return validarHorarioCorto(horario, id);
            }
        }
        return invalid(id,'Se debe ingresar como "00:00" o "00:00 a 00:00".');
    };
});