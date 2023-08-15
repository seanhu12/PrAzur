$(document).ready(function () {

    $('#telefono_fijo').mask('000 000 0000');

    $('#celular').mask('+000 0000 0000');

    $('#select-beast').change(function() {
        window.document.getElementById('select-beast').setAttribute('class', 'form-control');
    });

    $('#area').change(function() {
        window.document.getElementById('area').setAttribute('class', 'form-control');
    });

    $('#direccion').change(function() {
        window.document.getElementById('direccion').setAttribute('class', 'form-control');
    });

    // $('#celular').change(function() {
    //     window.document.getElementById('celular').setAttribute('class', 'form-control');
    //     window.document.getElementById('telefono_fijo').setAttribute('class', 'form-control');
    // });

    // $('#telefono_fijo').change(function() {
    //     window.document.getElementById('telefono_fijo').setAttribute('class', 'form-control');
    //     window.document.getElementById('celular').setAttribute('class', 'form-control');
    // });

    function validarDatos() {
        // Validaciones de los datos
        var valido = true;
        if(!validarNoNulo(document.getElementById('nombre').value,'nombre')){
            valido = false;
        } else {
            if(!validarNombre(document.getElementById('nombre').value,'nombre')){
                valido = false;
            }
        }
        if(!validarNoNulo(document.getElementById('apellido').value,'apellido')){
            valido = false;
        } else {
            if(!validarApellido(document.getElementById('apellido').value,'apellido')){
                valido = false;
            }
        }
        if(!validarNoNulo(document.getElementById('mail').value,'mail')){
            valido = false;
        } else {
            if(!validarEmail(document.getElementById('mail').value,'mail')){
                valido = false;
            }
        }
        if(!validarNoNulo(document.getElementById('direccion').value,'direccion')){
            valido = false;
        }
        if(!validarNoNulo(document.getElementById('area').value,'area')){
            valido = false;
        }
        //Validar que el select-beast no sea nulo
        if(!validarNoNulo(document.getElementById('select-beast').value, 'select-beast')) {
            valido = false;
        }
        //Verificar que uno de los telefonos no sea nulo
        if(!validarNoNulo(document.getElementById('celular').value,'celular') && !validarNoNulo(document.getElementById('telefono_fijo').value,'telefono_fijo')) {
            valido = false;
        } else {
            if(!validarNoNulo(document.getElementById('celular').value,'celular')){
                if(!validarTelefonoFijo(document.getElementById('telefono_fijo').value,'telefono_fijo')){
                    valido = false;
                }
            }else{
                if(!validarNoNulo(document.getElementById('telefono_fijo').value,'telefono_fijo')){
                    if(!validarCelular(document.getElementById('celular').value,'celular')) {
                        valido = false;
                    }
                }else{
                    if(!validarCelular(document.getElementById('celular').value,'celular')&&!validarTelefonoFijo(document.getElementById('telefono_fijo').value,'telefono_fijo')) {
                        valido = false;
                    }
                }
            }
        }
        return valido;
    }

    /**
     * Envia los datos del contacto OTIC
     */
    window.enviarDatos = function(id) {
        // Validaciones de los datos
        if(!validarDatos()){
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos del Contacto de la OTIC están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/contacto_otic/update/"+id,
            data: {
                nombre: $('#nombre').val(),
                apellido: $('#apellido').val(),
                mail: $('#mail').val(),
                direccion: $('#direccion').val(),
                otic: selectizeControl.getValue(),
                telefono_fijo: $('#telefono_fijo').val(),
                area: $('#area').val(),
                celular: $('#celular').val()
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/contacto_otic/show/"+id);
            },
            error: function(xhr) {
                var error = '';
                if (!(typeof xhr.responseJSON.errors.mail === 'undefined')) {
                    error = xhr.responseJSON.errors.mail[0];
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
    // Arreglo con los datos de la otic
    var dataOtic = '["'+$('#data-tag-otic').data('data')+'"]';
    var select = $('#select-beast').selectize({
        create: false,
        searchField: 'nombre',
        items:JSON.parse(dataOtic),
        options: JSON.parse(dataJson),
        valueField: 'id',
        labelField: 'nombre'
    });
    var selectizeControl = select[0].selectize;
});