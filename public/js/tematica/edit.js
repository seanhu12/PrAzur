$(document).ready(function () {

    $('#nombre').change(function() {
        this.setAttribute('class','form-control');
    });

    function validarDatos() {
        var valido = true;
        if(!validarNoNulo(document.getElementById('nombre').value,'nombre')){
            valido = false;
        }
        return valido;
    }

    /**
     * Envia los datos de la tematica
     */
    window.enviarDatos = function(id) {
        // Validaciones de los datos
        if(!validarDatos()){
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que el nombre de la temática está correcto?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/tematica/update/"+ id,
            data: {
                nombre: $('#nombre').val()
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/tematica/");
            },
            error: function(xhr) {
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
});