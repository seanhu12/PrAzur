$(document).ready(function () {

    $('#nombre').change(function() {
        this.setAttribute('class','form-control')
    });

    //file type validation
    $("#custom_file_estructura").change(function () {
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
                ||(imagefile == match[5])||(imagefile == match[6])||(imagefile == match[7])||(imagefile == match[8])||(imagefile == match[9]))&&fileSize<=5242880)) {
                window.document.getElementById('custom_file_estructura-alert').innerText = 'Se debe seleccionar un archivo de tipo doc, docx, xls, xlsx, ppt, pptx, png, jpeg, jpg o pdf de tamaño máximo 5 mb.';
                window.document.getElementById('custom_file_estructura').setAttribute('class', 'custom-file-input is-invalid');
                $(this).siblings(".custom-file-label").html("Seleccionar estructura...");
                $("#custom_file_estructura").val('');
            } else {
                //Colocar el nombre del archivo seleccionado
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                window.document.getElementById('custom_file_estructura').setAttribute('class', 'custom-file-input');
            }
        }
    });

    function validarDatos() {
        var valido = true;
        if(!validarNoNulo(document.getElementById('nombre').value,'nombre')){
            valido = false;
        }
        return valido;
    }

    /**
     * Envia los datos de la estructura
     */
    window.enviarDatos = function(id) {
        // Validaciones de los datos
        if(!validarDatos()){
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos de la estructura están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        //Si es el archvio es nulo, el controlador verá que hacer
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/estructura/update_estructura/"+id,
            data:
                {
                nombre: $('#nombre').val(),
            },
            success: function(result) {
                // console.log('ajax ok');
                enviarArchivo(result);
            },
            error: function(xhr) {
                var error = '';
                // console.log('ajax error');
                // console.log(xhr);
                if (!(typeof xhr.responseJSON.errors.codigo === 'undefined')) {
                    error = xhr.responseJSON.errors.codigo[0];
                    if (!(typeof xhr.responseJSON.errors.nombre === 'undefined')) {
                        error = error + "<br>" + xhr.responseJSON.errors.nombre[0];
                    }
                }else{
                    if (!(typeof xhr.responseJSON.errors.nombre === 'undefined')) {
                        error = xhr.responseJSON.errors.nombre[0];
                    }
                }
                window.document.getElementById('error_bd').setAttribute('class', 'alert alert-danger');
                document.getElementById('error_bd').innerHTML = error;
                document.getElementById('error_bd').style.visibility = "visible";
                document.getElementById('error_bd_contorno').style.visibility = "visible";
            }
        });
    };
});