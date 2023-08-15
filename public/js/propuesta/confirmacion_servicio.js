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

    /**
     * Calcular el monto final de la propuesta
     */
    function calcularMontoFinal() {
        var montoFinal = document.getElementById('monto-final');
        var sum = 0;
        servicios.forEach(servicio => {
            if (servicio !== '') {
                sum += parseInt(servicio.monto);
            }
        });
        document.getElementById('monto-final').setAttribute('class','form-control');
        if (sum.toString().length > 9) {
            document.getElementById('monto-final').setAttribute('class','form-control is-invalid');
            document.getElementById('monto-final').value = formatoDineroShow(0);
            return ;
        }
        montoFinal.value = formatoDineroShow(sum);
    }

    // /**
    //  * Obtiene todos los servicios de la propuesta
    //  */
    // function obtenerServicios() {
    //     var propuestaId = $('#propuesta-id').data('data');
    //     var resultado;
    //     $.ajax({
    //         type: "get",
    //         url: "/propuesta/obtener_servicios/" + propuestaId,
    //         async: false,
    //         success: function(result) {
    //             console.log('ajax obtener servicios ok');
    //             resultado = result;
    //         },
    //         error: function() {
    //             console.log('error obtener servicios ajax');
    //         }
    //     });
    //     return resultado;
    // }

    // /**
    //  * Cargar los servicios a las tablas
    //  */
    // function cargarServicios() {
    //     var servicios = obtenerServicios();
    //     console.log(servicios);
    // }

    /**
     * Valida que exista minimo un servicio por curso
     * @param {*} propuesta 
     */
    function validarMinimoServicios(propuesta) {
        if (propuesta.tipo_servicio_id == 1) {
            cursosStr = $('#data-tag-cursos').data('data');
            cursos = JSON.parse(JSON.stringify(cursosStr));
            var valido = true;
            cursos.forEach(cursoValidar => {
                var tieneServicio = false;
                servicios.forEach(servicio => {
                    if (servicio.cursoId == cursoValidar.id){
                        tieneServicio = true;
                        return;
                    }
                });
                if (!tieneServicio) {
                    valido = false;
                    return;
                }
            });
            return valido;
        } else {
            var valido = false;
            servicios.forEach(servicio => {
                if (servicio != '') {
                    valido = true;
                    return;
                }
            });
            return valido;
        }
    }

    /**
     * Envia los datos de todos los servicios
     */
    window.enviarDatos = function(propuesta) {
        console.log("Ejecutando enviarDatos...");
    
        // Verificar que exista al menos un servicio por curso
        var error = document.getElementById('error');
        if (!validarMinimoServicios(propuesta)) {
            console.log("No se cumple la validación de mínimo de servicios por curso.");
            error.innerHTML = 'Debe existir al menos un servicio por curso.';
            error.hidden = false;
            error.focus();
            return;
        } else {
            console.log("Validación de mínimo de servicios por curso exitosa.");
            error.hidden = true;
        }
    
        //
        if(!validarNoCero(quitarFormatoDinero(document.getElementById('monto-final').value),'monto-final')){
            console.log("No se cumple la validación de monto no cero.");
            return;
        }
    
        // Confirmación de datos
        var respuesta = confirm("¿Está seguro que los datos están correctos?");
        if(respuesta == false){
            console.log("Confirmación de datos cancelada.");
            return;
        }
    
        // Verificar que sea un programa y no un curso para obtener si está seleccionado el diploma curso
        var diplomaPrograma = 0;
        if (propuesta.tipo_servicio_id == 1) {
            diplomaPrograma = reemplazarTrueFalse(document.getElementById('diploma-programa').checked);
        }
    
        console.log("Enviando datos por AJAX...");
    
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/propuesta/guardar_servicios",
            data: {
                propuestaId: propuesta.id,
                diplomaPrograma: diplomaPrograma,
                montoFinal: quitarFormatoDinero(this.document.getElementById('monto-final').value),
                servicios: servicios,
            },
            success: function(result) {
                console.log("Respuesta AJAX exitosa.");
                window.location.replace("/propuesta");
            },
            error: function(xhr) {
                console.log("Error en la respuesta AJAX.");
            }
        });
    }

    /**
     * Agrega el servicio a la tabla que corresponda
     * @param {*} servicio
     * @param {*} id
     */
    function mostrarCambiosServicio(servicio, id) {
        // Obtener la tabla
        var tabla = document.getElementById(curso.id);
        // Crear la nueva fila
        var idRow = buscarColumnaTabla(curso.id, id);
        tabla.deleteRow(idRow);
        var row = tabla.insertRow(idRow);
        // Crear las celdas
        var cellId = row.insertCell(0);
        var cellNombre = row.insertCell(1);
        var cellFecha = row.insertCell(2);
        var cellMonto = row.insertCell(3);
        var cellHorario = row.insertCell(4);
        var cellRelator = row.insertCell(5);
        var cellCiudad = row.insertCell(6);
        var cellAcciones = row.insertCell(7);
        // Asignar los valores a las celdas
        cellNombre.innerHTML = servicio.nombre;
        var fecha = servicio.fechaEjecucion.split('-');
        cellFecha.innerHTML = fecha[2] + '-' + fecha[1] + '-' + fecha[0];
        cellMonto.innerHTML = formatoDineroShow(servicio.monto);
        cellHorario.innerHTML = servicio.horario;
        if (servicio.relatorId == '') {
            cellRelator.innerHTML = '';
        } else {
            cellRelator.innerHTML = JSON.parse(dataRelatorJson).find(function(relator) {
                return relator.id == servicio.relatorId;
            }).nombre;
        }
        if (servicio.ciudadId == '') {
            cellCiudad.innerHTML = '';
        } else {
            cellCiudad.innerHTML = JSON.parse(dataCiudadJson).find(function(ciudad) {
                return ciudad.id == servicio.ciudadId;
            }).nombre;
        }
        var cursoString = JSON.stringify(curso);
        // cursoString = cursoString.replace('"',"'");
        cellAcciones.innerHTML = "<button onClick='desplegarEditarServicio(" + cursoString + ',' + servicio.id + ");' class='btn btn-blue btn-sm' title='Editar'><i class='fas fa-edit'></i></button> <button onClick='eliminarServicio(" + curso.id + ',' + servicio.id + ");' class='btn btn-indigo btn-sm' title='Eliminar'><i class='fas fa-trash-alt'></i></button>";
        cellId.innerHTML = '<div hidden>' + servicio.id + '</id>';
    }

    /**
     * Asignar 1 check, 0 no check
     */
    function reemplazarTrueFalse(check) {
        if (check) {
            return '1';
        } else {
            return '0';
        }
    }

    /**
     * Asignar true check, false no check
     */
    function reemplazarTrueFalseInverso(valor) {
        if (valor == '1') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Editar el servicio
     */
    function editarServicio(id) {
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
            id: id,
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
     * Guarda los cambios realizados al servicio
     */
    window.modificarServicio = function(id) {
        if(!validarServicio()) {
            return false;
        }
        var servicio = editarServicio(id);
        // Guardar el servicio
        servicios[id] = servicio;
        mostrarCambiosServicio(servicio,id);
        // Actualizar el monto final
        calcularMontoFinal();
        // Cerrar el modal
        $('#modal-agregar-servicio').modal('hide');
    }

    /**
     * Permite editar un servicio agregado
     */
    window.desplegarEditarServicio = function(cursoVista, id) {
        curso = cursoVista;
        // Poner el titulo
        document.getElementById('agregar-servicio-title').innerText = 'Editar: ' + curso.nombre_venta;
        // Cargar los datos del servicio
        document.getElementById('nombre-servicio').value = servicios[id].nombre;
        document.getElementById('monto').value = formatoDineroShow(servicios[id].monto);
        document.getElementById('numero-horas').value = formatoNumeroShow(servicios[id].numeroHoras);
        document.getElementById('numero-participantes').value = formatoNumeroShow(servicios[id].numeroParticipantes);
        document.getElementById('fecha-ejecucion').value = servicios[id].fechaEjecucion;
        document.getElementById('horario').value = servicios[id].horario;
        if (servicios[id].sence !== 0) {
            document.getElementById('sence-si-no').checked = true;
        } else {
            document.getElementById('sence-si-no').checked = false;
        }
        elegirSence();
        selectizeControlCiudad.setValue(servicios[id].ciudadId,false);
        document.getElementById('lugar').value = servicios[id].lugar;
        document.getElementById('salon').value = servicios[id].salon;
        selectizeControlRelator.setValue(servicios[id].relatorId, false);
        // Cargar datos checklist
        document.getElementById('coffee').checked = reemplazarTrueFalseInverso(servicios[id].actividades.coffee);
        document.getElementById('almuerzo').checked = reemplazarTrueFalseInverso(servicios[id].actividades.almuerzo);
        document.getElementById('outdoor').checked = reemplazarTrueFalseInverso(servicios[id].actividades.outdoor);
        document.getElementById('audio-iluminacion').checked = reemplazarTrueFalseInverso(servicios[id].actividades.outdoor);
        document.getElementById('encuesta-empresa').checked = reemplazarTrueFalseInverso(servicios[id].actividades.encuestaEmpresa);
        document.getElementById('encuesta-adicionales').checked = reemplazarTrueFalseInverso(servicios[id].actividades.encuestaAdicionales);
        document.getElementById('guias').checked = reemplazarTrueFalseInverso(servicios[id].actividades.guias);
        document.getElementById('bitacora').checked = reemplazarTrueFalseInverso(servicios[id].actividades.bitacora);
        document.getElementById('carpeta-participantes').checked = reemplazarTrueFalseInverso(servicios[id].actividades.carpetaParticipantes);
        document.getElementById('pruebas').checked = reemplazarTrueFalseInverso(servicios[id].actividades.pruebas);
        document.getElementById('lapices').checked = reemplazarTrueFalseInverso(servicios[id].actividades.lapices);
        document.getElementById('velobind').checked = reemplazarTrueFalseInverso(servicios[id].actividades.velobind);
        document.getElementById('diploma-curso').checked = reemplazarTrueFalseInverso(servicios[id].actividades.diplomaCurso);
        document.getElementById('detalles').value = servicios[id].detalles;
        // Verificar opciones outdoor y audio e iluminacion
        mostrarOutdoor();
        mostrarAudioIluminacion();
        // Cargar materiales outdoor
        document.getElementById('venda').checked = reemplazarTrueFalseInverso(servicios[id].outdoor.venda);
        document.getElementById('pvc').checked = reemplazarTrueFalseInverso(servicios[id].outdoor.pvc);
        document.getElementById('pelota').checked = reemplazarTrueFalseInverso(servicios[id].outdoor.pelota);
        document.getElementById('plumones').checked = reemplazarTrueFalseInverso(servicios[id].outdoor.plumones);
        document.getElementById('papel-kraft').checked = reemplazarTrueFalseInverso(servicios[id].outdoor.papelKraft);
        document.getElementById('pechera').checked = reemplazarTrueFalseInverso(servicios[id].outdoor.pechera);
        document.getElementById('masking').checked = reemplazarTrueFalseInverso(servicios[id].outdoor.masking);
        document.getElementById('bolsa-basura').checked = reemplazarTrueFalseInverso(servicios[id].outdoor.bolsaBasura);
        document.getElementById('cono').checked = reemplazarTrueFalseInverso(servicios[id].outdoor.cono);
        document.getElementById('plato').checked = reemplazarTrueFalseInverso(servicios[id].outdoor.plato);
        document.getElementById('aro-madera').checked = reemplazarTrueFalseInverso(servicios[id].outdoor.aroMadera);
        document.getElementById('tijera').checked = reemplazarTrueFalseInverso(servicios[id].outdoor.tijera);
        document.getElementById('esqui').checked = reemplazarTrueFalseInverso(servicios[id].outdoor.esqui);
        document.getElementById('otros-outdoor').value = servicios[id].outdoor.otros;
        // Cargar materiales audio e iluminacion
        document.getElementById('parlantes').checked = reemplazarTrueFalseInverso(servicios[id].audioIluminacion.parlantes);
        document.getElementById('atril').checked = reemplazarTrueFalseInverso(servicios[id].audioIluminacion.atril);
        document.getElementById('alargador').checked = reemplazarTrueFalseInverso(servicios[id].audioIluminacion.alargador);
        document.getElementById('foco').checked = reemplazarTrueFalseInverso(servicios[id].audioIluminacion.foco);
        document.getElementById('microfono-cintillo').checked = reemplazarTrueFalseInverso(servicios[id].audioIluminacion.microfonoCintillo);
        document.getElementById('microfono-inalambrico').checked = reemplazarTrueFalseInverso(servicios[id].audioIluminacion.microfonoInalambrico);
        document.getElementById('otros-audio-iluminacion').value = servicios[id].audioIluminacion.otros;
        // Modificar el boton de aceptar
        var boton = document.getElementById('btn-agregar-servicio');
        boton.innerHTML = 'Guardar Cambios';
        boton.setAttribute( "onClick", "javascript: modificarServicio(" + id + ");" );
        // Activar el pop-up (modal)
        $('#modal-agregar-servicio').modal('toggle');
    }

    /**
     * Busca el id de la columna en la tabla
     *
     * @param int tablaId
     * @return id
     */
    function buscarColumnaTabla(tablaId, id){
        var tabla, tr, td, i, txtValue;
        // Obtener la tabla
        var tabla = document.getElementById(tablaId);
        tr = tabla.getElementsByTagName('tr');
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.indexOf(id) > -1) {
                    return i;
                }
            }
        }
    }

    /**
     * Permite eliminar un servicio agregado
     */
    window.eliminarServicio = function(cursoId, id) {
        // Confirmacion de datos
        var respuesta = confirm("¿Está seguro que quiere eliminar el servicio?");
        if(respuesta==false){
            return;
        }
        var tabla = document.getElementById(cursoId);
        tabla.deleteRow(buscarColumnaTabla(cursoId, id));
        servicios[id] = '';
        calcularMontoFinal();
    }

    /**
     * Agrega el servicio a la tabla que corresponda
     */
    function mostrarServicio(servicio) {
        // Obtener la tabla
        var tabla = document.getElementById(curso.id);
        // Crear la nueva fila
        var row = tabla.insertRow(tabla.length);
        // Crear las celdas
        var cellId = row.insertCell(0);
        var cellNombre = row.insertCell(1);
        var cellFecha = row.insertCell(2);
        var cellMonto = row.insertCell(3);
        var cellHorario = row.insertCell(4);
        var cellRelator = row.insertCell(5);
        var cellCiudad = row.insertCell(6);
        var cellAcciones = row.insertCell(7);
        // Asignar los valores a las celdas
        cellNombre.innerHTML = servicio.nombre;
        var fecha = servicio.fechaEjecucion.split('-');
        cellFecha.innerHTML = fecha[2] + '-' + fecha[1] + '-' + fecha[0];
        cellMonto.innerHTML = formatoDineroShow(servicio.monto);
        cellHorario.innerHTML = servicio.horario;
        if (servicio.relatorId == '') {
            cellRelator.innerHTML = '';
        } else {
            cellRelator.innerHTML = JSON.parse(dataRelatorJson).find(function(relator) {
                return relator.id == servicio.relatorId;
            }).nombre;
        }
        if (servicio.ciudadId == '') {
            cellCiudad.innerHTML = '';
        } else {
            cellCiudad.innerHTML = JSON.parse(dataCiudadJson).find(function(ciudad) {
                return ciudad.id == servicio.ciudadId;
            }).nombre;
        }
        var cursoString = JSON.stringify(curso);
        // cursoString = cursoString.replace('"',"'");
        cellAcciones.innerHTML = "<button onClick='desplegarEditarServicio(" + cursoString + ',' + servicio.id + ");' class='btn btn-blue btn-sm' title='Editar'><i class='fas fa-edit'></i></button> <button onClick='eliminarServicio(" + curso.id + ',' + servicio.id + ");' class='btn btn-indigo btn-sm' title='Elimnar'><i class='fas fa-trash-alt'></i></button>";
        cellId.innerHTML = '<div hidden>' + servicio.id + '</id>';
    }

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
        if(!validarNoCero(quitarFormatoDinero(document.getElementById('monto').value),'monto')){
            valido = false;
        }
        return valido;
    }

    /**
     * Verifica que el codigo sence este seleccionado para enviar los datos
     *
     * @returns sence
     */
    function verificarCodigoSence() {
        if(document.getElementById('sence-si-no').checked) {
            return 1
        } else {
            return 0;
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
            id: contServicios,
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
        contServicios++;
        return servicio;
    }

    /**
     * Agregar el servicio a los servicios y mostrarlo en la vista
     */
    window.agregarServicio = function() {
        if(!validarServicio()) {
            return false;
        }
        // // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        var servicio = crearServicio();
        // Guardar el servicio
        servicios.push(servicio);
        mostrarServicio(servicio);
        // Actualizar el monto final
        calcularMontoFinal();
        // Cerrar el modal
        $('#modal-agregar-servicio').modal('hide');
        // $.ajax({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     type: "POST",
        //     url: "/propuesta/guardar_servicio",
        //     data: servicio,
        //     success: function(result) {
        //         console.log('ajax servicio ok');
        //     },
        //     error: function(xhr) {
        //         console.log('ajax servicio error');
        //     }
        // });
    }

    /**
     * Activa el pop-up (modal) que permite agregar servicios
     */
    window.desplegarAgregarServicio = function(cursoVista) {
        // Guardar el id en un data-tag para poder enviarlo
        // document.getElementById('data-curso').value = curso;
        curso = cursoVista;
        // ocultar mensaje outdoor
        mostrarOutdoor();
        mostrarAudioIluminacion();
        // Poner el titulo
        document.getElementById('agregar-servicio-title').innerText = curso.nombre_venta;
        // El nombre del servicio se carga con el nombre del curso
        document.getElementById('nombre-servicio').value = curso.nombre_venta;
        document.getElementById('numero-horas').value = formatoNumeroShow(curso.cant_horas);
        // document.getElementById('numero-participantes').value = curso.cant_participantes;
        elegirSence();
        // Modificar el boton de aceptar
        var boton = document.getElementById('btn-agregar-servicio');
        boton.innerHTML = 'Agregar';
        boton.setAttribute( "onClick", "javascript: agregarServicio();" );
        // Activar el pop-up (modal)
        $('#modal-agregar-servicio').modal('toggle');
    }

    /**
     * Cambia el campo codigo sence entre activo e inactivo
     */
    window.elegirSence = function() {
        senceSiNo = document.getElementById('sence-si-no');
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

    // /**
    //  * Muestra la imagen mientras espera la respuesta por ajax
    //  */
    // $('#imagen-carga').bind('ajaxStart', function(){
    //     $(this).show();
    // }).bind('ajaxStop', function(){
    //     $(this).hide();
    // });

    // Obtener ciudad de la empresa
    var ciudadId = $('#data-tag-ciudad-id').data('data');
    // Arreglo con los datos de las ciudades
    var dataCiudad = $('#data-tag-ciudad').data('data');
    // Convertir arreglo a string
    var dataCiudadJson = JSON.stringify(dataCiudad);
    var selectCiudad = $('#select-beast-ciudad').selectize({
        create: false,
        searchField: 'nombre',
        items: [ciudadId],
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
        labelField: 'nombre',
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.nombre) + ' '
                    + escape(item.apellido)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.nombre) + ' '
                    + escape(item.apellido)
                    + '</div>';
            }
        }
    });
    var selectizeControlRelator = selectRelator[0].selectize;

    var curso;

    var contServicios = 0;

    var servicios = [];

    // cargarServicios();
});