$(document).ready(function () {

    $('#nombre').change(function() {
        document.getElementById('nombre').setAttribute('class','form-control');
    });

    window.validarMinimoCursos = function () {
        if(selectizeControl.items.length < 2){
            window.document.getElementById('input-tags-alert').innerText = 'Se deben seleccionar al menos dos cursos.';
            window.document.getElementById('input-tags').setAttribute('class', 'form-control is-invalid');
            return false;
        }else{
            window.document.getElementById('input-tags').setAttribute('class', 'form-control');
            return true;
        }
    };

    function validarDatos() {
        // Validaciones de los datos
        var valido = true;
        if(!validarNoNulo(document.getElementById('nombre').value,'nombre')){
            valido = false;
        }
        if(!validarNoNulo(selectizeControl.items.length,'input-tags')){
            valido = false;
        } else {
            if (!validarMinimoCursos()) {
                valido = false;
            }
        }
        return valido;
    }

    /**
     * Envia los datos del programa
     */
    window.enviarDatos = function(id) {
        if (!validarDatos()) {
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos del programa están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/programa/update/" + id,
            data: {
                nombre: $('#nombre').val(),
                cursos: selectizeControl.getValue()
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/programa");
            },
            error: function(xhr) {
                // console.log('ajax error')
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
    var dataCurso = $('#data-tag-curso').data('data');
    // Convertir arreglo con los datos del curso a string
    var dataCursoJson = JSON.stringify(dataCurso);
    // Crear elinput-tag (selectize)
    var select = $('#input-tags').selectize({
        persist: false,
        maxItems: null,
        items: JSON.parse(dataCursoJson),
        valueField: 'id',
        labelField: 'nombre_venta',
        searchField: 'nombre_venta',
        options: JSON.parse(dataJson),
        onChange: function() {
            validarMinimoCursos();
        }
    });
    var selectizeControl = select[0].selectize;
});