$(document).ready(function () {

    $('#nombre').change(function() {
        this.setAttribute('class','form-control')
    });

    //file type validation
    $("#custom_file_pendon").change(function () {
        var file = this.files[0];
        if (file == null) {
            $(this).siblings(".custom-file-label").html("Seleccionar archivo...");
        } else {
            var imagefile = file.type;
            var fileSize= file.size;
            // console.log(fileSize);
            var match = ["image/png","image/jpeg","image/jpg"];
            if (!(((imagefile == match[0])||(imagefile == match[1])||(imagefile == match[2]))&&fileSize<=5242880)) {
                window.document.getElementById('custom_file_pendon-alert').innerText = 'Se debe seleccionar un archivo de tipo png, jpeg o jpg de tamaño máximo 5 mb.';
                window.document.getElementById('custom_file_pendon').setAttribute('class', 'custom-file-input is-invalid');
                $(this).siblings(".custom-file-label").html("Seleccionar archivo...");
                $("#custom_file_pendon").val('');
            } else {
                //Colocar el nombre del archivo seleccionado
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                window.document.getElementById('custom_file_pendon').setAttribute('class', 'custom-file-input ');
            }
        }
    });

    function validatDatos() {
        var valido = true;
        if(!validarNoNulo(document.getElementById('nombre').value,'nombre')){
            valido = false;
        }
        if(!validarNoNulo(selectizeControl.items.length, 'input-tags')) {
            valido = false;
        }
        return valido;
    }

    /**
     * Envia los datos del pendon
     */
    window.enviarDatos = function(id) {
        // Validaciones de los datos
        if (!validatDatos()) {
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos del pendón están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/pendon/update/" + id,
            data: {
                nombre: $('#nombre').val(),
                tematicas: selectizeControl.getValue()
            },
            success: function(result) {
                // console.log('ajax ok');
                //window.location.replace("/pendon");
                enviarArchivo(result);
            },
            error: function(xhr) {
                // console.log(xhr)
                var error = '';
                if (!(typeof xhr.responseJSON.errors.nombre === 'undefined')) {
                    error = xhr.responseJSON.errors.nombre[0];
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
    // Arreglo con los datos del curso
    var dataTematica = $('#data-tag-tematica').data('data');
    // Convertir arreglo con los datos del curso a string
    var dataTematicaJson = JSON.stringify(dataTematica);
    // Crear elinput-tag (selectize)
    var select = $('#input-tags').selectize({
        persist: false,
        maxItems: null,
        items: JSON.parse(dataTematicaJson),
        valueField: 'id',
        labelField: 'nombre',
        options: JSON.parse(dataJson),
        onChange: function() {
            document.getElementById('input-tags').setAttribute('class', 'form-control');
        }
    });
    var selectizeControl = select[0].selectize;
});