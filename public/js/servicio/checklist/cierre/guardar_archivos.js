$(document).ready(function () {


    //file type validation
    function validarArchivo(tipoId) {
        var file = $('#archivo-' + tipoId).prop('files')[0];
        if (file != null) {
            window.document.getElementById('archivo-' + tipoId).setAttribute('class', 'custom-file-input');
            var imagefile = file.type;
            var fileSize= file.size;
            // console.log(fileSize);
            var match = ["application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/vnd.ms-excel","application/vnd.ms-powerpoint",
                "application/vnd.openxmlformats-officedocument.presentationml.presentation","application/msword","image/png","image/jpeg",
                "image/jpg"];
            if (!(((imagefile == match[0])||(imagefile == match[1])||(imagefile == match[2])||(imagefile == match[3])||(imagefile == match[4])
                ||(imagefile == match[5])||(imagefile == match[6])||(imagefile == match[7])||(imagefile == match[8])||(imagefile == match[9]))&&fileSize<=5242880)) {
                window.document.getElementById('archivo-' + tipoId).setAttribute('class', 'custom-file-input is-invalid');
                // $(this).siblings(".custom-file-label").html("Seleccionar archivos...");
                document.getElementById('archivo-' + tipoId + '-text').innerText = "Seleccionar archivos...";
                $("#custom-file-propuesta").val('');
                return false;
            }
            document.getElementById('archivo-' + tipoId + '-text').innerText = file.name;
            return true;
        }
        return false;
        // var file = this.files[0];
        // if (file == null) {
        //     $(this).siblings(".custom-file-label").html("Seleccionar archivo...");
        // } else {
        //     var imagefile = file.type;
        //     var match = ["application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        //         "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/vnd.ms-excel","application/vnd.ms-powerpoint",
        //         "application/vnd.openxmlformats-officedocument.presentationml.presentation","application/msword","image/png","image/jpeg",
        //         "image/jpg"];
        //     if (!((imagefile == match[0])||(imagefile == match[1])||(imagefile == match[2])||(imagefile == match[3])||(imagefile == match[4])
        //         ||(imagefile == match[5])||(imagefile == match[6])||(imagefile == match[7])||(imagefile == match[8])||(imagefile == match[9]))) {
        //         window.document.getElementById('archivo').setAttribute('class', 'form-control is-invalid');
        //         $(this).siblings(".custom-file-label").html("Seleccionar archivo...");
        //         $("#archivo").val('');
        //     } else {
        //         //Colocar el nombre del archivo seleccionado
        //         var fileName = $(this).val().split("\\").pop();
        //         // $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        //         document.getElementById('archivo1_text').innerText = fileName;
        //         // window.document.getElementById('archivo').setAttribute('class', 'form-control ');
        //     }
        // }
    }


    /**
     * Envia el archivo
     */
    window.enviarDatosArchivo = function(servicioId,tipoId) {
        //Reiniciar campos validos
        window.document.getElementById('archivo-' + tipoId).setAttribute('class', 'custom-file-input');
        // Validar que el archivo no sea nulo
        if (!validarArchivo(tipoId)) {
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/store_documento_checklist",
            data: {
                servicio: servicioId,
                tipo: tipoId
            },
            success: function(result) {
                // console.log('ajax ok');
                enviarArchivo(result,tipoId);
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };

    /**
     * Envia los datos de la archivo del documento
     */
    window.enviarArchivo = function (id,tipoId) {
        var file = $('#archivo-' + tipoId).prop('files')[0];
        var data_form = new FormData;
        data_form.append('file', file);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/store_archivo_checklist/" + id,
            data: data_form,
            cache: false,
            contentType: false,
            dataType: 'text',
            processData: false,
            success: function(result) {
                // console.log('ajax ok');
                location.reload();
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    };


    /**
     * Elimina un archivos
     */
    window.eliminarArchivo = function (id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/servicio/eliminar_archivo_otros',
            type: 'post',
            data: {
                idArchivo: id
            },
            success: function (result) {
                // console.log('eliminar archivos ok');
                location.reload();
            },
            error: function (xhr) {
                // console.log('eliminar archivos error');
            }
        });
    };
});