$(document).ready(function () {

    //file type validation
    $("#custom_file_archivo").change(function () {
        var file = this.files[0];
        if (file == null) {
            $(this).siblings(".custom-file-label").html("Seleccionar archivo...");
        } else {
            var imagefile = file.type;
            var fileSize= file.size;
            // console.log(fileSize);
            var match = ["application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/vnd.ms-excel","application/vnd.ms-powerpoint",
                "application/vnd.openxmlformats-officedocument.presentationml.presentation","application/msword","image/png","image/jpeg",
                "image/jpg"];
            if (!(((imagefile == match[0])||(imagefile == match[1])||(imagefile == match[2])||(imagefile == match[3])||(imagefile == match[4])
                ||(imagefile == match[5])||(imagefile == match[6])||(imagefile == match[7])||(imagefile == match[8])||(imagefile == match[9]))&&fileSize<=31457280)) {
                window.document.getElementById('custom_file_archivo').setAttribute('class', 'form-control is-invalid');
                $(this).siblings(".custom-file-label").html("Seleccionar archivo...");
                $("#custom_file_archivo").val('');
            } else {
                //Colocar el nombre del archivo seleccionado
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                window.document.getElementById('custom_file_archivo').setAttribute('class', 'form-control ');
            }
        }
    });

    /**
     * Envia los datos de la archivo del documento
     */
    window.enviarArchivo = function (id) {
        //Reiniciar campos válidos
        window.document.getElementById('custom_file_archivo').setAttribute('class', 'form-control ');

        // Validaciones de los datos
        var noValido = false;
        //Validar que el custom_file no sea nulo
        if (!validarNoNulo(document.getElementById('custom_file_archivo').value, 'custom_file_archivo')) {
            noValido = true;
        }
        if (noValido) {
            return;
        }
        var file = $('#custom_file_archivo').prop('files')[0];
        var data_form = new FormData;
        data_form.append('file', file);
        // Mostrar indicador que se estan guardando los datos
        document.getElementById('guardando-datos').hidden = false;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/documento/store_archivo/" + id,
            data: data_form,
            cache: false,
            contentType: false,
            dataType: 'text',
            processData: false,
            success: function (result) {
                // console.log('ajax ok');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('guardando-datos').hidden = true;
                window.location.replace("/documento/");
            },
            error: function (xhr) {
                // var error = '';
                // console.log('ajax error');
                // console.log(xhr);
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('guardando-datos').hidden = true;
                // window.document.getElementById('error_bd').setAttribute('class', 'alert alert-danger');
                // document.getElementById('error_bd').innerHTML = error;
                // document.getElementById('error_bd').style.visibility = "visible";
                // document.getElementById('error_bd_contorno').style.visibility = "visible";
            }
        });
    };
});