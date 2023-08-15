$(document).ready(function () {

    // ----------- Pop-Up Eliminar Participantes -------------

    $('#btn-mostrar-eliminar-participante').click (function(e) {
        $('#modal-eliminar-participante').modal('toggle');
    });

    /**
     * Valida que los datos de eliminar participante cumplan con sus restricciones
     */
    function validarDatos() {
        var valido = true;
        if (!validarNoNulo(document.getElementById('rut').value,'rut')) {
            valido = false;
        } else {
            if(!validarRut(document.getElementById('rut').value,'rut')){
                valido = false;
            }
        }
        return valido;
    }

    $('#btn-eliminar-participante').click (function(e) {
        // Validaciones de los datos
        if (!validarDatos()) {
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos del usuario están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/eliminar_participante",
            data: {
                servicio_id: servicio.id,
                rut: $('#rut').val(),
            },
            success: function(result) {
                // console.log('ajax ok');
                location.reload();
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    });

    // -------------- Tabla Particiapntes ----------------

    function participanteVacio(participante) {
        if (participante === '' || participante === null) {
            return true;
        }
        if (participante.nombre !== '' && participante.nombre !== null) {
            return false;
        }
        if (participante.apellido !== '' && participante.apellido !== null) {
            return false;
        }
        if (participante.rut !== '' && participante.rut !== null) {
            return false;
        }
        if (participante.correo !== '' && participante.correo !== null) {
            return false;
        }
        if (participante.faena !== '' && participante.faena !== null) {
            return false;
        }
        if (participante.perfil !== '' && participante.perfil !== null) {
            return false;
        }
        if (participante.vigencia !== '' && participante.vigencia !== null) {
            return false;
        }
        if (participante.asistencia !== '' && participante.asistencia !== null) {
            return false;
        }
        if (participante.g0 !== '' && participante.g0 !== null) {
            return false;
        }
        if (participante.g1 !== '' && participante.g1 !== null) {
            return false;
        }
        if (participante.g2 !== '' && participante.g2 !== null) {
            return false;
        }
        if (participante.g3 !== '' && participante.g3 !== null) {
            return false;
        }
        if (participante.g4 !== '' && participante.g4 !== null) {
            return false;
        }
        if (participante.p0 !== '' && participante.p0 !== null) {
            return false;
        }
        if (participante.p1 !== '' && participante.p1 !== null) {
            return false;
        }
        if (participante.p2 !== '' && participante.p2 !== null) {
            return false;
        }
        if (participante.p3 !== '' && participante.p3 !== null) {
            return false;
        }
        if (participante.p4 !== '' && participante.p4 !== null) {
            return false;
        }
        if (participante.e0 !== '' && participante.e0 !== null) {
            return false;
        }
        if (participante.e1 !== '' && participante.e1 !== null) {
            return false;
        }
        if (participante.e2 !== '' && participante.e2 !== null) {
            return false;
        }
        if (participante.e3 !== '' && participante.e3 !== null) {
            return false;
        }
        if (participante.e4 !== '' && participante.e4 !== null) {
            return false;
        }
        return true;
    }

    function nombreValido(nombre) {
        nombreRegex = /^([a-zA-ZÑñáéíóúÁÉÍÓÚ]{2,60})( ?([a-zA-ZÑñáéíóúÁÉÍÓÚ]{2,60}))*$/g;
        if (nombreRegex.test(nombre)) {
            return true;
        }
        return false;
    }


    function revisarDigito( dvr ) {
        dv = dvr + ""
        if ( dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  && dv != 'K') {
            return false;
        }
        return true;
    }

    function revisarDigito2( crut ) {
        largo = crut.length;
        if ( largo < 2 ) {
            return false;
        }
        if ( largo > 2 ) {
            rut = crut.substring(0, largo - 1);
        } else {
            rut = crut.charAt(0);
        }
        dv = crut.charAt(largo-1);
        revisarDigito( dv );

        if ( rut == null || dv == null ) {
            return 0;
        }

        var dvr = '0';
        suma = 0;
        mul  = 2;

        for (i= rut.length -1 ; i >= 0; i--) {
            suma = suma + rut.charAt(i) * mul;
            if (mul == 7) {
                mul = 2;
            } else {
                mul++;
            }
        }
        res = suma % 11;
        if (res==1) {
            dvr = 'k';
        } else if (res==0) {
            dvr = '0';
        } else {
            dvi = 11-res;
            dvr = dvi + "";
        }
        if ( dvr != dv.toLowerCase() ) {
            return false
        }

        return true
    }

    /*
     * Validar el rut
     */
    function rutValido(rut)
    {
        // rutRegex = /^([0-9]*\.?)*-([0-9]|k|K)$/i;
        // if (!rutRegex.test(rut)) {
        //     return false;
        // }

        var tmpstr = "";
        for ( i=0; i < rut.length ; i++ ) {
            if ( rut.charAt(i) != ' ' && rut.charAt(i) != '.' && rut.charAt(i) != '-' ) {
                tmpstr = tmpstr + rut.charAt(i);
            }
        }
        rut = tmpstr;
        largo = rut.length;

        if ( largo < 2 ) {
            return false;
        }

        for (i=0; i < largo ; i++ ) {
            if ( rut.charAt(i) !="0" && rut.charAt(i) != "1" && rut.charAt(i) !="2" && rut.charAt(i) != "3" && rut.charAt(i) != "4" && rut.charAt(i) !="5" && rut.charAt(i) != "6" && rut.charAt(i) != "7" && rut.charAt(i) !="8" && rut.charAt(i) != "9" && rut.charAt(i) !="k" && rut.charAt(i) != "K" ) {
                return false;
            }
        }

        var invertido = "";
        for ( i=(largo-1),j=0; i>=0; i--,j++ ) {
            invertido = invertido + rut.charAt(i);
        }
        var dRut = "";
        dRut = dRut + invertido.charAt(0);
        dRut = dRut + '-';
        cnt = 0;

        for ( i=1,j=2; i<largo; i++,j++ ) {
            if ( cnt == 3 ) {
                dRut = dRut + '.';
                j++;
                dRut = dRut + invertido.charAt(i);
                cnt = 1;
            } else {
                dRut = dRut + invertido.charAt(i);
                cnt++;
            }
        }

        invertido = "";
        for ( i=(dRut.length-1),j=0; i>=0; i--,j++ ) {
            invertido = invertido + dRut.charAt(i);
        }

        // window.document.getElementById('rut').value = invertido.toUpperCase();

        if ( revisarDigito2(rut) ) {
            return true;
        }

    }

    /*
     * Formato el rut
     */
    function rutFormato(rut) {

        if (rut === '') {
            return '';
        }
        // rutRegex = /^([0-9]*\.?)*-([0-9]|k|K)$/i;
        // if (!rutRegex.test(rut)) {
        //     return false;
        // }

        var tmpstr = "";
        for ( i=0; i < rut.length ; i++ ) {
            if ( rut.charAt(i) != ' ' && rut.charAt(i) != '.' && rut.charAt(i) != '-' ) {
                tmpstr = tmpstr + rut.charAt(i);
            }
        }
        rut = tmpstr;
        largo = rut.length;

        if ( largo < 2 ) {
            return false;
        }

        for (i=0; i < largo ; i++ ) {
            if ( rut.charAt(i) !="0" && rut.charAt(i) != "1" && rut.charAt(i) !="2" && rut.charAt(i) != "3" && rut.charAt(i) != "4" && rut.charAt(i) !="5" && rut.charAt(i) != "6" && rut.charAt(i) != "7" && rut.charAt(i) !="8" && rut.charAt(i) != "9" && rut.charAt(i) !="k" && rut.charAt(i) != "K" ) {
                return false;
            }
        }

        var invertido = "";
        for ( i=(largo-1),j=0; i>=0; i--,j++ ) {
            invertido = invertido + rut.charAt(i);
        }
        var dRut = "";
        dRut = dRut + invertido.charAt(0);
        dRut = dRut + '-';
        cnt = 0;

        for ( i=1,j=2; i<largo; i++,j++ ) {
            if ( cnt == 3 ) {
                dRut = dRut + '.';
                j++;
                dRut = dRut + invertido.charAt(i);
                cnt = 1;
            } else {
                dRut = dRut + invertido.charAt(i);
                cnt++;
            }
        }

        invertido = "";
        for ( i=(dRut.length-1),j=0; i>=0; i--,j++ ) {
            invertido = invertido + dRut.charAt(i);
        }

        // window.document.getElementById('rut').value = invertido.toUpperCase();
        return invertido.toUpperCase();

        // if ( revisarDigito2(rut) ) {
        //     return invertido.toUpperCase();
        // }

    }

    function correoValido(mail) {
        emailRegex = /^([-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63})?$/i;
        if (mail === null) {
            mail = '';
        }
        if (emailRegex.test(mail)) {
            return true;
        }
        return false;
    }

    function perfilValido(perfilValidar) {
        if (perfilValidar === 'No determinado') {
            return true;
        }
        if (perfilValidar === '' || perfilValidar === null) {
            return true;
        }
        var valido = false;
        perfiles.forEach(perfil => {
            if (perfil === perfilValidar) {
                valido = true;
            }
        });
        return valido;
    }

    function binarioValido(binario) {
        if (binario === null) {
            binario = '';
        }
        binarioRegex = /^(0|1)?$/g;
        if (binarioRegex.test(binario)) {
            return true;
        }
        return false;
    }

    function tercearioValido(terceario) {
        if (terceario === null) {
            terceario = '';
        }
        tercearioRegex = /^(0|1|2)?$/g;
        if (tercearioRegex.test(terceario)) {
            return true;
        }
        return false;
    }

    function notaValida(nota) {
        if (nota === null) {
            nota = '';
        }
        notaRegex = /^([1-7](,[0-9])?)?$/g;
        if (notaRegex.test(nota)) {
            return true;
        }
        return false;
    }

    function validarDatosIngresados() {
        // esconder los mensajes de validaciones
        document.getElementById('error-datos').hidden = true;
        document.getElementById('validacion-nombre-no-vacio').hidden = true;
        document.getElementById('validacion-apellido-no-vacio').hidden = true;
        document.getElementById('validacion-rut-no-vacio').hidden = true;
        // document.getElementById('validacion-correo-no-vacio').hidden = true;
        document.getElementById('validacion-vigencia-no-vacio').hidden = true;
        document.getElementById('validacion-nombre').hidden = true;
        document.getElementById('validacion-apellido').hidden = true;
        document.getElementById('validacion-rut').hidden = true;
        document.getElementById('validacion-correo').hidden = true;
        document.getElementById('validacion-perfil').hidden = true;
        document.getElementById('validacion-vigencia').hidden = true;
        document.getElementById('validacion-asistencia').hidden = true;
        document.getElementById('validacion-test').hidden = true;
        document.getElementById('validacion-retest').hidden = true;
        document.getElementById('validacion-guia').hidden = true;
        document.getElementById('validacion-prueba').hidden = true;
        document.getElementById('validacion-evaluacion').hidden = true;
        document.getElementById('validacion-asistencia-ingresada').hidden = true;
        document.getElementById('validacion-test-ingresado').hidden = true;
        document.getElementById('validacion-retest-ingresado').hidden = true;
        document.getElementById('validacion-guia-ingresado').hidden = true;
        document.getElementById('validacion-prueba-ingresado').hidden = true;
        document.getElementById('validacion-evaluacion-ingresado').hidden = true;
        valido = true;
        // contador de participantes
        contParticipantes = 0;
        // contador de asistencia ingresadas
        contAsistenciaIngresadas = 0;
        // contador de test ingresados
        contTestIngresados = 0;
        // contador de retest ingresados
        contRetestIngresados = 0;
        // contador de g1 ingresados
        contG1Ingresados = 0;
        // contador de g2 ingresados
        contG2Ingresados = 0;
        // contador de g3 ingresados
        contG3Ingresados = 0;
        // contador de g4 ingresados
        contG4Ingresados = 0;
        // contador de g5 ingresados
        contG5Ingresados = 0;
        // contador de p1 ingresados
        contP1Ingresados = 0;
        // contador de p2 ingresados
        contP2Ingresados = 0;
        // contador de p3 ingresados
        contP3Ingresados = 0;
        // contador de p4 ingresados
        contP4Ingresados = 0;
        // contador de p5 ingresados
        contP5Ingresados = 0;
        // contador de e1 ingresados
        contE1Ingresados = 0;
        // contador de e2 ingresados
        contE2Ingresados = 0;
        // contador de e3 ingresados
        contE3Ingresados = 0;
        // contador de e4 ingresados
        contE4Ingresados = 0;
        // contador de e5 ingresados
        contE5Ingresados = 0;
        data.forEach(participante => {
            if (!participanteVacio(participante)) {
                // - validar no vacio
                // nombre
                if (participante.nombre == '' || participante.nombre === null) {
                    valido = false;
                    document.getElementById('validacion-nombre-no-vacio').hidden = false;
                } else {
                    // validar formato
                    if (!nombreValido(participante.nombre)) {
                        valido = false;
                        document.getElementById('validacion-nombre').hidden = false;
                    }
                }
                // apellido
                if (participante.apellido == '' || participante.apellido === null) {
                    valido = false;
                    document.getElementById('validacion-apellido-no-vacio').hidden = false;
                } else {
                    // validar formato
                    if (!nombreValido(participante.apellido)) {
                        valido = false;
                        document.getElementById('validacion-apellido').hidden = false;
                    }
                }
                // rut
                if (participante.rut == '' || participante.rut === null) {
                    valido = false;
                    document.getElementById('validacion-rut-no-vacio').hidden = false;
                } else {
                    // validar formato
                    if (!rutValido(participante.rut)) {
                        valido = false;
                        document.getElementById('validacion-rut').hidden = false;
                    }
                }
                // correo
                // if (participante.correo == '') {
                //     valido = false;
                //     document.getElementById('validacion-correo-no-vacio').hidden = false;
                // } else {
                    // validar formato
                    if (!correoValido(participante.correo)) {
                        valido = false;
                        document.getElementById('validacion-correo').hidden = false;
                    }
                // }
                // perfil
                // validar formato
                if (!perfilValido(participante.perfil)) {
                    valido = false;
                    document.getElementById('validacion-perfil').hidden = false;
                }
                // vigencia
                if (participante.vigencia == '' || participante.vigencia === null) {
                    valido = false;
                    document.getElementById('validacion-vigencia-no-vacio').hidden = false;
                } else {
                    // validar formato
                    if (!tercearioValido(participante.vigencia)) {
                        valido = false;
                        document.getElementById('validacion-vigencia').hidden = false;
                    }
                }
                // - validar formato
                // asistencia
                if (!binarioValido(participante.asistencia)) {
                    valido = false;
                    document.getElementById('validacion-asistencia').hidden = false;
                }
                // verificar si se ingreso la asistencia
                if (participante.asistencia === '' || participante.asistencia === null) {
                    contAsistenciaIngresadas++;
                }
                // test
                if (!notaValida(participante.test)) {
                    valido = false;
                    document.getElementById('validacion-test').hidden = false;
                }
                // verificar si se ingreso el test
                if (participante.test === '' || participante.test === null) {
                    contTestIngresados++;
                }
                // retest
                if (!notaValida(participante.retest)) {
                    valido = false;
                    document.getElementById('validacion-retest').hidden = false;
                }
                // verificar si se ingreso el retest
                if (participante.retest === '' || participante.retest === null) {
                    contRetestIngresados++;
                }
                // g1
                if (!notaValida(participante.g0)) {
                    valido = false;
                    document.getElementById('validacion-guia').hidden = false;
                }
                // verificar si se ingreso el g1
                if (participante.g0 === '' || participante.g0 === null) {
                    contG1Ingresados++;
                }
                // g2
                if (!notaValida(participante.g1)) {
                    valido = false;
                    document.getElementById('validacion-guia').hidden = false;
                }
                // verificar si se ingreso el g2
                if (participante.g1 === '' || participante.g1 === null) {
                    contG2Ingresados++;
                }
                // g3
                if (!notaValida(participante.g2)) {
                    valido = false;
                    document.getElementById('validacion-guia').hidden = false;
                }
                // verificar si se ingreso el g3
                if (participante.g2 === '' || participante.g2 === null) {
                    contG3Ingresados++;
                }
                // g4
                if (!notaValida(participante.g3)) {
                    valido = false;
                    document.getElementById('validacion-guia').hidden = false;
                }
                // verificar si se ingreso el g4
                if (participante.g3 === '' || participante.g3 === null) {
                    contG4Ingresados++;
                }
                // g5
                if (!notaValida(participante.g4)) {
                    valido = false;
                    document.getElementById('validacion-guia').hidden = false;
                }
                // verificar si se ingreso el g5
                if (participante.g4 === '' || participante.g4 === null) {
                    contG5Ingresados++;
                }
                // p1
                if (!notaValida(participante.p0)) {
                    valido = false;
                    document.getElementById('validacion-prueba').hidden = false;
                }
                // verificar si se ingreso el p1
                if (participante.p0 === '' || participante.p0 === null) {
                    contP1Ingresados++;
                }
                // p2
                if (!notaValida(participante.p1)) {
                    valido = false;
                    document.getElementById('validacion-prueba').hidden = false;
                }
                // verificar si se ingreso el p2
                if (participante.p1 === '' || participante.p1 === null) {
                    contP2Ingresados++;
                }
                // p3
                if (!notaValida(participante.p2)) {
                    valido = false;
                    document.getElementById('validacion-prueba').hidden = false;
                }
                // verificar si se ingreso el p3
                if (participante.p2 === '' || participante.p2 === null) {
                    contP3Ingresados++;
                }
                // p4
                if (!notaValida(participante.p3)) {
                    valido = false;
                    document.getElementById('validacion-prueba').hidden = false;
                }
                // verificar si se ingreso el p4
                if (participante.p3 === '' || participante.p3 === null) {
                    contP4Ingresados++;
                }
                // p5
                if (!notaValida(participante.p4)) {
                    valido = false;
                    document.getElementById('validacion-prueba').hidden = false;
                }
                // verificar si se ingreso el p5
                if (participante.p4 === '' || participante.p4 === null) {
                    contP5Ingresados++;
                }
                // e1
                if (!notaValida(participante.e0)) {
                    valido = false;
                    document.getElementById('validacion-evaluacion').hidden = false;
                }
                // verificar si se ingreso el e1
                if (participante.e0 === '' || participante.e0 === null) {
                    contE1Ingresados++;
                }
                // e2
                if (!notaValida(participante.e1)) {
                    valido = false;
                    document.getElementById('validacion-evaluacion').hidden = false;
                }
                // verificar si se ingreso el e2
                if (participante.e1 === '' || participante.e1 === null) {
                    contE2Ingresados++;
                }
                // e3
                if (!notaValida(participante.e2)) {
                    valido = false;
                    document.getElementById('validacion-evaluacion').hidden = false;
                }
                // verificar si se ingreso el e3
                if (participante.e2 === '' || participante.e2 === null) {
                    contE3Ingresados++;
                }
                // e4
                if (!notaValida(participante.e3)) {
                    valido = false;
                    document.getElementById('validacion-evaluacion').hidden = false;
                }
                // verificar si se ingreso el e4
                if (participante.e3 === '' || participante.e3 === null) {
                    contE4Ingresados++;
                }
                // e5
                if (!notaValida(participante.e4)) {
                    valido = false;
                    document.getElementById('validacion-evaluacion').hidden = false;
                }
                // verificar si se ingreso el e5
                if (participante.e4 === '' || participante.e4 === null) {
                    contE5Ingresados++;
                }
                contParticipantes++;
            }
        });
        // validar que se ingresaron todas las asistencia
        if (contAsistenciaIngresadas !== contParticipantes && contAsistenciaIngresadas !== 0) {
            valido = false;
            document.getElementById('validacion-asistencia-ingresada').hidden = false;
        }
        // validar que se ingresaron todos los test
        if (contTestIngresados !== contParticipantes && contTestIngresados !== 0) {
            valido = false;
            document.getElementById('validacion-test-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los retest
        if (contRetestIngresados !== contParticipantes && contRetestIngresados !== 0) {
            valido = false;
            document.getElementById('validacion-retest-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los g1
        if (contG1Ingresados !== contParticipantes && contG1Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-guia-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los g2
        if (contG2Ingresados !== contParticipantes && contG2Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-guia-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los g3
        if (contG3Ingresados !== contParticipantes && contG3Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-guia-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los g4
        if (contG4Ingresados !== contParticipantes && contG4Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-guia-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los g5
        if (contG5Ingresados !== contParticipantes && contG5Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-guia-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los p1
        if (contP1Ingresados !== contParticipantes && contP1Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-prueba-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los p2
        if (contP2Ingresados !== contParticipantes && contP2Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-prueba-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los p3
        if (contP3Ingresados !== contParticipantes && contP3Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-prueba-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los p4
        if (contP4Ingresados !== contParticipantes && contP4Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-prueba-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los p5
        if (contP5Ingresados !== contParticipantes && contP5Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-prueba-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los e1
        if (contE1Ingresados !== contParticipantes && contE1Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-evaluacion-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los e2
        if (contE2Ingresados !== contParticipantes && contE2Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-evaluacion-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los e3
        if (contE3Ingresados !== contParticipantes && contE3Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-evaluacion-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los e4
        if (contE4Ingresados !== contParticipantes && contE4Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-evaluacion-ingresado').hidden = false;
        }
        // validar que se ingresaron todos los e5
        if (contE5Ingresados !== contParticipantes && contE5Ingresados !== 0) {
            valido = false;
            document.getElementById('validacion-evaluacion-ingresado').hidden = false;
        }
        if (!valido) {
            document.getElementById('error-datos').hidden = false;
        }
        return valido;
    }

    $('#btn-guardar').click (function() {
        document.getElementById('error-guardar-datos').hidden = true;
        // Validaciones de los datos
        if (!validarDatosIngresados()) {
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos están correctos?");
        // if(respuesta == false){
        //     return;
        // }
        // Mostrar indicador que se estan guardando los datos
        document.getElementById('guardando-datos').hidden = false;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/guardar_participantes",
            data: {
                servicio_id: servicio.id,
                data: data
            },
            success: function(result) {
                // console.log('ajax datos ok');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('guardando-datos').hidden = true;
            },
            error: function(xhr) {
                // console.log('ajax datos error');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('guardando-datos').hidden = true;
                document.getElementById('error-guardar-datos').hidden = false;
            }
        });
    });

    var etapa = $('#data-tag-etapa').data('data');

    var estadoOperacional = $('#data-tag-estado-operacional').data('data');

    function verificarEtapaDato() {
        if (etapa === 6 || estadoOperacional === 5) {
            return true;
        }
        return false;
    }

    function verificarEtapaNota() {
        if (etapa === 5 || estadoOperacional !== 5) {
            return false;
        }
        return true;
    }

    if (etapa === 6 || estadoOperacional === 5) {
        document.getElementById('btn-guardar').hidden = true;
    }

    var servicio = $('#data-tag-servicio').data('data');

    var data = $('#data-tag-participantes').data('data');

    var headers = $('#data-tag-headers').data('data');

    var perfiles = $('#data-tag-perfiles').data('data');

    var container = document.getElementById('participantes');
    var tablaParticipantes = new Handsontable(container, {
        data: data,
        rowHeaders: true,
        colHeaders: headers,
        maxCols: 25,
        maxRows: 50,
        // filters: true,
        // dropdownMenu: true,
        // colWidths: 100,
        width: '100%',
        // height: 614,
        height: 300,
        rowHeights: 23,
        columns: [
            {data: 'nombre', readOnly: verificarEtapaDato()},
            {data: 'apellido', readOnly: verificarEtapaDato()},
            {data: 'rut', readOnly: verificarEtapaDato()},
            {data: 'correo', readOnly: verificarEtapaDato()},
            {data: 'faena', readOnly: verificarEtapaDato()},
            {
                data: 'perfil',
                readOnly: verificarEtapaDato(),
                type: 'dropdown',
                source: JSON.parse(JSON.stringify(perfiles))
            },
            {data: 'vigencia', readOnly: verificarEtapaDato()},
            {data: 'asistencia', readOnly: verificarEtapaNota()},
            {data: 'test', readOnly: verificarEtapaNota()},
            {data: 'retest', readOnly: verificarEtapaNota()},
            {data: 'g0', readOnly: verificarEtapaNota()},
            {data: 'g1', readOnly: verificarEtapaNota()},
            {data: 'g2', readOnly: verificarEtapaNota()},
            {data: 'g3', readOnly: verificarEtapaNota()},
            {data: 'g4', readOnly: verificarEtapaNota()},
            {data: 'p0', readOnly: verificarEtapaNota()},
            {data: 'p1', readOnly: verificarEtapaNota()},
            {data: 'p2', readOnly: verificarEtapaNota()},
            {data: 'p3', readOnly: verificarEtapaNota()},
            {data: 'p4', readOnly: verificarEtapaNota()},
            {data: 'e0', readOnly: verificarEtapaNota()},
            {data: 'e1', readOnly: verificarEtapaNota()},
            {data: 'e2', readOnly: verificarEtapaNota()},
            {data: 'e3', readOnly: verificarEtapaNota()},
            {data: 'e4', readOnly: verificarEtapaNota()},
        ],
        beforeChange: function (changes, source) {
            if (changes !== null) {
                for (var i = changes.length - 1; i >= 0; i--) {
                    if (changes[i][1] === 'rut') {
                        changes[i][3] = rutFormato(changes[i][3]);
                    }
                }
            }
        }
    });

});