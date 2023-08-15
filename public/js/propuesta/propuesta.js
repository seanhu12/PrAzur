$(document).ready(function() {

    /**
     * Validar propuesta cumple requisitos estado enviado
     */
    function validarCamposNecesariosEnviada(propuesta) {
        if (propuesta.monto === null || propuesta.monto === 0) {
            return false;
        }
        if (propuesta.cant_total_horas === null || propuesta.cant_total_horas === 0) {
            return false;
        }
        if (propuesta.uf_hora === null || propuesta.uf_hora === 0) {
            return false;
        }
        if (propuesta.programa_id === null && propuesta.curso_id === null) {
            return false;
        }
        return true;
    }

    /**
     * Cambiar color table header
     */
    $('tr').each(function(){
        $(this).find('th').addClass('blue');
    })

    /**
     * Dynatable
     */
    var dynatable = $('#tabla')
    .bind('dynatable:init', function(e, dynatable) {
        dynatable.queries.functions['select-beast-estado'] = function(record, queryValue) {
            var nombre;
            dataEstadoJson.forEach(estado => {
                if (estado.id == queryValue) {
                    nombre = estado.nombre;
                }
            });
            return nombre === record.estado;
        };
        dynatable.queries.functions['select-beast-empresa'] = function(record, queryValue) {
            var nombre;
            dataEmpresaJson.forEach(empresa => {
                if (empresa.id == queryValue) {
                    nombre = empresa.nombre;
                }
            });
            return nombre === record.empresa;
        };
        dynatable.queries.functions['select-beast-programa'] = function(record, queryValue) {
            var nombre;
            dataProgramaJson.forEach(programa => {
                if (programa.id == queryValue) {
                    nombre = programa.nombre;
                }
            });
            return nombre === $.trim(record.programaOCurso);
        };
        dynatable.queries.functions['select-beast-curso'] = function(record, queryValue) {
            var nombre;
            dataCursoJson.forEach(curso => {
                if (curso.id == queryValue) {
                    nombre = curso.nombre_venta;
                }
            });
            return nombre === $.trim(record.programaOCurso);
        };
        // dynatable.queries.functions['buscar-idp'] = function(record, queryValue) {
        //     return queryValue === record.idp;
        // };
        dynatable.queries.functions['fecha-inicio'] = function(record, queryValue) {
            var parts = record.fechaCreación.split('-');
            var fechaRecord = new Date(parts[2],parts[1] - 1, parts[0]);
            var fechaQuery = new Date(queryValue);
            return fechaRecord >= fechaQuery;
        };
        dynatable.queries.functions['fecha-termino'] = function(record, queryValue) {
            var parts = record.fechaCreación.split('-');
            var fechaRecord = new Date(parts[2],parts[1] - 1, parts[0]);
            var fechaQuery = new Date(queryValue);
            return fechaRecord <= fechaQuery;
        };
    })
    .dynatable({
        features: {
            paginate: true,
            recordCount: true,
            sorting: true,
            search: true,
            perPageSelect: true
        },
        inputs: {
            // queries: $('#select-beast-estado, #select-beast-empresa, #buscar-idp, #fecha-inicio, #fecha-termino'),
            queries: $('#select-beast-estado, #select-beast-empresa, #select-beast-programa, #select-beast-curso, #fecha-inicio, #fecha-termino'),
        },
        readers: {
            'idp': function(el, record) {
                return Number(el.innerHTML) || 0;
            }
        }
    }).data('dynatable');

    /**
     * Remueve el filtro del estado
     */
    window.removerFiltroEstado = function() {
        selectizeControlEstado.clear();
    }

    /**
     * Remueve el filtro de la empresa
     */
    window.removerFiltroEmpresa = function() {
        selectizeControlEmpresa.clear();
    }

    /**
     * Remueve el filtro de la programa
     */
    window.removerFiltroPrograma = function() {
        selectizeControlPrograma.clear();
    }

    /**
     * Remueve el filtro de la curso
     */
    window.removerFiltroCurso = function() {
        selectizeControlCurso.clear();
    }

    // /**
    //  * Remueve el filtro de la idp
    //  */
    // window.removerFiltroOt = function() {
    //     document.getElementById('buscar-idp').value = '';
    //     document.getElementById('buscar-idp').focus();
    //     document.getElementById('buscar-idp').blur();
    // }

    /**
     * Remueve el filtro de la fecha incio
     */
    window.removerFiltroFechaInicio = function() {
        document.getElementById('fecha-inicio').value = '';
        document.getElementById('fecha-inicio').focus();
        document.getElementById('fecha-inicio').blur();
    }

    /**
     * Remueve el filtro de la fecha termino
     */
    window.removerFiltroFechaTermino = function() {
        document.getElementById('fecha-termino').value = '';
        document.getElementById('fecha-termino').focus();
        document.getElementById('fecha-termino').blur();
    }

    /**
     * Activa el pop-up (modal) que permite cambiar el estado
     */
    window.desplegarEstados = function(propuesta, estado) {
        // Guardar el id en un data-tag para poder enviarlo
        document.getElementById('data-propuesta').value = propuesta;
        // Poner el titulo
        document.getElementById('estado-actual').innerText = estado;
        // Esconder el motivo
        document.getElementById('motivos-div').hidden = true;
        // Esconder mensaje error validacion
        this.document.getElementById('mensaje-validacion').hidden = true;
        // Poner las opciones segun corresponda
        var select = document.getElementById('select-estados');
        select.options.length = 0;
        if (estado === 'No Enviada') {
            select.options[select.options.length] = new Option('Enviada', '2');
            select.options[select.options.length] = new Option('Cancelada', '3');
        }
        if (estado === 'Enviada') {
            select.options[select.options.length] = new Option('Aceptada', '4');
            select.options[select.options.length] = new Option('Rechazada', '5');
        }
        // Activar el pop-up (modal)
        $('#modal-estados').modal('toggle');
    }

    /**
     * Activar el text area para ingresar el motivo en caso de que sea rechazada la propuesta
     */
    window.ingresaMotivo = function() {
        var select = document.getElementById('select-estados');
        var selectMotivos = document.getElementById('motivos');
        selectMotivos.options.length = 0;
        // Esconder mensaje error validacion
        this.document.getElementById('mensaje-validacion').hidden = true;
        // Estado Enviada
        if (select.value === '2') {
            if (!validarCamposNecesariosEnviada(JSON.parse(JSON.stringify(document.getElementById('data-propuesta').value)))) {
                this.document.getElementById('mensaje-validacion').hidden = false;
                return false;
            }
        }
        // Estado Rechazada
        if (select.value === '5') {
            // Arreglo con los datos
            var dataMotivos = $('#data-tag-motivo').data('data');
            // Convertir arreglo a string
            var dataMotivosJson = JSON.stringify(dataMotivos);
            // Convertir arreglo a json
            var dataMotivosJson = JSON.parse(dataMotivosJson);
            dataMotivosJson.forEach(motivo => {
                selectMotivos.options[selectMotivos.options.length] = new Option(motivo.nombre, motivo.id)
            });
            selectMotivos.options = dataMotivos;
            document.getElementById('motivos-div').hidden = false;
        } else {
            document.getElementById('motivos-div').hidden = true;
        }
        return true;
    }

    /**
     * Permitir ingresar el motivo en caso de rechazo
     */
    window.permitirIngresarMotivo = function() {
        if (document.getElementById('select-estados') == 'Rechazada') {
            document.getElementById('motivo').style.visibility = 'visible';
        } else {
            document.getElementById('motivo').style.visibility = 'hidden';
        }
    }

    /**
     * Cambio de estado de la propuesta
     */
    window.cambiarEstado = function() {
        if (!ingresaMotivo()) {
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Confirmación para cambio de estado?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/propuesta/cambiar_estado",
            data: {
                id: JSON.parse(JSON.stringify(document.getElementById('data-propuesta').value)).id,
                estado_id: $('#select-estados').val(),
                motivo_id: $('#motivos').val()
            },
            success: function(result) {
                // console.log('ajax ok');
                location.reload();
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    }

    // Select estados
    // Arreglo con los datos
    var dataEstado = $('#data-tag-estado').data('data');
    // Convertir arreglo a string
    var dataEstadoJson = JSON.stringify(dataEstado);
    // Convertir arreglo a json
    var dataEstadoJson = JSON.parse(dataEstadoJson)
    // Crear elinput-tag (selectize)
    var selectEstado = $('#select-beast-estado').selectize({
        create: false,
        searchField: 'nombre',
        options: dataEstadoJson,
        valueField: 'id',
        labelField: 'nombre',
        allowEmptyOption: true
    });
    var selectizeControlEstado = selectEstado[0].selectize;

    // Select empresas
    // Arreglo con los datos
    var dataEmpresa = $('#data-tag-empresa').data('data');
    // Convertir arreglo a string
    var dataEmpresaJson = JSON.stringify(dataEmpresa);
    // Convertir arreglo a json
    var dataEmpresaJson = JSON.parse(dataEmpresaJson)
    // Crear elinput-tag (selectize)
    var selectEmpresa = $('#select-beast-empresa').selectize({
        create: false,
        searchField: 'nombre',
        options: dataEmpresaJson,
        valueField: 'id',
        labelField: 'nombre',
        allowEmptyOption: true
    });
    var selectizeControlEmpresa = selectEmpresa[0].selectize;

    // Select programa
    // Arreglo con los datos
    var dataPrograma = $('#data-tag-programa').data('data');
    // Convertir arreglo a string
    var dataProgramaJson = JSON.stringify(dataPrograma);
    // Convertir arreglo a json
    var dataProgramaJson = JSON.parse(dataProgramaJson)
    // Crear elinput-tag (selectize)
    var selectPrograma = $('#select-beast-programa').selectize({
        create: false,
        searchField: 'nombre',
        options: dataProgramaJson,
        valueField: 'id',
        labelField: 'nombre',
        allowEmptyOption: true
    });
    var selectizeControlPrograma = selectPrograma[0].selectize;

    // Select curso
    // Arreglo con los datos
    var dataCurso = $('#data-tag-curso').data('data');
    // Convertir arreglo a string
    var dataCursoJson = JSON.stringify(dataCurso);
    // Convertir arreglo a json
    var dataCursoJson = JSON.parse(dataCursoJson)
    // Crear elinput-tag (selectize)
    var selectCurso = $('#select-beast-curso').selectize({
        create: false,
        searchField: 'nombre_venta',
        options: dataCursoJson,
        valueField: 'id',
        labelField: 'nombre_venta',
        allowEmptyOption: true
    });
    var selectizeControlCurso = selectCurso[0].selectize;
});