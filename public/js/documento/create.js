$(document).ready(function () {

    $('#nombre').change(function() {
        this.setAttribute('class','form-control');
    })

    //file type validation
    $("#custom_file_archivo").change(function () {
        var file = this.files[0];
        if (file == null) {
            $(this).siblings(".custom-file-label").html("Seleccionar archivo...");
        } else {
            var imagefile = file.type;
            var fileSize= file.size;
            var match = ["application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/vnd.ms-excel","application/vnd.ms-powerpoint",
                "application/vnd.openxmlformats-officedocument.presentationml.presentation","application/msword","image/png","image/jpeg",
                "image/jpg"];
            if (!(((imagefile == match[0])||(imagefile == match[1])||(imagefile == match[2])||(imagefile == match[3])||(imagefile == match[4])
                ||(imagefile == match[5])||(imagefile == match[6])||(imagefile == match[7])||(imagefile == match[8])||(imagefile == match[9]))&&fileSize<=31457280)) {
                    window.document.getElementById('custom_file_archivo-alert').innerText = 'Se debe seleccionar un archivo de tipo doc, docx, xls, xlsx, ppt, pptx, png, jpeg, jpg o pdf de tamaño máximo 30 mb.';
                    window.document.getElementById('custom_file_archivo').setAttribute('class', 'custom-file-input is-invalid');
                $(this).siblings(".custom-file-label").html("Seleccionar archivo...");
                $("#custom_file_archivo").val('');
            } else {
                //Colocar el nombre del archivo seleccionado
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                window.document.getElementById('custom_file_archivo').setAttribute('class', 'custom-file-input');
            }
        }
    });

    function validarDatos() {
        var valido = true;
        if(!validarNoNulo(document.getElementById('nombre').value,'nombre')){
            valido = false;
        }
        //Validar que el select_beast no sea nulo
        if(!validarNoNulo(document.getElementById('select_beast_tematicas').value, 'select_beast_tematicas')) {
            valido = false;
        }
        //Validar que el select_beast no sea nulo
        if(!validarNoNulo(document.getElementById('select_beast_tipos').value, 'select_beast_tipos')) {
            valido = false;
        }
        //Validar que el custom_file no sea nulo
        if (!validarNoNulo(document.getElementById('custom_file_archivo').value, 'custom_file_archivo')) {
            valido = false;
        }
        return valido;
    }

    /**
     * Envia los datos del documento
     */
    window.enviarDatos = function() {
        // Validaciones de los datos
        if(!validarDatos()){
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos del documento están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/documento/store",
            data:
                {
                    nombre: $('#nombre').val(),
                    tipo: selectizeControlTipos.getValue(),
                    tematica: selectizeControlTematicas.getValue(),
                },
            success: function(result) {
                console.log('ajax ok');
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

    // Arreglo con los datos
    var data = $('#data-tag-tematicas').data('data');
    // Convertir arreglo a string
    var dataJson = JSON.stringify(data);
    var selectTematica = $('#select_beast_tematicas').selectize({
        create: false,
        searchField: 'nombre',
        options: JSON.parse(dataJson),
        valueField: 'id',
        labelField: 'nombre',
        onChange: function() {
            document.getElementById('select_beast_tematicas').setAttribute('class','form-control');
        }
    });
    var selectizeControlTematicas = selectTematica[0].selectize;

    // Arreglo con los datos
    var data2 = $('#data-tag-tipos').data('data');
    // Convertir arreglo a string
    var data2Json = JSON.stringify(data2);
    var selectTipo = $('#select_beast_tipos').selectize({
        create: false,
        searchField: 'nombre',
        options: JSON.parse(data2Json),
        valueField: 'id',
        labelField: 'nombre',
        onChange: function() {
            document.getElementById('select_beast_tipos').setAttribute('class','form-control');
        }
    });
    var selectizeControlTipos = selectTipo[0].selectize;
});