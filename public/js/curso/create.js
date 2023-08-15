$(document).ready(function () {

    $('#anio_creacion').mask('0000');

    $('#nombre_venta').change(function() {
        this.setAttribute('class','form-control');
    });

    $('#descripcion').change(function() {
        this.setAttribute('class','form-control');
    });

    $('#nombre_sence').change(function() {
        this.setAttribute('class','form-control');
    });

    $('#cant_horas_practicas').keyup(function() {
        var cantHoras = document.getElementById('cant_horas_practicas');
        var numeroCantHoras = cantHoras.value;
        cantHoras.value = formatoDecimalInput(numeroCantHoras);
    });

    $('#cant_horas_teoricas').keyup(function() {
        var cantHoras = document.getElementById('cant_horas_teoricas');
        var numeroCantHoras = cantHoras.value;
        cantHoras.value = formatoDecimalInput(numeroCantHoras);
    });

    $('#cant_participantes').keyup(function() {
        var cantParticipantes = document.getElementById('cant_participantes');
        var numeroCantParticipantes = cantParticipantes.value;
        cantParticipantes.value = formatoNumeroInput(numeroCantParticipantes);
    });

    function calcularTotalHoras() {
        var cantHorasPracticas = quitarFormatoDecimal(document.getElementById('cant_horas_practicas').value);
        var cantHorasTeoricas = quitarFormatoDecimal(document.getElementById('cant_horas_teoricas').value);
        if (cantHorasPracticas === '') {
            cantHorasPracticas = 0;
        }
        if (cantHorasTeoricas === '') {
            cantHorasTeoricas = 0;
        }
        var total = parseFloat(cantHorasPracticas) + parseFloat(cantHorasTeoricas);
        var totalValidacion = total.toFixed(0);
        document.getElementById('cant_horas').setAttribute('class','form-control');
        if (totalValidacion.toString().length >= 3) {
            document.getElementById('cant_horas').setAttribute('class','form-control is-invalid');
        }
        document.getElementById('cant_horas').value = formatoNumeroShow(total);
    }

    //Validar si se han ingresado las horas práticas
    $("#cant_horas_practicas").change(function() {
        calcularTotalHoras();
    });

    //Validar si se han ingresado las horas teóricas
    $("#cant_horas_teoricas").change(function() {
        calcularTotalHoras();
    });

    //Verificar si tiene SENCE
    $("#opcion_sence").change(function(){
        if(senceReadOnly){
            senceReadOnly=false;
        }else{
            senceReadOnly=true;
        }
        document.getElementById("nombre_sence").readOnly = senceReadOnly;
        document.getElementById("codigo_sence").readOnly = senceReadOnly;
        document.getElementById("vigencia").readOnly = senceReadOnly;
        window.document.getElementById('nombre_sence').setAttribute('class', 'form-control ');
        window.document.getElementById('codigo_sence').setAttribute('class', 'form-control ');
        window.document.getElementById('vigencia').setAttribute('class', 'form-control ');
        document.getElementById('nombre_sence').value="";
        document.getElementById('codigo_sence').value="";
        document.getElementById('vigencia').value="";
    });

    window.validarMaxDosDigitos = function(id) {
        var total = quitarFormatoNumero(document.getElementById(id).value);
        if (total.length >= 3) {
            document.getElementById(id + '-alert').innerText = 'Se debe ingresar un número con menos de 3 dígitos.';
            document.getElementById(id).setAttribute('class','form-control is-invalid');
            return false;
        }
        document.getElementById(id).setAttribute('class','form-control');
        return true;
    }

    window.validarMaxDosDigitosDecimal = function(id) {
        var total = quitarFormatoDecimal(document.getElementById(id).value);
        if (total === '') {
            total = 0;
        }
        var total = parseFloat(total);
        total = total.toFixed(0);
        if (total.toString().length >= 3) {
            document.getElementById(id + '-alert').innerText = 'Se debe ingresar un número con menos de 3 dígitos.';
            document.getElementById(id).setAttribute('class','form-control is-invalid');
            return false;
        }
        document.getElementById(id).setAttribute('class','form-control');
        return true;
    }

    function validarDatos() {
        var valido = true;
        if(!validarNoNulo(document.getElementById('nombre_venta').value,'nombre_venta')){
            valido = false;
        }
        if(!validarNoNulo(document.getElementById('cant_horas').value,'cant_horas')){
            valido = false;
        }else{
            if (!validarMaxDosDigitosDecimal('cant_horas')) {
                valido = false;
            }
        }
        if(!validarNoNulo(document.getElementById('cant_horas_practicas').value,'cant_horas_practicas')){
            valido = false;
        }else{
            if (!validarMaxDosDigitosDecimal('cant_horas_practicas')) {
                valido = false;
            }
        }
        if(!validarNoNulo(document.getElementById('cant_horas_teoricas').value,'cant_horas_teoricas')){
            valido = false;
        }else{
            if (!validarMaxDosDigitosDecimal('cant_horas_teoricas')) {
                valido = false;
            }
        }
        if(!validarNoNulo(document.getElementById('cant_participantes').value,'cant_participantes')){
            valido = false;
        }else{
            if (!validarMaxDosDigitos('cant_participantes')) {
                valido = false;
            }
        }
        if(!validarNoNulo(document.getElementById('anio_creacion').value,'anio_creacion')){
            valido = false;
        }else{
            if(!validarAnioPasado(document.getElementById('anio_creacion').value,'anio_creacion')){
                valido = false;
            }
        }
        if(!validarNoNulo(document.getElementById('descripcion').value, 'descripcion')){
            valido = false;
        }
        //Validar que el select_beast no sea nulo
        if(!validarNoNulo(document.getElementById('select_beast_tematicas').value, 'select_beast_tematicas')) {
            valido = false;
        }
        //Ver si tiene SENCE
        if(!senceReadOnly){
            if(!validarNoNulo(document.getElementById('nombre_sence').value,'nombre_sence')){
                valido = false;
            }
            if(!validarNoNulo(document.getElementById('codigo_sence').value,'codigo_sence')){
                valido = false;
            } else {
                if(!validarNumero(document.getElementById('codigo_sence').value,'codigo_sence')){
                    valido = false;
                }
            }
            if(!validarNoNulo(document.getElementById('vigencia').value, 'vigencia')) {
                valido = false;
            }else{
                if(!validarFechaNoPasada(document.getElementById('vigencia').value, 'vigencia')) {
                    valido = false;
                }
            }
        }
        return valido;
    }

    /**
     * Envia los datos del curso
     */
    window.enviarDatos = function() {
        // Validaciones de los datos
        if(!validarDatos()){
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos del curso están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        var senceSiNo= !senceReadOnly;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/curso/store",
            data:
                {
                nombre_venta: $('#nombre_venta').val(),
                anio_creacion: $('#anio_creacion').val(),
                tematica: selectizeControl.getValue(),
                cant_horas: quitarFormatoDecimal($('#cant_horas').val()),
                cant_horas_practicas: quitarFormatoDecimal($('#cant_horas_practicas').val()),
                cant_horas_teoricas: quitarFormatoDecimal($('#cant_horas_teoricas').val()),
                cant_participantes: quitarFormatoNumero($('#cant_participantes').val()),
                descripcion: $('#descripcion').val(),
                nombre_sence: $('#nombre_sence').val(),
                codigo_sence: $('#codigo_sence').val(),
                vigencia: $('#vigencia').val(),
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/curso/");
                //enviarArchivo(result);
            },
            error: function(xhr) {
                var error = '';
                // console.log('ajax error');
                // console.log(xhr);
                if (!(typeof xhr.responseJSON.errors.codigo === 'undefined')) {
                    error = xhr.responseJSON.errors.codigo[0];
                    if (!(typeof xhr.responseJSON.errors.nombre_venta === 'undefined')) {
                        error = error + "<br>" + xhr.responseJSON.errors.nombre_venta[0];
                    }
                    if (!(typeof xhr.responseJSON.errors.nombre_sence === 'undefined')) {
                        error = error + "<br>" + xhr.responseJSON.errors.nombre_sence[0];
                    }
                    if (!(typeof xhr.responseJSON.errors.codigo_sence === 'undefined')) {
                        error = error + "<br>" + xhr.responseJSON.errors.codigo_sence[0];
                    }
                }else{
                    if (!(typeof xhr.responseJSON.errors.nombre_venta === 'undefined')) {
                        error = xhr.responseJSON.errors.nombre_venta[0];
                        if (!(typeof xhr.responseJSON.errors.nombre_sence === 'undefined')) {
                            error = error + "<br>" + xhr.responseJSON.errors.nombre_sence[0];
                        }
                        if (!(typeof xhr.responseJSON.errors.codigo_sence === 'undefined')) {
                            error = error + "<br>" + xhr.responseJSON.errors.codigo_sence[0];
                        }
                    }else{
                        if (!(typeof xhr.responseJSON.errors.nombre_sence === 'undefined')) {
                            error = xhr.responseJSON.errors.nombre_sence[0];
                            if (!(typeof xhr.responseJSON.errors.codigo_sence === 'undefined')) {
                                error = error + "<br>" + xhr.responseJSON.errors.codigo_sence[0];
                            }
                        }else{
                            if (!(typeof xhr.responseJSON.errors.codigo_sence === 'undefined')) {
                                error =xhr.responseJSON.errors.codigo_sence[0];
                            }
                        }

                    }
                }
                window.document.getElementById('error_bd').setAttribute('class', 'alert alert-danger');
                document.getElementById('error_bd').innerHTML = error;
                document.getElementById('error_bd').style.visibility = "visible";
                document.getElementById('error_bd_contorno').style.visibility = "visible";
            }
        });
    };

    // Arreglo con los datos
    var data = $('#data-tag').data('data');
    // Convertir arreglo a string
    var dataJson = JSON.stringify(data);
    var select = $('#select_beast_tematicas').selectize({
        create: false,
        searchField: 'nombre',
        options: JSON.parse(dataJson),
        valueField: 'id',
        labelField: 'nombre',
        onChange: function() {
            document.getElementById('select_beast_tematicas').setAttribute('class','form-control');
        }
    });
    var selectizeControl = select[0].selectize;
    //tiene sence
    var senceReadOnly = true;
    document.getElementById('opcion_sence').checked = false;
    document.getElementById('nombre_sence').value = '';
    document.getElementById('codigo_sence').value = '';
    document.getElementById('vigencia').value = '';
    // var cant = 0;
    // document.getElementById('cant_horas').value = cant;
});