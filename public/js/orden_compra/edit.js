$(document).ready(function () {

    // Arreglo con los datos
    var dataEmpresa = $('#data-tag-empresas').data('data');
    // Convertir arreglo a string
    var dataEmpresaJson = JSON.stringify(dataEmpresa);
    // Arreglo con los datos de los servicios
    var dataEmpresa = '["'+$('#data-tag-empresa').data('data')+'"]';
    //console.log(dataEmpresaJson);
    var selectEmpresa = $('#select-beast-empresas').selectize({
        create: false,
        searchField: 'nombre',
        items:JSON.parse(dataEmpresa),
        options: JSON.parse(dataEmpresaJson),
        valueField: 'id',
        labelField: 'nombre',
        onChange: function() {
            document.getElementById('select-beast-empresas').setAttribute('class','form-control');
        }
    });
    var selectizeControlEmpresa = selectEmpresa[0].selectize;

    /**
     * Envia los datos de la orden de compra
     */
    window.enviarDatos = function(id,servicioId) {
        //Reiniciar campos válidos
        window.document.getElementById('numero').setAttribute('class', 'form-control ');
        window.document.getElementById('select-beast-empresas').setAttribute('class', 'form-control ');

        // Validaciones de los datos
        var noValido= false;
        if(!validarNoNulo(document.getElementById('numero').value,'numero')){
            noValido=true;
        }else{
            if(!validarNumero(document.getElementById('numero').value,'numero')){
                noValido=true;
            }
        }
        //Validar que el select-beast no sea nulo
        if(!validarNoNulo(document.getElementById('select-beast-empresas').value,'select-beast-empresas')){
            noValido=true;
        }
        if(noValido){
            return;
        }
        // Confirmacion de datos
        // var respuesta = confirm("¿Está seguro que los datos de la Orden De Compra están correctos?");
        // if(respuesta==false){
        //     return;
        // }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/orden_compra/update/" + id,
            data: {
                numero: $('#numero').val(),
                empresa: selectizeControlEmpresa.getValue(),
                servicio: servicioId,
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/orden_compra/"+result);
            },
            error: function(xhr) {
                var error = '';
                // console.log('ajax error');
                // console.log(xhr);
                if(xhr.responseJSON.responseText===undefined){
                    error= error + "Ya existe una Orden de Compra con este Número para este Servicio."
                }else {
                    if (!(typeof xhr.responseJSON.errors.numero === 'undefined')) {
                        error = xhr.responseJSON.errors.numero[0];
                        error = error.replace('numero', 'Número');
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