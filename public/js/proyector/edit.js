$(document).ready(function () {
    //file type validation
    $("#custom_file_proyector").change(function () {
        var file = this.files[0];
        if (file == null) {
            $(this).siblings(".custom-file-label").html("Seleccionar archivo...");
        } else {
            var imagefile = file.type;
            var fileSize= file.size;
            // console.log(fileSize);
            var match = ["image/png","image/jpeg","image/jpg"];
            if (!(((imagefile == match[0])||(imagefile == match[1])||(imagefile == match[2]))&&fileSize<=5242880)) {
                window.document.getElementById('custom_file_proyector-alert').innerText = 'Se debe seleccionar un archivo de tipo png, jpeg o jpg de tamaño máximo 5 mb.';
                window.document.getElementById('custom_file_proyector').setAttribute('class', 'custom-file-input is-invalid');
                $(this).siblings(".custom-file-label").html("Seleccionar archivo...");
                $("#custom_file_proyector").val('');
            } else {
                //Colocar el nombre del archivo seleccionado
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                window.document.getElementById('custom_file_proyector').setAttribute('class', 'custom-file-input');
            }
        }
    });

    function validarDatos() {
        var valido = true;
        if(!validarNoNulo(document.getElementById('fecha_adquisicion').value,'fecha_adquisicion')){
            valido = false;
        }else{
            if(!validarFechaNoFutura(document.getElementById('fecha_adquisicion').value,'fecha_adquisicion')){
                valido = false;
            }
        }
        return valido;
    }

    /**
     * Envia los datos del proyector
     */
    window.actualizarDatos = function(id) {
        // Validaciones de los datos
        if(!validarDatos()){
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos del proyector están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/proyector/update/"+id,
            data: {
                fecha_adquisicion: $('#fecha_adquisicion').val()
            },
            success: function(result) {
                // console.log('ajax ok');
                //window.location.replace("/proyector");
                enviarArchivo(result);
            },
            error: function(xhr) {
                var error = '';
                if (!(typeof xhr.responseJSON.errors.codigo === 'undefined')) {
                    error = xhr.responseJSON.errors.codigo[0];
                }
                window.document.getElementById('error_bd').setAttribute('class', 'alert alert-danger');
                document.getElementById('error_bd').innerHTML = error;
                document.getElementById('error_bd').style.visibility = "visible";
                document.getElementById('error_bd_contorno').style.visibility = "visible";
            }
        });
    };
});