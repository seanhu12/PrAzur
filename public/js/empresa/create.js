$(document).ready(function () {

    $('#telefono_fijo').mask('000 000 0000');

    $('#celular').mask('+000 0000 0000');

    $('#nombre').change(function() {
        window.document.getElementById('nombre').setAttribute('class', 'form-control');
    });

    // Arreglo con los datos
    var data = $('#data-tag').data('data');
    // Convertir arreglo a string
    var dataJson = JSON.stringify(data);
    var select = $('#select-beast').selectize({
        create: false,
        searchField: 'nombre',
        options: JSON.parse(dataJson),
        valueField: 'id',
        labelField: 'nombre'
    });
    var selectizeControl = select[0].selectize;

    // Arreglo con los datos
    var dataEmpresa = $('#data-tag-empresas').data('data');
    // Convertir arreglo a string
    var dataEmpresaJson = JSON.stringify(dataEmpresa);

    //console.log(dataEmpresaJson);
    var selectEmpresa = $('#select-beast-empresas').selectize({
        create: false,
        searchField: 'nombre',
        options: JSON.parse(dataEmpresaJson),
        valueField: 'id',
        labelField: 'nombre'
    });
    var selectizeControlEmpresa = selectEmpresa[0].selectize;

    /**
     * Validar los datos
     */
    function validarDatos() {
        var valido = true;
        if(!validarNoNulo(document.getElementById('nombre').value,'nombre')){
            valido = false;
        }
        if(!validarEmail(document.getElementById('mail').value,'mail')){
            valido = false;
        }
        if(!validarNoNulo(document.getElementById('rut').value,'rut')){
            valido = false;
        } else {
            if(!validarRut(document.getElementById('rut').value)){
                valido = false;
            }
        }
        if(!validarTelefonoFijo(document.getElementById('telefono_fijo').value,'telefono_fijo')){
            valido = false;
        }
        if(!validarCelular(document.getElementById('celular').value,'celular')){
            valido = false;
        }
        return valido;
    }

    /**
     * Envia los datos de la empresa
     */
    window.enviarDatos = function() {
        // Validaciones de los datos
        if(!validarDatos()){
            return;
        }
        // // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos de la empresa están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/empresa/store",
            data: {
                rut: $('#rut').val(),
                nombre: $('#nombre').val(),
                mail: $('#mail').val(),
                direccion: $('#direccion').val(),
                ciudad: selectizeControl.getValue(),
                holding: selectizeControlEmpresa.getValue(),
                telefono_fijo: $('#telefono_fijo').val(),
                celular: $('#celular').val()
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/empresa/");
            },
            error: function(xhr) {
                var error = '';
                // console.log('ajax error');
                // console.log(xhr);
                if (!(typeof xhr.responseJSON.errors.rut === 'undefined')) {
                    error =xhr.responseJSON.errors.rut[0];
                }else{
                    if (!(typeof xhr.responseJSON.errors.mail === 'undefined')) {
                        error = error+ xhr.responseJSON.errors.mail[0];
                    }
                }
                document.getElementById('error_bd').innerHTML = error;
                document.getElementById('error_bd_contorno').hidden = false;
            }
        });
    };
});