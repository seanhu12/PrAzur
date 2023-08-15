$(document).ready(function () {

    $('#celular').mask('+000 0000 0000');

    //file type validation
    $("#custom-file-archivo").change(function () {
        window.document.getElementById('custom-file-archivo').setAttribute('class', 'custom-file-input');
        // Valida que solo se seleccionen 10 archivos
        if (this.files.length > 10) {
            window.document.getElementById('custom-file-archivo-alert').innerText = 'Sólo se pueden subir hasta 10 archivos.';
            window.document.getElementById('custom-file-archivo').setAttribute('class', 'custom-file-input is-invalid');
            $("#custom-file-archivo").val('');
            return;
        }
        !//Validar tipos
        Array.from(this.files).forEach(file => {
            //var file = this.files[0];
            if (file != null) {
                var imagefile = file.type;
                var fileSize= file.size;
                var match = ["application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/vnd.ms-excel","application/vnd.ms-powerpoint",
                    "application/vnd.openxmlformats-officedocument.presentationml.presentation","application/msword","image/png","image/jpeg",
                    "image/jpg"];
                if (!(((imagefile == match[0])||(imagefile == match[1])||(imagefile == match[2])||(imagefile == match[3])||(imagefile == match[4])
                    ||(imagefile == match[5])||(imagefile == match[6])||(imagefile == match[7])||(imagefile == match[8])||(imagefile == match[9]))&&fileSize<=5242880)) {
                    window.document.getElementById('custom-file-archivo-alert').innerText = 'Se deben seleccionar archivos de tipo doc, docx, xls, xlsx, ppt, pptx, png, jpeg, jpg o pdf de tamaño máximo 5 mb cada uno.';
                    window.document.getElementById('custom-file-archivo').setAttribute('class', 'custom-file-input is-invalid');
                    $(this).siblings(".custom-file-label").html("Seleccionar archivos...");
                    $("#custom-file-archivo").val('');
                }
            }
        });
        // Hacer una tabla de html con los archivos
        // Recorrer los archivos para crear las filas de la tabla
        var archivosHtml = '';
        Array.from(this.files).forEach(file => {
            archivosHtml = archivosHtml + '<tr>' + '<td>' + file.name + '</td>' + '</tr>';
        });
        // Hacer la tabla agregando las filas
        var html = '<table>' + '<tbody>' + archivosHtml + '</tbody>' + '</table>';
        document.getElementById('archivos_relator').innerHTML = html;
    });

    function validarDatos() {
        var valido = true;
        if(!validarNoNulo(document.getElementById('nombre').value,'nombre')){
            valido = false;
        }else{
            if(!validarNombre(document.getElementById('nombre').value,'nombre')){
                valido = false;
            }
        }
        if(!validarNoNulo(document.getElementById('apellido').value,'apellido')){
            valido = false;
        }else{
            if(!validarNombre(document.getElementById('apellido').value,'apellido')){
                valido = false;
            }
        }
        // if(!validarNoNulo(document.getElementById('mail').value,'mail')){
        //     valido = false;
        // }else{
            if(!validarEmail(document.getElementById('mail').value,'mail')){
                valido = false;
            }
        // }
        if(!validarNoNulo(document.getElementById('rut').value,'rut')){
            valido = false;
        }else{
            if(!validarRut(document.getElementById('rut').value)){
                valido = false;
            }
        }
        // if(!validarNoNulo(document.getElementById('vigencia_sence').value,'vigencia_sence')){
        //     valido = false;
        // }else{
            if(!validarFechaNoPasada(document.getElementById('vigencia_sence').value,'vigencia_sence')){
                valido = false;
            }
        // }
        // if(!validarNoNulo(document.getElementById('celular').value,'celular')){
        //     valido = false;
        // }else{
            if(!validarCelular(document.getElementById('celular').value,'celular')){
                valido = false;
            }
        // }
        // if(!validarNoNulo(document.getElementById('select-beast').value,'select-beast')){
        //     valido = false;
        // }
        return valido;
    }

    /**
     * Envia los datos de la relator
     */
    window.enviarDatos = function() {
        // Validaciones de los datos
        if(!validarDatos()){
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos del relator están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/relator/store",
            data: {
                nombre: $('#nombre').val(),
                rut: $('#rut').val(),
                apellido: $('#apellido').val(),
                mail: $('#mail').val(),
                vigencia_sence: $('#vigencia_sence').val(),
                ciudad: selectizeControl.getValue(),
                celular: $('#celular').val()
            },
            success: function(result) {
                // console.log('ajax ok');
                enviarArchivo(result);
            },
            error: function(xhr) {
                var error = '';
                // console.log('ajax error');
                // console.log(xhr);
                var error = '';
                if (!(typeof xhr.responseJSON.errors.mail === 'undefined')) {
                    error = xhr.responseJSON.errors.mail[0];
                    if (!(typeof xhr.responseJSON.errors.rut === 'undefined')) {
                        error = error + "<br>" + xhr.responseJSON.errors.rut[0];
                    }
                }
                else {
                    if (!(typeof xhr.responseJSON.errors.rut === 'undefined')) {
                        error = xhr.responseJSON.errors.rut[0];
                    }
                }
                window.document.getElementById('error_bd').setAttribute('class', 'alert alert-danger');
                document.getElementById('error_bd').innerHTML = error;
                document.getElementById('error_bd').style.visibility = "visible";
                document.getElementById('error_bd_contorno').style.visibility = "visible";
            }
        });
    };

    /**
     * Envia los datos de los archivos del relator
     */
    window.enviarArchivo = function (id) {
        //Reiniciar campos válidos
        window.document.getElementById('custom-file-archivo').setAttribute('class', 'form-control ');

        // Validaciones de los datos
        var noValido = false;
        /*//Validar que el custom_file no sea nulo
        if (!validarNoNulo(document.getElementById('custom-file-archivo').value, 'custom-file-archivo')) {
            noValido = true;
        }
        if (noValido) {
            return;
        }*/
        var form_data = new FormData();
        var ins = document.getElementById('custom-file-archivo').files.length;
        // console.log(document.getElementById('custom-file-archivo').files);
        for (var x = 0; x < ins; x++) {
            form_data.append("files[]", document.getElementById('custom-file-archivo').files[x]);
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/relator/guardar_archivos/" + id,
            data: form_data,
            cache: false,
            contentType: false,
            dataType: 'text',
            processData: false,
            success: function (result) {
                // console.log('ajax ok');
                window.location.replace("/relator");
            },
            error: function (xhr) {
                var error = '';
                // console.log('ajax error');
                // console.log(xhr);
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
    var select = $('#select-beast').selectize({
        create: false,
        searchField: 'nombre',
        options: JSON.parse(dataJson),
        valueField: 'id',
        labelField: 'nombre',
        onChange: function() {
            document.getElementById('select-beast').setAttribute('class','form-control');
        }
    });
    var selectizeControl = select[0].selectize;
});