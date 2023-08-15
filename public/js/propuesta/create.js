$(document).ready(function () {

    $('#cant_total_horas').keyup(function() {
        var cantHoras = document.getElementById('cant_total_horas');
        var numeroCantHoras = cantHoras.value;
        cantHoras.value = formatoDecimalInput(numeroCantHoras);
    });

    $('#uf_hora').keyup(function() {
        var valorUf = document.getElementById('uf_hora');
        var montoValorUf = valorUf.value;
        valorUf.value = formatoDineroInput(montoValorUf);
    });

    /**
     * Calculo del monto
     */
    window.calcularMonto = function () {
        cantHoras = quitarFormatoDecimal(document.getElementById('cant_total_horas').value);
        valorUf = quitarFormatoDinero(document.getElementById('uf_hora').value);
        var total = cantHoras * valorUf;
        total = total.toFixed(0);
        document.getElementById('monto').setAttribute('class','form-control');
        if (total.toString().length > 9) {
            document.getElementById('monto').setAttribute('class','form-control is-invalid');
            document.getElementById('monto').value = formatoDineroShow(0);
            return ;
        }
        document.getElementById('monto').value = formatoDineroShow(total);
    }

    /**
     * Checkbox experiencia ads si
     */
    window.experienciaAdsSi = function () {
        if (document.getElementById('experiencia-ads-si').checked) {
            document.getElementById('experiencia-ads-no').checked = false;
            document.getElementById('experiencia-ads-text').removeAttribute('readonly');
        } else {
            document.getElementById('experiencia-ads-text').setAttribute('readonly','');
            document.getElementById('experiencia-ads-text').value = '';
        }
    }

    /**
     * Checkbox experiencia ads no
     */
    window.experienciaAdsNo = function () {
        if (document.getElementById('experiencia-ads-no').checked) {
            document.getElementById('experiencia-ads-si').checked = false;
            document.getElementById('experiencia-ads-text').setAttribute('readonly','');
            document.getElementById('experiencia-ads-text').value = '';
        }
    }

    /**
     * Checkbox experiencia tematica si
     */
    window.experienciaTematicaSi = function () {
        if (document.getElementById('experiencia-tematica-si').checked) {
            document.getElementById('experiencia-tematica-no').checked = false;
        }
    }

    /**
     * Checkbox experiencia tematica no
     */
    window.experienciaTematicaNo = function () {
        if (document.getElementById('experiencia-tematica-no').checked) {
            document.getElementById('experiencia-tematica-si').checked = false;
        }
    }

    /**
     * Habilita el input de los programas
     */
    window.habilitarPrograma = function() {
        selectizeControlPrograma.enable();
        selectizeControlCurso.disable();
        selectizeControlCurso.clear();
        document.getElementById('btn-cursos-programa').style.visibility = "visible";
        document.getElementById('select-beast-curso').setAttribute('class', 'form-control');
    }

    /**
     * Habilita el input de los cursos
     */
    window.habilitarCurso = function() {
        selectizeControlCurso.enable();
        selectizeControlPrograma.disable();
        selectizeControlPrograma.clear();
        document.getElementById('btn-cursos-programa').style.visibility = "hidden";
        document.getElementById('btn-cursos-programa').setAttribute('class', 'btn btn-primary');
        document.getElementById('btn-cursos-programa').textContent = 'Cursos del programa';
        document.getElementById('select-beast-programa').setAttribute('class', 'form-control');
    }

    /**
     * Cambia si esta habilitado el ingreso de programas o cursos
     */
    window.elegirProgramaCurso = function() {
        if(document.getElementById("opcion_curso").checked){
            habilitarCurso();
        }
        if(document.getElementById("opcion_programa").checked){
            habilitarPrograma();
        }
    }

    /**
     * Desplegar los cursos del programa
     */
    window.desplegarCursosPrograma = function() {
        // Verificar que se seleciono un curso
        if (selectizeControlPrograma.items.length === 0) {
            document.getElementById('btn-cursos-programa').setAttribute('class', 'btn btn-danger');
            document.getElementById('btn-cursos-programa').textContent = 'Se debe seleccionar un programa';
            return;
        }
        document.getElementById('cursos-programa-label').textContent = selectizeControlPrograma.options[selectizeControlPrograma.items].nombre;
        // Obtener los cursos del programa
        var cursosPrograma = JSON.parse(getCursosPrograma(selectizeControlPrograma.items));
        // Hacer una tabla de html con los cursos
        // Recorrer los cursos para crear las filas de la tabla
        var cursosHtml = '';
        cursosPrograma.forEach(function(curso) {
            cursosHtml = cursosHtml + '<tr>' + '<td>' + curso.nombre_venta + '</td>' + '</tr>';
        });
        // Hacer la tabla agregando las filas
        var html = '<table class="table">' + '<thead>' + '<tr>' + '<th>' + '<label class="form-label">Cursos</label>' + '</th>' + '</tr>' + '</thead>' + '<tbody>' + cursosHtml + '</tbody>' + '</table>';
        document.getElementById('cursos-programa').innerHTML = html;
        // Activar el pop-up (modal)
        $('#modal-cursos-programa').modal('toggle');
    }

    /**
     * Obtener los cursos de un programa
     */
    window.getCursosPrograma = function(programaId) {
        var resultadoCursos;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/propuesta/cursos_programa",
            async: false,
            data: {
                programaId: programaId
            },
            success: function(result) {
                resultadoCursos = result;
            },
            error: function() {
                // console.log('error datos cursos programa');
            }
        });
        return resultadoCursos;
    }

    /**
     * Despliega los archivos seleccionados y valida la cantidad maxima que se pueden seleccionar
     */
    $("#custom-file-propuesta").change(function() {
        // Valida que solo se seleccionen 20 archivos
        if (this.files.length > 20) {
            window.document.getElementById('custom-file-propuesta-alert').innerText = 'Solo se puede subir hasta 20 archivos.';
            window.document.getElementById('custom-file-propuesta').setAttribute('class', 'custom-file-input is-invalid');
            $("#custom-file-propuesta").val('');
            return;
        }
        // Validar extenciones de los archivos
        var extensionesPermitidas = /(.jpg|.jpeg|.png|.pdf|.doc|.docx|.xls|.xlsx|.ppt|.pptx)$/i;
        var invalido = false;
        Array.from(this.files).forEach(file => {
            if(!(extensionesPermitidas.test(file.name)&&file.size<=5242880)){
                invalido = true;
            }
        });
        if (invalido) {
            window.document.getElementById('custom-file-propuesta-alert').innerText = 'Se debe seleccionar un archivo de tipo doc, docx, xls, xlsx, ppt, pptx, png, jpeg, jpg o pdf de tamaño máximo 5 mb.';
            window.document.getElementById('custom-file-propuesta').setAttribute('class', 'custom-file-input is-invalid');
            $("#custom-file-propuesta").val('');
            document.getElementById('archivos').innerHTML = '';
            return;
        }
        window.document.getElementById('custom-file-propuesta').setAttribute('class', 'custom-file-input');
        // Hacer una tabla de html con los archivos
        // Recorrer los archivos para crear las filas de la tabla
        var archivosHtml = '';
        Array.from(this.files).forEach(file => {
            archivosHtml = archivosHtml + '<tr>' + '<td>' + file.name + '</td>' + '</tr>';
        });
        // Hacer la tabla agregando las filas
        var html = '<table>' + '<tbody>' + archivosHtml + '</tbody>' + '</table>';
        document.getElementById('archivos').innerHTML = html;
    });

    /**
     * Valida que si esta seleccionado programa se seleccione un programa o que si esta seleccionado curso se seleccione un curso
     */
    window.validarProgramaCursoNoNulo = function() {
        if(document.getElementById("opcion_curso").checked){
            return validarNoNulo(document.getElementById('select-beast-curso').value,'select-beast-curso');
        }
        if(document.getElementById("opcion_programa").checked){
            return validarNoNulo(document.getElementById('select-beast-programa').value,'select-beast-programa');
        }
    }

    window.validarMaxMinNumeroHoras = function () {
        window.document.getElementById('cant_total_horas').setAttribute('class', 'form-control');
        var cantHoras = document.getElementById('cant_total_horas').value;
        if (cantHoras === '') {
            return;
        }
        if(cantHoras.search(',') + 1 === cantHoras.length){
            window.document.getElementById('cant_total_horas').setAttribute('class', 'form-control is-invalid');
            return;
        }
        cantHoras = quitarFormatoDecimal(cantHoras);
        if(cantHoras > 999.9 || cantHoras < 0){
            window.document.getElementById('cant_total_horas').setAttribute('class', 'form-control is-invalid');
            valido = false;
            return;
        }
    }

    /**
     * Valida que el valor hora sea menor a 999999
     */
    window.validarValorHora = function() {
        document.getElementById('uf_hora').setAttribute('class','form-control');
        var valor = quitarFormatoDinero(document.getElementById('uf_hora').value);
        if (valor > 999999) {
            document.getElementById('uf_hora').setAttribute('class','form-control is-invalid');
            return false;
        }
        return true;
    }

    /**
     * Valida que los datos ingresados cumplan con sus restricciones
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarDatosIngresados = function() {
        var valido = true;
        window.document.getElementById('cant_total_horas').setAttribute('class', 'form-control');
        var cantHoras = document.getElementById('cant_total_horas').value;
        if (cantHoras !== '') {
            if(cantHoras.search(',') + 1 === cantHoras.length){
                window.document.getElementById('cant_total_horas').setAttribute('class', 'form-control is-invalid');
                valido = false;
            }
            cantHoras = quitarFormatoDecimal(cantHoras);
            if(cantHoras > 999.9 || cantHoras < 0){
                window.document.getElementById('cant_total_horas').setAttribute('class', 'form-control is-invalid');
                valido = false;
            }
        }
        if (!validarValorHora()) {
            valido = false;
        }
        // if(!validarNumero(document.getElementById('uf_hora').value,'uf_hora')){
        //     valido = false;
        // }
        if(!validarNoNulo(document.getElementById('fecha_propuesta').value,'fecha_propuesta')){
            valido = false;
        } else {
            if(!validarFechaNoFutura(document.getElementById('fecha_propuesta').value,'fecha_propuesta')){
                valido = false;
            }
        }
        if(!validarNoNulo(document.getElementById('fecha_compromiso').value,'fecha_compromiso')){
            valido = false;
        } else {
            if(!validarFechaNoPasada(document.getElementById('fecha_compromiso').value,'fecha_compromiso')){
                valido = false;
            }
        }
        // if(!validarNoNulo(document.getElementById('monto').value,'monto')){
        //     valido = false;
        // } else {
        // if(!validarNumero(document.getElementById('monto').value,'monto')){
        //     valido = false;
        // }
        // }
        if(!validarNoNulo(document.getElementById('select-beast-area').value,'select-beast-area')){
            valido = false;
        }
        if(!validarNoNulo(document.getElementById('select-beast-empresa').value,'select-beast-empresa')){
            valido = false;
        }
        // if(!validarNoNulo(document.getElementById('select-beast-contacto-empresa').value,'select-beast-contacto-empresa')){
        //     valido = false;
        // }
        // if(!validarProgramaCursoNoNulo()){
        //     valido = false;
        // }
        return valido;
    }

    /**
     * Envia los datos del programa
     */
    window.enviarDatos = function() {
        // Validaciones de los datos
        if (!validarDatosIngresados()) {
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        var experienciaAds;
        if (document.getElementById('experiencia-ads-si').checked) {
            experienciaAds = 1;
        } else {
            if (document.getElementById('experiencia-ads-no').checked) {
                experienciaAds = 0
            }
        }
        var experienciaTematica;
        if (document.getElementById('experiencia-tematica-si').checked) {
            experienciaTematica = 1;
        } else {
            if (document.getElementById('experiencia-tematica-no').checked) {
                experienciaTematica = 0
            }
        }
        var hayPerfiles = false;
        if (selectizeControlPerfil.getValue().length !== 0) {
            hayPerfiles = true;
        }
        var hayFocos = false;
        if (selectizeControlFoco.getValue().length !== 0) {
            hayFocos = true;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/propuesta/store",
            data: {
                fecha_propuesta: $('#fecha_propuesta').val(),
                fecha_compromiso: $('#fecha_compromiso').val(),
                cant_total_horas: quitarFormatoDecimal($('#cant_total_horas').val()),
                uf_hora: quitarFormatoDinero($('#uf_hora').val()),
                monto: quitarFormatoDinero($('#monto').val()),
                area_id: selectizeControlArea.getValue(),
                empresa_id: selectizeControlEmpresa.getValue(),
                contacto_empresa_id: selectizeControlContactoEmpresa.getValue(),
                // otic_id: selectizeControlOtic.getValue(),
                contacto_otic_id: selectizeControlContactoOtic.getValue(),
                programa_id: selectizeControlPrograma.getValue(),
                curso_id: selectizeControlCurso.getValue(),
                urgencia_id: selectizeControlUrgencia.getValue(),
                complejidad_grupo_id: selectizeControlComplejidad.getValue(),
                experiencia_ads: experienciaAds,
                experiencia_en: $('#experiencia-ads-text').val(),
                experiencia_tematica: experienciaTematica,
                hayPerfiles: hayPerfiles,
                perfiles: selectizeControlPerfil.getValue(),
                hayFocos: hayFocos,
                focos: selectizeControlFoco.getValue(),
                foco_observacion: $('#foco-observacion').val(),
                observaciones: $('#observaciones').val()
            },
            success: function(result) {
                // console.log('ajax ok');
                enviarArchivos(result);
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };

    window.enviarArchivos = function (id) {
        var form_data = new FormData();
        var ins = document.getElementById('custom-file-propuesta').files.length;
        for (var x = 0; x < ins; x++) {
            form_data.append("files[]", document.getElementById('custom-file-propuesta').files[x]);
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/propuesta/guardar_archivos/' + id,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (result) {
                // console.log('ajax archivos ok');
                window.location.replace("/propuesta");
            },
            error: function (xhr) {
                // console.log('ajax archivos error');
            }
        });
    };

    /**
     * Obtener los contactos de la empresa seleccionada
     */
    window.getContactosEmpresa = function(empresaId) {
        var contactos;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/propuesta/contactos_empresa",
            data : {
                empresaId: empresaId
            },
            async: false,
            success: function(result) {
                contactos = result;
            },
            error: function() {
                // console.log('error datos contactos empresa');
            }
        });
        return contactos;
    }

    // Select areas
    // Arreglo con los datos
    var dataArea = $('#data-tag-area').data('data');
    // Convertir arreglo a string
    var dataAreaJson = JSON.stringify(dataArea);
    // Crear elinput-tag (selectize)
    var selectArea = $('#select-beast-area').selectize({
        create: false,
        searchField: 'nombre',
        items: [1],
        options: JSON.parse(dataAreaJson),
        valueField: 'id',
        labelField: 'nombre'
    });
    var selectizeControlArea = selectArea[0].selectize;
    selectizeControlArea.disable();

    // Select empresas
    // Arreglo con los datos
    var dataEmpresa = $('#data-tag-empresa').data('data');
    // Convertir arreglo a string
    var dataEmpresaJson = JSON.stringify(dataEmpresa);
    // Crear elinput-tag (selectize)
    var selectEmpresa = $('#select-beast-empresa').selectize({
        create: false,
        searchField: 'nombre',
        options: JSON.parse(dataEmpresaJson),
        valueField: 'id',
        labelField: 'nombre',
        onChange: function() {
            document.getElementById('select-beast-empresa').setAttribute('class', 'form-control');
            // selectizeControlContactoEmpresa.options = JSON.parse(nuevosContactos);
            selectizeControlContactoEmpresa.clear();
            selectizeControlContactoEmpresa.clearOptions();
            selectizeControlContactoEmpresa.load(function(callback) {
                callback(JSON.parse(getContactosEmpresa(selectizeControlEmpresa.items[0])));
            });
            document.getElementById('select-beast-contacto-empresa-alert').innerText = 'Se debe seleccionar un contacto de la empresa.';
            document.getElementById('select-beast-contacto-empresa').setAttribute('class', 'form-control');
            if (jQuery.isEmptyObject(selectizeControlContactoEmpresa.options)) {
                selectizeControlContactoEmpresa.disable()
                document.getElementById('select-beast-contacto-empresa-alert').innerText = 'No hay contactos.';
                document.getElementById('select-beast-contacto-empresa').setAttribute('class', 'form-control is-invalid');
            } else {
                selectizeControlContactoEmpresa.enable()
            }
        }
    });
    var selectizeControlEmpresa = selectEmpresa[0].selectize;

    // Select contactos empresa
    // Arreglo con los datos
    var dataContactoEmpresa = $('#data-tag-contacto-empresa').data('data');
    // Convertir arreglo a string
    var dataContactoEmpresaJson = JSON.stringify(dataContactoEmpresa);
    // Crear elinput-tag (selectize)
    var selectContactoEmpresa = $('#select-beast-contacto-empresa').selectize({
        create: false,
        searchField: 'nombre',
        // options: JSON.parse(dataContactoEmpresaJson),
        valueField: 'id',
        labelField: 'nombre',
        onChange: function() {
            document.getElementById('select-beast-contacto-empresa').setAttribute('class', 'form-control');
        },
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
    var selectizeControlContactoEmpresa = selectContactoEmpresa[0].selectize;

    // Select contactos otic
    // Arreglo con los datos
    var dataContactoOtic = $('#data-tag-contacto-otic').data('data');
    // Convertir arreglo a string
    var dataContactoOticJson = JSON.stringify(dataContactoOtic);
    // Crear elinput-tag (selectize)
    var selectContactoOtic = $('#select-beast-contacto-otic').selectize({
        create: false,
        searchField: 'nombre',
        options: JSON.parse(dataContactoOticJson),
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
    var selectizeControlContactoOtic = selectContactoOtic[0].selectize;

    // Select programas
    // Arreglo con los datos
    var dataPrograma = $('#data-tag-programa').data('data');
    // Convertir arreglo a string
    var dataProgramaJson = JSON.stringify(dataPrograma);
    // Crear elinput-tag (selectize)
    var selectPrograma = $('#select-beast-programa').selectize({
        create: false,
        searchField: 'nombre',
        options: JSON.parse(dataProgramaJson),
        valueField: 'id',
        labelField: 'nombre',
        onItemAdd: function () {
            document.getElementById('btn-cursos-programa').setAttribute('class', 'btn btn-primary');
            document.getElementById('btn-cursos-programa').textContent = 'Cursos del programa';
        },
        onChange: function() {
            document.getElementById('select-beast-programa').setAttribute('class', 'form-control');
        }
    });
    var selectizeControlPrograma = selectPrograma[0].selectize;

    // Select cursos
    // Arreglo con los datos
    var dataCurso = $('#data-tag-curso').data('data');
    // Convertir arreglo a string
    var dataCursoJson = JSON.stringify(dataCurso);
    // Crear elinput-tag (selectize)
    var selectCurso = $('#select-beast-curso').selectize({
        create: false,
        searchField: 'nombre_venta',
        options: JSON.parse(dataCursoJson),
        valueField: 'id',
        labelField: 'nombre_venta',
        onChange: function() {
            document.getElementById('select-beast-curso').setAttribute('class', 'form-control');
        }
    });
    var selectizeControlCurso = selectCurso[0].selectize;

    // Select urgencia
    // Arreglo con los datos
    var dataUrgencia = $('#data-tag-urgencia').data('data');
    // Convertir arreglo a string
    var dataUrgenciaJson = JSON.stringify(dataUrgencia);
    // Crear elinput-tag (selectize)
    var selectUrgencia = $('#select-beast-urgencia').selectize({
        create: false,
        searchField: 'nombre',
        options: JSON.parse(dataUrgenciaJson),
        valueField: 'id',
        labelField: 'nombre'
    });
    var selectizeControlUrgencia = selectUrgencia[0].selectize;

    // Select complejidad
    // Arreglo con los datos
    var dataComplejidad = $('#data-tag-complejidad').data('data');
    // Convertir arreglo a string
    var dataComplejidad = JSON.stringify(dataComplejidad);
    // Crear elinput-tag (selectize)
    var selectComplejidad = $('#select-beast-complejidad').selectize({
        create: false,
        searchField: 'nombre',
        options: JSON.parse(dataComplejidad),
        valueField: 'id',
        labelField: 'nombre'
    });
    var selectizeControlComplejidad = selectComplejidad[0].selectize;

    // Arreglo con los perfiles de los participantes
    var dataPerfil = $('#data-tag-perfil').data('data');
    // Convertir arreglo a string
    var dataPerfilJson = JSON.stringify(dataPerfil);
    // Crear elinput-tag (selectize)
    var selectPerfil = $('#input-tags-perfil').selectize({
        persist: false,
        maxItems: null,
        valueField: 'id',
        labelField: 'nombre',
        searchField: 'nombre',
        options: JSON.parse(dataPerfilJson)
    });
    var selectizeControlPerfil = selectPerfil[0].selectize;

    // Arreglo con los focos
    var dataFoco = $('#data-tag-foco').data('data');
    // Convertir arreglo a string
    var dataFocoJson = JSON.stringify(dataFoco);
    // Crear elinput-tag (selectize)
    var selectFoco = $('#input-tags-foco').selectize({
        persist: false,
        maxItems: null,
        valueField: 'id',
        labelField: 'nombre',
        searchField: 'nombre',
        options: JSON.parse(dataFocoJson),
        onChange: function() {
            var mostrarObservacion = false;
            selectizeControlFoco.getValue().forEach(foco => {
                if (foco === '26') {
                    mostrarObservacion = true;
                    document.getElementById('foco-observacion').hidden = false;
                }
            });
            if (!mostrarObservacion) {
                document.getElementById('foco-observacion').hidden = true;
                document.getElementById('foco-observacion').value = '';
            }
        }
    });
    var selectizeControlFoco = selectFoco[0].selectize;

    document.getElementById('select-beast-contacto-empresa-alert').innerHTML = 'Seleccione una empresa.';
    document.getElementById('select-beast-contacto-empresa').setAttribute('class', 'form-control is-invalid');

    document.getElementById('uf_hora').value = formatoDineroShow(quitarFormatoDinero(document.getElementById('uf_hora').value));

    if (document.getElementById('opcion_programa').checked) {
        habilitarPrograma();
    }

    if (document.getElementById('opcion_curso').checked) {
        habilitarCurso();
    }

    if (document.getElementById('experiencia-ads-si')) {
        experienciaAdsSi();
    } else {
        experienciaAdsNo();
    }
});
