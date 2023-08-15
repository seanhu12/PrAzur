$(document).ready(function () {

    /**
     * Valida que se hayan seleccionado e ingresado los datos para los campos que estan activos
     */
    function validarFinalizar() {
        mensaje = document.getElementById('validacion-finalizar');
        mensajeTexto = document.getElementById('validacion-finalizar-mensaje');
        mensaje.hidden = true;
        if (relator === '') {
            mensajeTexto.innerText = 'Se debe seleccionar al relator.';
            mensaje.hidden = false;
            return true;
        }
        if (estructura === '') {
            mensajeTexto.innerText = 'Se debe seleccionar la estructura del curso.';
            mensaje.hidden = false;
            return true;
        }
        if (document.getElementById('aplica-manual').checked) {
            if (jQuery.isEmptyObject(manuales)) {
                mensajeTexto.innerText = 'Se debe seleccionar un manual.';
                mensaje.hidden = false;
                return true;
            }
        }
        if (document.getElementById('aplica-prueba').checked) {
            if (jQuery.isEmptyObject(pruebas)) {
                mensajeTexto.innerText = 'Se debe seleccionar una prueba.';
                mensaje.hidden = false;
                return true;
            }
        }
        if (document.getElementById('aplica-guia').checked) {
            if (jQuery.isEmptyObject(guias)) {
                mensajeTexto.innerText = 'Se debe seleccionar una guia.';
                mensaje.hidden = false;
                return true;
            }
        }
        if (encuestaAds === '') {
            mensajeTexto.innerText = 'Se debe seleccionar la encuesta ADS.';
            mensaje.hidden = false;
            return true;
        }
        if (document.getElementById('aplica-encuesta-empresa').checked) {
            if (jQuery.isEmptyObject(encuestasEmpresa)) {
                mensajeTexto.innerText = 'Se debe seleccionar una encuesta empresa.';
                mensaje.hidden = false;
                return true;
            }
        }
        if (document.getElementById('aplica-encuesta-adicional').checked) {
            if (jQuery.isEmptyObject(encuestasAdicionales)) {
                mensajeTexto.innerText = 'Se debe seleccionar una encuesta adicional.';
                mensaje.hidden = false;
                return true;
            }
        }
    }

    /**
     * Envia los datos para guardarlos en la bd
     */
    window.finalizar = function() {
        // Validar finalizar disenio tecnico
        if(validarFinalizar()) {
            return;
        }
        // Confirmacion de datos
        var respuesta = confirm("¿Está seguro que desea finalizar el diseño técnico del servicio?");
        if(respuesta == false){
            return;
        }
        guardar();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/finalizar_disenio_tecnico",
            data: {
                id: $('#servicio-id').data('data')
            },
            success: function(result) {
                // console.log('ajax finalizar ok');
                window.location.replace("/servicio");
            },
            error: function(xhr) {
                // console.log('ajax finalizar error');
            }
        });
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
     * Envia los datos para guardarlos en la bd
     */
    function guardar() {
        // Verificar que los objetos no esten vacios
        hayManuales = true;
        if (jQuery.isEmptyObject(manuales)){
            hayManuales = false;
        }
        hayPruebas = true;
        if (jQuery.isEmptyObject(pruebas)){
            hayPruebas = false;
        }
        hayGuias = true;
        if (jQuery.isEmptyObject(guias)){
            hayGuias = false;
        }
        hayEncuestasEmpresa = true;
        if (jQuery.isEmptyObject(encuestasEmpresa)){
            hayEncuestasEmpresa = false;
        }
        hayEncuestasAdicionales = true;
        if (jQuery.isEmptyObject(encuestasAdicionales)){
            hayEncuestasAdicionales = false;
        }
        // Mostrar indicador que se estan guardando los datos
        document.getElementById('guardando').hidden = false;
        document.getElementById('error-guardar').hidden = true;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/guardar_disenio_tecnico",
            data: {
                id: $('#servicio-id').data('data'),
                aplicaManuales: reemplazarTrueFalse(document.getElementById('aplica-manual').checked),
                aplicaPruebas: reemplazarTrueFalse(document.getElementById('aplica-prueba').checked),
                aplicaGuias: reemplazarTrueFalse(document.getElementById('aplica-guia').checked),
                aplicaEncuestasEmpresa: reemplazarTrueFalse(document.getElementById('aplica-encuesta-empresa').checked),
                aplicaEncuestasAdicionales: reemplazarTrueFalse(document.getElementById('aplica-encuesta-adicional').checked),
                relator: relator,
                estructura: estructura,
                hayManuales: hayManuales,
                manuales: manuales,
                hayPruebas: hayPruebas,
                pruebas: pruebas,
                hayGuias: hayGuias,
                guias: guias,
                encuestaAds: encuestaAds,
                hayEncuestasEmpresa: hayEncuestasEmpresa,
                encuestasEmpresa: encuestasEmpresa,
                hayEncuestasAdicionales: hayEncuestasAdicionales,
                encuestasAdicionales: encuestasAdicionales,
                detalles: document.getElementById('detalles').value
            },
            success: function(result) {
                // console.log('ajax ok');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('guardando').hidden = true;
                // window.location.replace("/home");
            },
            error: function(xhr) {
                // console.log('ajax error');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('guardando').hidden = true;
                document.getElementById('error-guardar').hidden = false;
            }
        });
    }

    $('#detalles').change( function() {
        guardar()
    });

    (function($) {
        $.fn.goTo = function() {
            $('html, body').animate({
                scrollTop: $(this).offset().top - 10 + 'px'
            }, 'fast');
            return this; // for chaining...
        }
    })(jQuery);

    /**
     * Muestra el modal de la informacion servicio
     */
    window.mostrarInformacionServicio = function() {
        $('#modal-informacion-servicio').modal('toggle');
    }

    /**
     * Muestra el modal de la informacion de la propuesta
     */
    window.mostrarInformacionPropuesta = function() {
        $('#modal-informacion-propuesta').modal('toggle');
    }

    /**
     * Cargar relator en la tabla resumen
     *
     * @param {Object} datoCargar
     * @param {string} idTabla
     */
    function cargarResumenRelator(relatorCargar, idTabla) {
        // Obtener la tabla
        var tabla = document.getElementById(idTabla);
        // Crear la nueva fila
        var row = tabla.insertRow(tabla.rows.length);
        // Crear las celdas
        var cellNombre = row.insertCell(0);
        var cellAcciones = row.insertCell(1);
        // Asignar los valores a las celdas
        cellNombre.innerHTML = relatorCargar.nombre + ' ' + relatorCargar.apellido;
        cellAcciones.setAttribute('class','text-right');
        cellAcciones.innerHTML = '<a href="/relator/show/' + relatorCargar.id + '" class="btn btn-pill btn-teal btn-sm"><i class="fas fa-info-circle"></i></a>';
    }

    /**
     * Cargar estructura en la tabla resumen
     *
     * @param {Object} estructuraCargar
     * @param {string} idTabla
     */
    function cargarEstructuraResumen(estructuraCargar, idTabla) {
        // Obtener la tabla
        var tabla = document.getElementById(idTabla);
        // Crear la nueva fila
        var row = tabla.insertRow(tabla.rows.length);
        // Crear las celdas
        var cellCodigo = row.insertCell(0);
        var cellNombre = row.insertCell(1);
        var cellAcciones = row.insertCell(2);
        // Asignar los valores a las celdas
        cellCodigo.innerHTML = estructuraCargar.codigo;
        cellNombre.innerHTML = estructuraCargar.nombre;
        cellAcciones.setAttribute('class','text-right');
        cellAcciones.innerHTML = '<a class="btn btn-pill btn-teal btn-sm" href="/estructura/download/' + estructuraCargar.id + '" title="Descargar"><i class="fas fa-file-download"></i></a>';
    }

    /**
     * Cargar dato en la tabla resumen
     *
     * @param {Object} datoCargar
     * @param {string} idTabla
     */
    function cargarDatoResumen(datoCargar, idTabla) {
        // Obtener la tabla
        var tabla = document.getElementById(idTabla);
        // Crear la nueva fila
        var row = tabla.insertRow(tabla.rows.length);
        // Crear las celdas
        var cellCodigo = row.insertCell(0);
        var cellNombre = row.insertCell(1);
        var cellAcciones = row.insertCell(2);
        // Asignar los valores a las celdas
        cellCodigo.innerHTML = datoCargar.codigo;
        cellNombre.innerHTML = datoCargar.nombre;
        cellAcciones.setAttribute('class','text-right');
        cellAcciones.innerHTML = '<a class="btn btn-pill btn-teal btn-sm" href="/documento/download/' + datoCargar.id + '" title="Descargar"><i class="fas fa-file-download"></i></a>';
    }

    /**
     * Muestra el modal del resumen
     */
    window.mostrarResumen = function() {
        // Vaciar las tablas
        document.getElementById('tabla-relator').innerHTML = '';
        document.getElementById('tabla-estructura').innerHTML = '';
        document.getElementById('tabla-manual').innerHTML = '';
        document.getElementById('tabla-prueba').innerHTML = '';
        document.getElementById('tabla-guia').innerHTML = '';
        document.getElementById('tabla-encuesta-ads').innerHTML = '';
        document.getElementById('tabla-encuesta-empresa').innerHTML = '';
        document.getElementById('tabla-encuesta-adicional').innerHTML = '';
        // Cargar las tablas
        if (relator !== '') {
            cargarResumenRelator(selectizeControlRelator.options[relator],'tabla-relator');
        }
        if (estructura !== '') {
            cargarEstructuraResumen(selectizeControlEstructura.options[estructura],'tabla-estructura');
        }
        for (var manual in manuales) {
            if (manual !== '') {
                cargarDatoResumen(selectizeControlManual.options[manual],'tabla-manual');
            }
        }
        for (var prueba in pruebas) {
            if (prueba !== '') {
                cargarDatoResumen(selectizeControlPrueba.options[prueba],'tabla-prueba');
            }
        }
        for (var guia in guias) {
            if (guia !== '') {
                cargarDatoResumen(selectizeControlGuia.options[guia],'tabla-guia');
            }
        }
        if (encuestaAds !== '') {
            cargarDatoResumen(selectizeControlEncuestasAds.options[encuestaAds],'tabla-encuesta-ads');
        }
        for (var encuestaEmpresa in encuestasEmpresa) {
            if (encuestaEmpresa !== '') {
                cargarDatoResumen(selectizeControlEncuestasEmpresa.options[encuestaEmpresa],'tabla-encuesta-empresa');
            }
        }
        for (var encuestaAdicional in encuestasAdicionales) {
            if (encuestaAdicional !== '') {
                cargarDatoResumen(selectizeControlEncuestasAdicionales.options[encuestaAdicional],'tabla-encuesta-adicional');
            }
        }
        $('#modal-resumen').modal('toggle');
    }

    function limpiarSeccionIngresos() {
        document.getElementById('elegir-relator').hidden = true;
        document.getElementById('elegir-estructura').hidden = true;
        document.getElementById('elegir-manual').hidden = true;
        document.getElementById('elegir-prueba').hidden = true;
        document.getElementById('elegir-guia').hidden = true;
        document.getElementById('elegir-encuesta-ads').hidden = true;
        document.getElementById('elegir-encuesta-empresa').hidden = true;
        document.getElementById('elegir-encuesta-adicional').hidden = true;
        document.getElementById('ingresado').innerHTML = '';
        selectizeControlRelator.clear();
        selectizeControlEstructura.clear();
        selectizeControlManual.clear();
        selectizeControlPrueba.clear();
        selectizeControlGuia.clear();
        selectizeControlEncuestasAds.clear();
        selectizeControlEncuestasEmpresa.clear();
        selectizeControlEncuestasAdicionales.clear();
    }

    /**
     * Mostrar el ingresar relator
     */
    $('#btn-relator').click(function(){
        limpiarSeccionIngresos();
        if (relator !== '') {
            cargarRelator(selectizeControlRelator.options[relator]);
        }
        document.getElementById('elegir-relator').hidden = false;
        $('#elegir-relator').goTo();
    });

    /**
     * Mostrar el ingresar estructura
     */
    $('#btn-estructura').click(function(){
        limpiarSeccionIngresos();
        if (estructura !== '') {
            cargarEstructura(selectizeControlEstructura.options[estructura]);
        }
        document.getElementById('elegir-estructura').hidden = false;
        $('#elegir-estructura').goTo();
    });

    /**
     * Mostrar el ingresar manual
     */
    $('#btn-manual').click(function(){
        limpiarSeccionIngresos();
        for (var manual in manuales) {
            if (manual !== '') {
                cargarManual(selectizeControlManual.options[manual]);
            }
        }
        document.getElementById('elegir-manual').hidden = false;
        $('#elegir-manual').goTo();
    });

    /**
     * Mostrar el ingresar prueba
     */
    $('#btn-prueba').click(function(){
        limpiarSeccionIngresos();
        for (var prueba in pruebas) {
            if (prueba !== '') {
                cargarPrueba(selectizeControlPrueba.options[prueba]);
            }
        }
        document.getElementById('elegir-prueba').hidden = false;
        $('#elegir-prueba').goTo();
    });

    /**
     * Mostrar el ingresar guia
     */
    $('#btn-guia').click(function(){
        limpiarSeccionIngresos();
        for (var guia in guias) {
            if (guia !== '') {
                cargarGuia(selectizeControlGuia.options[guia]);
            }
        }
        document.getElementById('elegir-guia').hidden = false;
        $('#elegir-guia').goTo();
    });

    /**
     * Mostrar el ingresar enucesta ads
     */
    $('#btn-encuesta-ads').click(function(){
        limpiarSeccionIngresos();
        if (encuestaAds !== '') {
            cargarEncuestaAds(selectizeControlEncuestasAds.options[encuestaAds]);
        }
        document.getElementById('elegir-encuesta-ads').hidden = false;
        $('#elegir-encuesta-ads').goTo();
    });

    /**
     * Mostrar el ingresar encuesta empresa
     */
    $('#btn-encuesta-empresa').click(function(){
        limpiarSeccionIngresos();
        for (var encuestaEmpresa in encuestasEmpresa) {
            if (encuestaEmpresa !== '') {
                cargarEncuestaEmpresa(selectizeControlEncuestasEmpresa.options[encuestaEmpresa]);
            }
        }
        document.getElementById('elegir-encuesta-empresa').hidden = false;
        $('#elegir-encuesta-empresa').goTo();
    });

    /**
     * Mostrar el ingresar encuesta adicional
     */
    $('#btn-encuesta-adicional').click(function(){
        limpiarSeccionIngresos();
        for (var encuestaAdicional in encuestasAdicionales) {
            if (encuestaAdicional !== '') {
                cargarEncuestaAdicional(selectizeControlEncuestasAdicionales.options[encuestaAdicional]);
            }
        }
        document.getElementById('elegir-encuesta-adicional').hidden = false;
        $('#elegir-encuesta-adicional').goTo();
    });

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
     * Remover relator
     */
    window.removerRelator = function (id) {
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que quiere eliminar el servicio?");
        // if(respuesta==false){
        //     return;
        // }
        var tabla = document.getElementById('ingresado');
        tabla.deleteRow(buscarColumnaTabla('ingresado', id));
        relator = '';
        guardar();
    }

    /**
     * Cargar el relator en la tabla
     *
     * @param {Object} relatorCargar
     */
    function cargarRelator(relatorCargar) {
        // Obtener la tabla
        var tabla = document.getElementById('ingresado');
        // Verificar que solo se ingrese un relator
        if (tabla.rows.length >= 1) {
            return false;
        }
        // Crear la nueva fila
        var row = tabla.insertRow(tabla.rows.length);
        // Crear las celdas
        var cellNombre = row.insertCell(0);
        // var cellApellido = row.insertCell(1);
        // var cellMail = row.insertCell(2);
        var cellAcciones = row.insertCell(1);
        // Asignar los valores a las celdas
        cellNombre.innerHTML = relatorCargar.nombre + ' ' + relatorCargar.apellido;
        // cellApellido.innerHTML = relator.apellido;
        // cellMail.innerHTML = relator.mail;
        cellAcciones.setAttribute('class','text-right');
        cellAcciones.innerHTML = '<a href="/relator/show/' + relatorCargar.id + '" class="btn btn-pill btn-teal btn-sm"><i class="fas fa-info-circle"></i></a> <button onClick="removerRelator(' + relatorCargar.id + ');" class="btn btn-pill btn-indigo btn-sm"><i class="fas fa-trash-alt"></i></button>';
        return true;
    }

    /**
     * Agregar relator
     */
    $('#btn-agregar-relator').click(function(){
        if (selectizeControlRelator.items.length == 0) {
            return;
        }
        // var ingresado = document.getElementById('ingresado');
        var relatorSeleccionado = selectizeControlRelator.options[selectizeControlRelator.items[0]];
        if (!cargarRelator(relatorSeleccionado)) {
            return;
        }
        relator = relatorSeleccionado.id;
        guardar();
        selectizeControlRelator.clear();
    });

    /**
     * Remover estructura
     */
    window.removerEstructura = function (id) {
        var tabla = document.getElementById('ingresado');
        tabla.deleteRow(buscarColumnaTabla('ingresado', id));
        estructura = '';
        guardar();
    }

    /**
     * Cargar la estructura en la tabla
     *
     * @param {Object} estructuraCargar
     */
    function cargarEstructura(estructuraCargar) {
        // Obtener la tabla
        var tabla = document.getElementById('ingresado');
        // Verificar que solo se ingrese una estructura
        if (tabla.rows.length >= 1) {
            return false;
        }
        // Crear la nueva fila
        var row = tabla.insertRow(tabla.rows.length);
        // Crear las celdas
        var cellCodigo = row.insertCell(0);
        var cellNombre = row.insertCell(1);
        var cellAcciones = row.insertCell(2);
        // Asignar los valores a las celdas
        cellCodigo.innerHTML = estructuraCargar.codigo;
        cellNombre.innerHTML = estructuraCargar.nombre;
        cellAcciones.setAttribute('class','text-right');
        cellAcciones.innerHTML = '<a class="btn btn-pill btn-teal btn-sm" href="/estructura/download/' + estructuraCargar.id + '" title="Descargar"><i class="fas fa-file-download"></i></a> <button onClick="removerEstructura(' + estructuraCargar.id + ');" class="btn btn-pill btn-indigo btn-sm"><i class="fas fa-trash-alt"></i></button>';
        return true;
    }

    /**
     * Agregar estructura
     */
    $('#btn-agregar-estructura').click(function(){
        if (selectizeControlEstructura.items.length == 0) {
            return;
        }
        // var ingresado = document.getElementById('ingresado');
        var estructuraSeleccionada = selectizeControlEstructura.options[selectizeControlEstructura.items[0]];
        if (!cargarEstructura(estructuraSeleccionada)) {
            return;
        }
        estructura = estructuraSeleccionada.id;
        guardar();
        selectizeControlEstructura.clear();
    });

    /**
     * Remover manual
     */
    window.removerManual = function (id) {
        var tabla = document.getElementById('ingresado');
        tabla.deleteRow(buscarColumnaTabla('ingresado', id));
        delete manuales[id];
        guardar();
    }

    /**
     * Cargar el manual en la tabla
     *
     * @param {Object} manualCargar
     */
    function cargarManual(manualCargar) {
        // Obtener la tabla
        var tabla = document.getElementById('ingresado');
        // Crear la nueva fila
        var row = tabla.insertRow(tabla.rows.length);
        // Crear las celdas
        var cellCodigo = row.insertCell(0);
        var cellNombre = row.insertCell(1);
        var cellAcciones = row.insertCell(2);
        // Asignar los valores a las celdas
        cellCodigo.innerHTML = manualCargar.codigo;
        cellNombre.innerHTML = manualCargar.nombre;
        cellAcciones.setAttribute('class','text-right');
        cellAcciones.innerHTML = '<a class="btn btn-pill btn-teal btn-sm" href="/documento/download/' + manualCargar.id + '" title="Descargar"><i class="fas fa-file-download"></i></a> <button onClick="removerManual(' + manualCargar.id + ');" class="btn btn-pill btn-indigo btn-sm"><i class="fas fa-trash-alt"></i></button>';
    }

    /**
     * Agregar manual
     */
    $('#btn-agregar-manual').click(function(){
        if (selectizeControlManual.items.length == 0) {
            return;
        }
        var manualSeleccionado = selectizeControlManual.options[selectizeControlManual.items[0]];
        // Verificar que no el manual no este ingresado
        var yaIngresado = false;
        for (var manual in manuales) {
            if (manual === manualSeleccionado.id) {
                yaIngresado = true;
            }
        }
        if (yaIngresado) {
            return;
        }
        cargarManual(manualSeleccionado);
        manuales[manualSeleccionado.id] = manualSeleccionado.id;
        guardar();
        selectizeControlManual.clear();
    });

    /**
     * Remover prueba
     */
    window.removerPrueba = function (id) {
        var tabla = document.getElementById('ingresado');
        tabla.deleteRow(buscarColumnaTabla('ingresado', id));
        delete pruebas[id];
        guardar();
    }

    /**
     * Cargar la prueba en la tabla
     *
     * @param {Object} pruebaCargar
     */
    function cargarPrueba(pruebaCargar) {
        // Obtener la tabla
        var tabla = document.getElementById('ingresado');
        // Crear la nueva fila
        var row = tabla.insertRow(tabla.rows.length);
        // Crear las celdas
        var cellCodigo = row.insertCell(0);
        var cellNombre = row.insertCell(1);
        var cellAcciones = row.insertCell(2);
        // Asignar los valores a las celdas
        cellCodigo.innerHTML = pruebaCargar.codigo;
        cellNombre.innerHTML = pruebaCargar.nombre;
        cellAcciones.setAttribute('class','text-right');
        cellAcciones.innerHTML = '<a class="btn btn-pill btn-teal btn-sm" href="/documento/download/' + pruebaCargar.id + '" title="Descargar"><i class="fas fa-file-download"></i></a> <button onClick="removerPrueba(' + pruebaCargar.id + ');" class="btn btn-pill btn-indigo btn-sm"><i class="fas fa-trash-alt"></i></button>';
    }

    /**
     * Agregar prueba
     */
    $('#btn-agregar-prueba').click(function(){
        if (selectizeControlPrueba.items.length == 0) {
            return;
        }
        var pruebaSeleccionado = selectizeControlPrueba.options[selectizeControlPrueba.items[0]];
        // Verificar que no la prueba no este ingresada
        var yaIngresado = false;
        for (var prueba in pruebas) {
            if (prueba === pruebaSeleccionado.id) {
                yaIngresado = true;
            }
        }
        if (yaIngresado) {
            return;
        }
        cargarPrueba(pruebaSeleccionado);
        pruebas[pruebaSeleccionado.id] = pruebaSeleccionado.id;
        guardar();
        selectizeControlPrueba.clear();
    });

    /**
     * Remover guia
     */
    window.removerGuia = function (id) {
        var tabla = document.getElementById('ingresado');
        tabla.deleteRow(buscarColumnaTabla('ingresado', id));
        delete guias[id];
        guardar();
    }

    /**
     * Cargar la guia en la tabla
     *
     * @param {Object} guiaCargar
     */
    function cargarGuia(guiaCargar) {
        // Obtener la tabla
        var tabla = document.getElementById('ingresado');
        // Crear la nueva fila
        var row = tabla.insertRow(tabla.rows.length);
        // Crear las celdas
        var cellCodigo = row.insertCell(0);
        var cellNombre = row.insertCell(1);
        var cellAcciones = row.insertCell(2);
        // Asignar los valores a las celdas
        cellCodigo.innerHTML = guiaCargar.codigo;
        cellNombre.innerHTML = guiaCargar.nombre;
        cellAcciones.setAttribute('class','text-right');
        cellAcciones.innerHTML = '<a class="btn btn-pill btn-teal btn-sm" href="/documento/download/' + guiaCargar.id + '" title="Descargar"><i class="fas fa-file-download"></i></a> <button onClick="removerGuia(' + guiaCargar.id + ');" class="btn btn-pill btn-indigo btn-sm"><i class="fas fa-trash-alt"></i></button>';
    }

    /**
     * Agregar guia
     */
    $('#btn-agregar-guia').click(function(){
        if (selectizeControlGuia.items.length == 0) {
            return;
        }
        var guiaSeleccionado = selectizeControlGuia.options[selectizeControlGuia.items[0]];
        // Verificar que la guia no este ingresada
        var yaIngresado = false;
        for (var guia in guias) {
            if (guia === guiaSeleccionado.id) {
                yaIngresado = true;
            }
        }
        if (yaIngresado) {
            return;
        }
        cargarGuia(guiaSeleccionado);
        guias[guiaSeleccionado.id] = guiaSeleccionado.id;
        guardar();
        selectizeControlGuia.clear();
    });

    /**
     * Remover encuesta ads
     */
    window.removerEncuestaAds = function (id) {
        var tabla = document.getElementById('ingresado');
        tabla.deleteRow(buscarColumnaTabla('ingresado', id));
        encuestaAds = '';
        guardar();
    }

    /**
     * Cargar la encuesta ads en la tabla
     *
     * @param {Object} encuestaAdsCargar
     */
    function cargarEncuestaAds(encuestaAdsCargar) {
        // Obtener la tabla
        var tabla = document.getElementById('ingresado');
        // Verificar que solo se ingrese una estructura
        if (tabla.rows.length >= 1) {
            return false;
        }
        // Crear la nueva fila
        var row = tabla.insertRow(tabla.rows.length);
        // Crear las celdas
        var cellCodigo = row.insertCell(0);
        var cellNombre = row.insertCell(1);
        var cellAcciones = row.insertCell(2);
        // Asignar los valores a las celdas
        cellCodigo.innerHTML = encuestaAdsCargar.codigo;
        cellNombre.innerHTML = encuestaAdsCargar.nombre;
        cellAcciones.setAttribute('class','text-right');
        cellAcciones.innerHTML = '<a class="btn btn-pill btn-teal btn-sm" href="/documento/download/' + encuestaAdsCargar.id + '" title="Descargar"><i class="fas fa-file-download"></i></a> <button onClick="removerEncuestaAds(' + encuestaAdsCargar.id + ');" class="btn btn-pill btn-indigo btn-sm"><i class="fas fa-trash-alt"></i></button>';
        return true;
    }

    /**
     * Agregar encuesta ads
     */
    $('#btn-agregar-encuesta-ads').click(function(){
        if (selectizeControlEncuestasAds.items.length == 0) {
            return;
        }
        var encuestaAdsSeleccionada = selectizeControlEncuestasAds.options[selectizeControlEncuestasAds.items[0]];
        if (!cargarEncuestaAds(encuestaAdsSeleccionada)) {
            return;
        }
        encuestaAds = encuestaAdsSeleccionada.id;
        guardar();
        selectizeControlEncuestasAds.clear();
    });

    /**
     * Remover encuesta empresa
     */
    window.removerEncuestaEmpresa = function (id) {
        var tabla = document.getElementById('ingresado');
        tabla.deleteRow(buscarColumnaTabla('ingresado', id));
        delete encuestasEmpresa[id];
        guardar();
    }

    /**
     * Cargar la encuesta empresa en la tabla
     *
     * @param {Object} encuestaEmpresaCargar
     */
    function cargarEncuestaEmpresa(encuestaEmpresaCargar) {
        // Obtener la tabla
        var tabla = document.getElementById('ingresado');
        // Crear la nueva fila
        var row = tabla.insertRow(tabla.rows.length);
        // Crear las celdas
        var cellCodigo = row.insertCell(0);
        var cellNombre = row.insertCell(1);
        var cellAcciones = row.insertCell(2);
        // Asignar los valores a las celdas
        cellCodigo.innerHTML = encuestaEmpresaCargar.codigo;
        cellNombre.innerHTML = encuestaEmpresaCargar.nombre;
        cellAcciones.setAttribute('class','text-right');
        cellAcciones.innerHTML = '<a class="btn btn-pill btn-teal btn-sm" href="/documento/download/' + encuestaEmpresaCargar.id + '" title="Descargar"><i class="fas fa-file-download"></i></a> <button onClick="removerEncuestaEmpresa(' + encuestaEmpresaCargar.id + ');" class="btn btn-pill btn-indigo btn-sm"><i class="fas fa-trash-alt"></i></button>';
    }

    /**
     * Agregar encuesta empresa
     */
    $('#btn-agregar-encuesta-empresa').click(function(){
        if (selectizeControlEncuestasEmpresa.items.length == 0) {
            return;
        }
        var encuestaEmpresaSeleccionado = selectizeControlEncuestasEmpresa.options[selectizeControlEncuestasEmpresa.items[0]];
        // Verificar que la encuesta empresa no este ingresada
        var yaIngresado = false;
        for (var encuestaEmpresa in encuestasEmpresa) {
            if (encuestaEmpresa === encuestaEmpresaSeleccionado.id) {
                yaIngresado = true;
            }
        }
        if (yaIngresado) {
            return;
        }
        cargarEncuestaEmpresa(encuestaEmpresaSeleccionado);
        encuestasEmpresa[encuestaEmpresaSeleccionado.id] = encuestaEmpresaSeleccionado.id;
        guardar();
        selectizeControlEncuestasEmpresa.clear();
    });

    /**
     * Remover encuesta adicional
     */
    window.removerEncuestaAdicional = function (id) {
        var tabla = document.getElementById('ingresado');
        tabla.deleteRow(buscarColumnaTabla('ingresado', id));
        delete encuestasAdicionales[id];
        guardar();
    }

    /**
     * Cargar la encuesta adicional en la tabla
     *
     * @param {Object} encuestaAdicionalCargar
     */
    function cargarEncuestaAdicional(encuestaAdicionalCargar) {
        // Obtener la tabla
        var tabla = document.getElementById('ingresado');
        // Crear la nueva fila
        var row = tabla.insertRow(tabla.rows.length);
        // Crear las celdas
        var cellCodigo = row.insertCell(0);
        var cellNombre = row.insertCell(1);
        var cellAcciones = row.insertCell(2);
        // Asignar los valores a las celdas
        cellCodigo.innerHTML = encuestaAdicionalCargar.codigo;
        cellNombre.innerHTML = encuestaAdicionalCargar.nombre;
        cellAcciones.setAttribute('class','text-right');
        cellAcciones.innerHTML = '<a class="btn btn-pill btn-teal btn-sm" href="/documento/download/' + encuestaAdicionalCargar.id + '" title="Descargar"><i class="fas fa-file-download"></i></a> <button onClick="removerEncuestaAdicional(' + encuestaAdicionalCargar.id + ');" class="btn btn-pill btn-indigo btn-sm"><i class="fas fa-trash-alt"></i></button>';
    }

    /**
     * Agregar encuesta adicional
     */
    $('#btn-agregar-encuesta-adicional').click(function(){
        if (selectizeControlEncuestasAdicionales.items.length == 0) {
            return;
        }
        var encuestaAdicionalSeleccionado = selectizeControlEncuestasAdicionales.options[selectizeControlEncuestasAdicionales.items[0]];
        // Verificar que la encuesta adicional no este ingresada
        var yaIngresado = false;
        for (var encuestaAdicional in encuestasAdicionales) {
            if (encuestaAdicional === encuestaAdicionalSeleccionado.id) {
                yaIngresado = true;
            }
        }
        if (yaIngresado) {
            return;
        }
        cargarEncuestaAdicional(encuestaAdicionalSeleccionado);
        encuestasAdicionales[encuestaAdicionalSeleccionado.id] = encuestaAdicionalSeleccionado.id;
        guardar();
        selectizeControlEncuestasAdicionales.clear();
    });

    $('#aplica-manual').change(function() {
        if (document.getElementById('aplica-manual').checked) {
            selectizeControlManual.enable();
            document.getElementById('btn-manual').disabled = false;
            document.getElementById('btn-agregar-manual').disabled = false;
            guardar();
        } else {
            // Confirmacion de datos
            var respuesta = confirm("¿Está seguro que desea deshabilitar los manuales? Si continua, se borrarán los agregados.");
            if(respuesta == false){
                document.getElementById('aplica-manual').checked = true;
                return;
            }
            selectizeControlManual.disable();
            selectizeControlManual.clear();
            document.getElementById('btn-manual').disabled = true;
            document.getElementById('btn-agregar-manual').disabled = true;
            manuales = {};
            if (!document.getElementById('elegir-manual').hidden) {
                document.getElementById('ingresado').innerHTML = '';
            }
            guardar();
        }
    });

    $('#aplica-prueba').change(function() {
        if (document.getElementById('aplica-prueba').checked) {
            selectizeControlPrueba.enable();
            document.getElementById('btn-prueba').disabled = false;
            document.getElementById('btn-agregar-prueba').disabled = false;
            guardar();
        } else {
            // Confirmacion de datos
            var respuesta = confirm("¿Está seguro que desea deshabilitar las pruebas? Si continua, se borrarán las agregadas.");
            if(respuesta == false){
                document.getElementById('aplica-prueba').checked = true;
                return;
            }
            selectizeControlPrueba.disable();
            selectizeControlPrueba.clear();
            document.getElementById('btn-prueba').disabled = true;
            document.getElementById('btn-agregar-prueba').disabled = true;
            pruebas = {};
            if (!document.getElementById('elegir-prueba').hidden) {
                document.getElementById('ingresado').innerHTML = '';
            }
            guardar();
        }
    });

    $('#aplica-guia').change(function() {
        if (document.getElementById('aplica-guia').checked) {
            selectizeControlGuia.enable();
            document.getElementById('btn-guia').disabled = false;
            document.getElementById('btn-agregar-guia').disabled = false;
            guardar();
        } else {
            // Confirmacion de datos
            var respuesta = confirm("¿Está seguro que desea deshabilitar las guias? Si continua, se borrarán las agregadas.");
            if(respuesta == false){
                document.getElementById('aplica-guia').checked = true;
                return;
            }
            selectizeControlGuia.disable();
            selectizeControlGuia.clear();
            document.getElementById('btn-guia').disabled = true;
            document.getElementById('btn-agregar-guia').disabled = true;
            guias = {};
            if (!document.getElementById('elegir-guia').hidden) {
                document.getElementById('ingresado').innerHTML = '';
            }
            guardar();
        }
    });

    $('#aplica-encuesta-empresa').change(function() {
        if (document.getElementById('aplica-encuesta-empresa').checked) {
            selectizeControlEncuestasEmpresa.enable();
            document.getElementById('btn-encuesta-empresa').disabled = false;
            document.getElementById('btn-agregar-encuesta-empresa').disabled = false;
            guardar();
        } else {
            // Confirmacion de datos
            var respuesta = confirm("¿Está seguro que desea deshabilitar las encuestas empresa? Si continua, se borrarán las agregadas.");
            if(respuesta == false){
                document.getElementById('aplica-encuesta-empresa').checked = true;
                return;
            }
            selectizeControlEncuestasEmpresa.disable();
            selectizeControlEncuestasEmpresa.clear();
            document.getElementById('btn-encuesta-empresa').disabled = true;
            document.getElementById('btn-agregar-encuesta-empresa').disabled = true;
            encuestasEmpresa = {};
            if (!document.getElementById('elegir-encuesta-empresa').hidden) {
                document.getElementById('ingresado').innerHTML = '';
            }
            guardar();
        }
    });

    $('#aplica-encuesta-adicional').change(function() {
        if (document.getElementById('aplica-encuesta-adicional').checked) {
            selectizeControlEncuestasAdicionales.enable();
            document.getElementById('btn-encuesta-adicional').disabled = false;
            document.getElementById('btn-agregar-encuesta-adicional').disabled = false;
            guardar();
        } else {
            // Confirmacion de datos
            var respuesta = confirm("¿Está seguro que desea deshabilitar las encuestas adicionales? Si continua, se borrarán las agregadas.");
            if(respuesta == false){
                document.getElementById('aplica-encuesta-adicional').checked = true;
                return;
            }
            selectizeControlEncuestasAdicionales.disable();
            selectizeControlEncuestasAdicionales.clear();
            document.getElementById('btn-encuesta-adicional').disabled = true;
            document.getElementById('btn-agregar-encuesta-adicional').disabled = true;
            encuestasAdicionales = {};
            if (!document.getElementById('elegir-encuesta-adicional').hidden) {
                document.getElementById('ingresado').innerHTML = '';
            }
            guardar();
        }
    });

    // Arreglo con los datos de los relatores
    var dataRelator = $('#data-tag-relator').data('data');
    // Convertir arreglo a string
    var dataRelatorJson = JSON.stringify(dataRelator);
    // Id del relator del servicio
    var dataRelatorServicio = "[" + $('#data-tag-relator-servicio').data('data') + "]";
    var selectRelator = $('#select-beast-relator').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataRelatorServicio),
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

    // Arreglo con los datos de las estructuras del curso
    var dataEstructuras = $('#data-tag-estructura').data('data');
    // Convertir arreglo a string
    var dataEstructurasJson = JSON.stringify(dataEstructuras);
    // Id del relator del servicio
    var dataEstructuraServicio = "[" + $('#data-tag-estructura-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectEstructura = $('#select-beast-estructura').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataEstructuraServicio),
        options: JSON.parse(dataEstructurasJson),
        valueField: 'id',
        labelField: 'codigo',
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            }
        }
    });
    var selectizeControlEstructura = selectEstructura[0].selectize;

    // Arreglo con los manuales
    var dataManuales = $('#data-tag-manual').data('data');
    // Convertir arreglo a string
    var dataManualesJson = JSON.stringify(dataManuales);
    // Id del relator del servicio
    var dataManualesServicio = "[" + $('#data-tag-manual-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectManual = $('#select-beast-manual').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataManualesServicio),
        options: JSON.parse(dataManualesJson),
        valueField: 'id',
        labelField: 'codigo',
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            }
        }
    });
    var selectizeControlManual = selectManual[0].selectize;

    // Arreglo con las pruebas
    var dataPruebas = $('#data-tag-prueba').data('data');
    // Convertir arreglo a string
    var dataPruebasJson = JSON.stringify(dataPruebas);
    // Id del relator del servicio
    var dataPruebasServicio = "[" + $('#data-tag-prueba-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectPrueba = $('#select-beast-prueba').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataPruebasServicio),
        options: JSON.parse(dataPruebasJson),
        valueField: 'id',
        labelField: 'codigo',
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            }
        }
    });
    var selectizeControlPrueba = selectPrueba[0].selectize;

    // Arreglo con las guias
    var dataGuias = $('#data-tag-guia').data('data');
    // Convertir arreglo a string
    var dataGuiasJson = JSON.stringify(dataGuias);
    // Id del relator del servicio
    var dataGuiasServicio = "[" + $('#data-tag-guia-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectGuia = $('#select-beast-guia').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataGuiasServicio),
        options: JSON.parse(dataGuiasJson),
        valueField: 'id',
        labelField: 'codigo',
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            }
        }
    });
    var selectizeControlGuia = selectGuia[0].selectize;

    // Arreglo con las encuestas adicionales
    var dataEncuestasAdicionales = $('#data-tag-encuesta-adicionales').data('data');
    // Convertir arreglo a string
    var dataEncuestasAdicionalesJson = JSON.stringify(dataEncuestasAdicionales);
    // Id del relator del servicio
    var dataEncuestasAdicionalesServicio = "[" + $('#data-tag-encuesta-adicionales-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectEncuestasAdicionales = $('#select-beast-encuesta-adicionales').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataEncuestasAdicionalesServicio),
        options: JSON.parse(dataEncuestasAdicionalesJson),
        valueField: 'id',
        labelField: 'codigo',
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            }
        }
    });
    var selectizeControlEncuestasAdicionales = selectEncuestasAdicionales[0].selectize;

    // Arreglo con las encuesta empresa
    var dataEncuestasEmpresa = $('#data-tag-encuesta-empresa').data('data');
    // Convertir arreglo a string
    var dataEncuestasEmpresaJson = JSON.stringify(dataEncuestasEmpresa);
    // Id del relator del servicio
    var dataEncuestasEmpresaServicio = "[" + $('#data-tag-encuesta-empresa-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectEncuestasEmpresa = $('#select-beast-encuesta-empresa').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataEncuestasEmpresaServicio),
        options: JSON.parse(dataEncuestasEmpresaJson),
        valueField: 'id',
        labelField: 'codigo',
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            }
        }
    });
    var selectizeControlEncuestasEmpresa = selectEncuestasEmpresa[0].selectize;

    // Arreglo con las encuesta ads
    var dataEncuestasAds = $('#data-tag-encuesta-ads').data('data');
    // Convertir arreglo a string
    var dataEncuestasAdsJson = JSON.stringify(dataEncuestasAds);
    // Id del relator del servicio
    var dataEncuestasAdsServicio = "[" + $('#data-tag-encuesta-ads-servicio').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectEncuestasAds = $('#select-beast-encuesta-ads').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataEncuestasAdsServicio),
        options: JSON.parse(dataEncuestasAdsJson),
        valueField: 'id',
        labelField: 'codigo',
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.codigo) + ' - '
                    + escape(item.nombre)
                    + '</div>';
            }
        }
    });
    var selectizeControlEncuestasAds = selectEncuestasAds[0].selectize;

    var disenioTecnico = $('#data-tag-disenio-tecnico').data('data');

    // Cambiar los valores de los checkbox
    // Verificar si desabilitar la fila
    if (disenioTecnico.manual_aplica === 1) {
        document.getElementById('aplica-manual').checked = true;
        selectizeControlManual.enable();
        document.getElementById('btn-manual').disabled = false;
        document.getElementById('btn-agregar-manual').disabled = false;
    } else {
        document.getElementById('aplica-manual').checked = false;
        selectizeControlManual.disable();
        document.getElementById('btn-manual').disabled = true;
        document.getElementById('btn-agregar-manual').disabled = true;
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.prueba_aplica === 1) {
        document.getElementById('aplica-prueba').checked = true;
        selectizeControlPrueba.enable();
        document.getElementById('btn-prueba').disabled = false;
        document.getElementById('btn-agregar-prueba').disabled = false;
    } else {
        document.getElementById('aplica-prueba').checked = false;
        selectizeControlPrueba.disable();
        document.getElementById('btn-prueba').disabled = true;
        document.getElementById('btn-agregar-prueba').disabled = true;
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.guia_aplica === 1) {
        document.getElementById('aplica-guia').checked = true;
        selectizeControlGuia.enable();
        document.getElementById('btn-guia').disabled = false;
        document.getElementById('btn-agregar-guia').disabled = false;
    } else {
        document.getElementById('aplica-guia').checked = false;
        selectizeControlGuia.disable();
        document.getElementById('btn-guia').disabled = true;
        document.getElementById('btn-agregar-guia').disabled = true;
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.encuesta_empresa_aplica === 1) {
        document.getElementById('aplica-encuesta-empresa').checked = true;
        selectizeControlEncuestasEmpresa.enable();
        document.getElementById('btn-encuesta-empresa').disabled = false;
        document.getElementById('btn-agregar-encuesta-empresa').disabled = false;
    } else {
        document.getElementById('aplica-encuesta-empresa').checked = false;
        selectizeControlEncuestasEmpresa.disable();
        document.getElementById('btn-encuesta-empresa').disabled = true;
        document.getElementById('btn-agregar-encuesta-empresa').disabled = true;
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.encuesta_adicionales_aplica === 1) {
        document.getElementById('aplica-encuesta-adicional').checked = true;
        selectizeControlEncuestasAdicionales.enable();
        document.getElementById('btn-encuesta-adicional').disabled = false;
        document.getElementById('btn-agregar-encuesta-adicional').disabled = false;
    } else {
        document.getElementById('aplica-encuesta-adicional').checked = false;
        selectizeControlEncuestasAdicionales.disable();
        document.getElementById('btn-encuesta-adicional').disabled = true;
        document.getElementById('btn-agregar-encuesta-adicional').disabled = true;
    }

    // Guardar los seleccionados
    var relator = dataRelatorServicio.replace('[','').replace(']','');
    var estructura = dataEstructuraServicio.replace('[','').replace(']','');
    var manuales = {};
    var pruebas = {};
    var guias = {};
    var encuestaAds = dataEncuestasAdsServicio.replace('[','').replace(']','');
    var encuestasEmpresa = {};
    var encuestasAdicionales = {};

    JSON.parse(dataManualesServicio).forEach(manual => {
        manuales[manual] = manual;
    });

    JSON.parse(dataPruebasServicio).forEach(prueba => {
        pruebas[prueba] = prueba;
    });

    JSON.parse(dataGuiasServicio).forEach(guia => {
        guias[guia] = guia;
    });

    JSON.parse(dataEncuestasEmpresaServicio).forEach(encuestaEmpresa => {
        encuestasEmpresa[encuestaEmpresa] = encuestaEmpresa;
    });

    JSON.parse(dataEncuestasAdicionalesServicio).forEach(encuestaAdicional => {
        encuestasAdicionales[encuestaAdicional] = encuestaAdicional;
    });

    var etapa = $('#etapa').data('data');

    // deshabiltiar disenio tecnico en etapa de cierre y cerrado
    if (etapa === 4 || etapa === 5 || etapa == 6) {
        document.getElementById('realizar-disenio-tecnico').hidden = true;
        document.getElementById('detalles').setAttribute('disabled','');
        document.getElementById('btn-finalizar').setAttribute('disabled','');
    }

    var estadoOperacional = $('#estado-operacional').data('data');

    // deshabiltiar disenio tecnico en estado operacional cancelado
    if (estadoOperacional === 5) {
        document.getElementById('realizar-disenio-tecnico').hidden = true;
        document.getElementById('detalles').setAttribute('disabled','');
        document.getElementById('btn-finalizar').setAttribute('disabled','');
    }
});