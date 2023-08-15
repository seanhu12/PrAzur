$(document).ready(function () {

    $('#horario').mask('00:00 a 00:00');

    $('#nombre-servicio').change(function() {
        this.setAttribute('class','form-control');
    });

    $('#monto').change(function() {
        this.setAttribute('class','form-control');
    });

    $('#monto').keyup(function() {
        var monto = document.getElementById('monto');
        var valorMonto = monto.value;
        monto.value = formatoDineroInput(valorMonto);
    });

    $('#numero-horas').keyup(function() {
        var numHoras = document.getElementById('numero-horas');
        var numeroNumHoras = numHoras.value;
        numHoras.value = formatoDecimalInput(numeroNumHoras);
    });

    $('#numero-participantes').keyup(function() {
        var numParticipantes = document.getElementById('numero-participantes');
        var numeroNumParticipantes = numParticipantes.value;
        numParticipantes.value = formatoNumeroInput(numeroNumParticipantes);
    });

    window.validarMaxMinNumeroHoras = function () {
        window.document.getElementById('numero-horas').setAttribute('class', 'form-control');
        var cantHoras = document.getElementById('numero-horas').value;
        if(cantHoras.search(',') + 1 === cantHoras.length){
            if (cantHoras !== '') {
                window.document.getElementById('numero-horas').setAttribute('class', 'form-control is-invalid');
                return;
            }
        }
        cantHoras = quitarFormatoDecimal(cantHoras);
        if(cantHoras > 99.9 || cantHoras < 0){
            window.document.getElementById('numero-horas').setAttribute('class', 'form-control is-invalid');
            valido = false;
            return;
        }
    }

    window.validarMaxMinNumeroParticipantes = function () {
        window.document.getElementById('numero-participantes').setAttribute('class', 'form-control');
        var numeroParticipantes = quitarFormatoNumero(document.getElementById('numero-participantes').value);
        if(numeroParticipantes > 99 || numeroParticipantes < 0) {
            window.document.getElementById('numero-participantes').setAttribute('class', 'form-control is-invalid');
        }
    }

    /**
     * Valida que el servicio este correcto
     */
    function validarServicio() {
        var valido = true;
        window.document.getElementById('numero-horas').setAttribute('class', 'form-control');
        var cantHoras = document.getElementById('numero-horas').value;
        if(cantHoras.search(',') + 1 === cantHoras.length){
            if (cantHoras !== '') {
                window.document.getElementById('numero-horas').setAttribute('class', 'form-control is-invalid');
                return;
            }
        }
        cantHoras = quitarFormatoDecimal(cantHoras);
        if(cantHoras > 99.9 || cantHoras < 0){
            window.document.getElementById('numero-horas').setAttribute('class', 'form-control is-invalid');
            valido = false;
        }
        window.document.getElementById('numero-participantes').setAttribute('class', 'form-control');
        var numeroParticipantes = quitarFormatoNumero(document.getElementById('numero-participantes').value);
        if(numeroParticipantes > 99 || numeroParticipantes < 0) {
            window.document.getElementById('numero-participantes').setAttribute('class', 'form-control is-invalid');
            valido = false;
        }
        // if(!validarNumero(document.getElementById('numero-horas').value,'numero-horas')){
        //     valido = false;
        // }
        // if(!validarNumero(document.getElementById('numero-participantes').value,'numero-participantes')){
        //     valido = false;
        // }
        if(!validarHorario(document.getElementById('horario').value,'horario')){
            valido = false;
        }
        if(!validarNoNulo(document.getElementById('nombre-servicio').value,'nombre-servicio')){
            valido = false;
        }
        if(!validarNoNulo(document.getElementById('fecha-ejecucion').value,'fecha-ejecucion')){
            valido = false;
        } else {
            if(!validarFechaNoPasada(document.getElementById('fecha-ejecucion').value,'fecha-ejecucion')){
                valido = false;
            }
        }
        if(!validarNoNulo(document.getElementById('monto').value,'monto')){
            valido = false;
        } else {
            // if(!validarNumero(document.getElementById('monto').value,'monto')){
            //     valido = false;
            // }
        }
        if(!validarNoNulo(document.getElementById('select-beast-curso').value,'select-beast-curso')){
            valido = false;
        }
        if(!validarNoNulo(document.getElementById('select-beast-propuesta').value,'select-beast-propuesta')){
            valido = false;
        }
        return valido;
    }

    /**
     * Verifica que el codigo sence este seleccionado para enviar los datos
     *
     * @returns codigoSence
     */
    function verificarCodigoSence() {
        if(document.getElementById('sence-si-no').checked) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Asignar 1 check 0 no check
     */
    function reemplazarTrueFalse(check) {
        if (check) {
            return '1';
        } else {
            return '0';
        }
    }

    /**
     * Crea el servicio
     */
    function crearServicio() {
        // Crear objeto con las opciones de los checkbox
        var servicioActividades = {
            coffee: reemplazarTrueFalse(document.getElementById('coffee').checked),
            almuerzo: reemplazarTrueFalse(document.getElementById('almuerzo').checked),
            outdoor: reemplazarTrueFalse(document.getElementById('outdoor').checked),
            audioIluminacion: reemplazarTrueFalse(document.getElementById('audio-iluminacion').checked),
            encuestaEmpresa: reemplazarTrueFalse(document.getElementById('encuesta-empresa').checked),
            encuestaAdicionales: reemplazarTrueFalse(document.getElementById('encuesta-adicionales').checked),
            guias: reemplazarTrueFalse(document.getElementById('guias').checked),
            bitacora: reemplazarTrueFalse(document.getElementById('bitacora').checked),
            carpetaParticipantes: reemplazarTrueFalse(document.getElementById('carpeta-participantes').checked),
            pruebas: reemplazarTrueFalse(document.getElementById('pruebas').checked),
            lapices: reemplazarTrueFalse(document.getElementById('lapices').checked),
            velobind: reemplazarTrueFalse(document.getElementById('velobind').checked),
            diplomaCurso: reemplazarTrueFalse(document.getElementById('diploma-curso').checked),
        }
        // Crear objeto con las opciones outdoor
        if (document.getElementById('outdoor').checked) {
            var materialesOutdoor = {
                venda: reemplazarTrueFalse(document.getElementById('venda').checked),
                pvc: reemplazarTrueFalse(document.getElementById('pvc').checked),
                pelota: reemplazarTrueFalse(document.getElementById('pelota').checked),
                plumones: reemplazarTrueFalse(document.getElementById('plumones').checked),
                papelKraft: reemplazarTrueFalse(document.getElementById('papel-kraft').checked),
                pechera: reemplazarTrueFalse(document.getElementById('pechera').checked),
                masking: reemplazarTrueFalse(document.getElementById('masking').checked),
                bolsaBasura: reemplazarTrueFalse(document.getElementById('bolsa-basura').checked),
                cono: reemplazarTrueFalse(document.getElementById('cono').checked),
                plato: reemplazarTrueFalse(document.getElementById('plato').checked),
                aroMadera: reemplazarTrueFalse(document.getElementById('aro-madera').checked),
                tijera: reemplazarTrueFalse(document.getElementById('tijera').checked),
                esqui: reemplazarTrueFalse(document.getElementById('esqui').checked),
                otros: document.getElementById('otros-outdoor').value
            }
        } else {
            var materialesOutdoor = {
                venda: 0,
                pvc: 0,
                pelota: 0,
                plumones: 0,
                papelKraft: 0,
                pechera: 0,
                masking: 0,
                bolsaBasura: 0,
                cono: 0,
                plato: 0,
                aroMadera: 0,
                tijera: 0,
                esqui: 0,
                otros: ''
            };
        }
        // Crear objeto con las opciones audio e iluminacion
        if (document.getElementById('audio-iluminacion').checked) {
            var materialAudioIluminacion = {
                parlantes: reemplazarTrueFalse(document.getElementById('parlantes').checked),
                atril: reemplazarTrueFalse(document.getElementById('atril').checked),
                alargador: reemplazarTrueFalse(document.getElementById('alargador').checked),
                foco: reemplazarTrueFalse(document.getElementById('foco').checked),
                microfonoCintillo: reemplazarTrueFalse(document.getElementById('microfono-cintillo').checked),
                microfonoInalambrico: reemplazarTrueFalse(document.getElementById('microfono-inalambrico').checked),
                otros: document.getElementById('otros-audio-iluminacion').value
            }
        } else {
            var materialAudioIluminacion = {
                parlantes: 0,
                atril: 0,
                alargador: 0,
                foco: 0,
                microfonoCintillo: 0,
                microfonoInalambrico: 0,
                otros: ''
            };
        }
        // Verificar si se selecciono una ciudad
        var ciudadId = '';
        if (selectizeControlCiudad.items.length != 0) {
            ciudadId = selectizeControlCiudad.items[0];
        }
        // Verificar si se selecciono un relator
        var relatorId = '';
        if (selectizeControlRelator.items.length != 0) {
            relatorId = selectizeControlRelator.items[0];
        }
        // Crear servicio
        var servicio = {
            cursoId: curso.id,
            nombre: document.getElementById('nombre-servicio').value,
            monto: quitarFormatoDinero(document.getElementById('monto').value),
            numeroHoras: quitarFormatoDecimal(document.getElementById('numero-horas').value),
            numeroParticipantes: quitarFormatoNumero(document.getElementById('numero-participantes').value),
            fechaEjecucion: document.getElementById('fecha-ejecucion').value,
            horario: document.getElementById('horario').value,
            sence: verificarCodigoSence(),
            ciudadId: ciudadId,
            lugar: document.getElementById('lugar').value,
            salon: document.getElementById('salon').value,
            relatorId: relatorId,
            actividades: servicioActividades,
            detalles: document.getElementById('detalles').value,
            outdoor: materialesOutdoor,
            audioIluminacion: materialAudioIluminacion
        }
        return servicio;
    }

    /**
     * Envia los datos de todos los servicios
     */
    window.enviarDatos = function() {
        // Validar el serrvicio
        if (!validarServicio()) {
            return;
        }
        // Confirmacion de datos
        var respuesta = confirm("¿Está seguro que los datos están correctos?");
        if(respuesta==false){
            return;
        }
        var servicio = crearServicio();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/store",
            data: {
                propuestaId: propuestaId,
                servicio: servicio,
            },
            success: function(result) {
                // console.log('ajax servicio ok');
                window.location.replace("/propuesta");
            },
            error: function(xhr) {
                // console.log('ajax servicio error');
            }
        });
    }

    /**
     * Cambia el campo codigo sence entre activo e inactivo
     */
    window.elegirSence = function() {
        senceSiNo = document.getElementById('sence-si-no');
        document.getElementById('codigo-sence').value = curso.codigo_sence;
        if (senceSiNo.checked) {
            document.getElementById('codigo-sence').value = curso.codigo_sence;
        } else {
            document.getElementById('codigo-sence').value = '';
        }
    }

    /**
     * Permite seleccionar los materiales outdoor
     */
    window.mostrarOutdoor = function() {
        if (document.getElementById('outdoor').checked) {
            document.getElementById('opciones-outdoor').hidden = false;
            document.getElementById('titulo-outdoor').hidden = false;
            document.getElementById('separacion-outdoor').hidden = false;
        } else {
            document.getElementById('opciones-outdoor').hidden = true;
            document.getElementById('titulo-outdoor').hidden = true;
            document.getElementById('separacion-outdoor').hidden = true;
        }
    }

    /**
     * Permite seleccionar los materiales de audio e iluminacion
     */
    window.mostrarAudioIluminacion = function() {
        if (document.getElementById('audio-iluminacion').checked) {
            document.getElementById('opciones-audio-iluminacion').hidden = false;
            document.getElementById('titulo-audio-iluminacion').hidden = false;
            document.getElementById('separacion-audio-iluminacion').hidden = false;
        } else {
            document.getElementById('opciones-audio-iluminacion').hidden = true;
            document.getElementById('titulo-audio-iluminacion').hidden = true;
            document.getElementById('separacion-audio-iluminacion').hidden = true;
        }
    }

    /**
     * Obtener los cursos de la propuesta seleccionada
     */
    window.getCursos = function(propuestaId) {
        var cursos;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/servicio/cursos_propuesta",
            data : {
                propuestaId: propuestaId
            },
            async: false,
            success: function(result) {
                cursos = result;
            },
            error: function() {
                // console.log('error ajax datos cursos ');
            }
        });
        return cursos;
    }

    // Arreglo con los datos de las propuestas
    var dataPropuesta = $('#data-tag-propuesta').data('data');
    // Convertir arreglo a string
    var dataPropuestaJson = JSON.stringify(dataPropuesta);
    var selectPropuesta = $('#select-beast-propuesta').selectize({
        create: false,
        searchField: 'idp',
        options: JSON.parse(dataPropuestaJson),
        valueField: 'id',
        labelField: 'idp',
        onChange: function() {
            propuestaId = selectizeControlPropuesta.items[0];
            document.getElementById('select-beast-propuesta').setAttribute('class', 'form-control');
            selectizeControlCurso.clear();
            selectizeControlCurso.clearOptions();
            selectizeControlCurso.load(function(callback) {
                callback(JSON.parse(getCursos(selectizeControlPropuesta.items[0])));
            });
            document.getElementById('select-beast-curso-alert').innerText = 'Se debe seleccionar un curso.';
            document.getElementById('select-beast-curso').setAttribute('class', 'form-control');
            if (jQuery.isEmptyObject(selectizeControlCurso.options)) {
                selectizeControlCurso.disable()
                document.getElementById('select-beast-curso-alert').innerText = 'No hay cursos.';
                document.getElementById('select-beast-curso').setAttribute('class', 'form-control is-invalid');
            } else {
                selectizeControlCurso.enable()
            }
        }
    });
    var selectizeControlPropuesta = selectPropuesta[0].selectize;

    // Arreglo con los datos de los cursos
    var dataCurso = $('#data-tag-curso').data('data');
    // Convertir arreglo a string
    var dataCursoJson = JSON.stringify(dataCurso);
    var selectCurso = $('#select-beast-curso').selectize({
        create: false,
        searchField: 'nombre_venta',
        valueField: 'id',
        labelField: 'nombre_venta',
        onChange: function() {
            if (selectizeControlCurso.items.length != 0) {
                document.getElementById('select-beast-curso').setAttribute('class', 'form-control');
                curso = selectizeControlCurso.options[selectizeControlCurso.items[0]];
                elegirSence();
                document.getElementById('nombre-servicio').value = curso.nombre_venta;
                document.getElementById('numero-horas').value = formatoNumeroShow(curso.cant_horas);
                // document.getElementById('numero-participantes').value = curso.cant_participantes;
            } else {
                document.getElementById('codigo-sence').value = '';
                document.getElementById('nombre-servicio').value = '';
                document.getElementById('numero-horas').value = '';
            }
        }
    });
    var selectizeControlCurso = selectCurso[0].selectize;

    // Arreglo con los datos de las ciudades
    var dataCiudad = $('#data-tag-ciudad').data('data');
    // Convertir arreglo a string
    var dataCiudadJson = JSON.stringify(dataCiudad);
    var selectCiudad = $('#select-beast-ciudad').selectize({
        create: false,
        searchField: 'nombre',
        options: JSON.parse(dataCiudadJson),
        valueField: 'id',
        labelField: 'nombre'
    });
    var selectizeControlCiudad = selectCiudad[0].selectize;

    // Arreglo con los datos de los relatores
    var dataRelator = $('#data-tag-relator').data('data');
    // Convertir arreglo a string
    var dataRelatorJson = JSON.stringify(dataRelator);
    var selectRelator = $('#select-beast-relator').selectize({
        create: false,
        searchField: 'nombre',
        options: JSON.parse(dataRelatorJson),
        valueField: 'id',
        labelField: 'nombre'
    });
    var selectizeControlRelator = selectRelator[0].selectize;

    var propuestaId;

    var curso;

    document.getElementById('select-beast-curso-alert').innerHTML = 'Seleccione una propuesta.';
    document.getElementById('select-beast-curso').setAttribute('class', 'form-control is-invalid');

    mostrarOutdoor();
    mostrarAudioIluminacion();
});