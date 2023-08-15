$(document).ready(function () {

    /**
     * Cambiar color table header
     */
    $('tr').each(function () {
        $(this).find('th').addClass('blue');
    })

    /**
     * Dynatable
     */
    var dynatable = $('#tabla')
        .dynatable({
            features: {
                paginate: false,
                recordCount: false,
                sorting: false
            }
        }).data('dynatable');

    var participantes = $('#participantes').data('data');
    var fecha = $('#fecha').data('fecha');

    /**
     * Envia los datos
     */
    window.enviarDatos = function(fondoSiNo) {
        //Reiniciar campos válidos
        window.document.getElementById('leyenda').setAttribute('class', 'form-control ');
        window.document.getElementById('nombre-curso').setAttribute('class', 'form-control ');

        // Validaciones de los datos
        var noValido= false;
        if(!validarNoNulo(document.getElementById('nombre-curso').value,'nombre-curso')){
            noValido=true;
        }
        if(noValido){
            return;
        }
        //Actualizar estado
        var estado="";
        var cantidadDiplomas=0;
        participantes.forEach(participante => {
            estado =  document.getElementById('estado-impresion-'+participante.rut).value;
            if(estado != "Reprobación"){
                cantidadDiplomas= cantidadDiplomas +1;
            }
            participante.estado= estado;
        });
        if(cantidadDiplomas==0){
            document.getElementById('mensaje-validacion').hidden=false;
            return;
        }else{
            document.getElementById('mensaje-validacion').hidden=true;
        }
        //Obtner nombre curso
        var e1 = document.getElementById("nombre-curso");
        var nombreCurso = e1.options[e1.selectedIndex].value;
        //Obtener tipo fondo
        var e2 = document.getElementById("tipo-fondo");
        var tipoFondo = e2.options[e2.selectedIndex].value;
        // Confirmacion de datos
        var respuesta = confirm("¿Está seguro que los datos del los diplomas están correctos?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/diploma_servicio_generar",
            data: {
                participantes: participantes,
                fecha: fecha,
                nombre_programa_curso: nombreCurso,
                tipo_fondo: tipoFondo,
                fondo_si_no: fondoSiNo,
                leyenda:$('#leyenda').val(),
            },
            success: function(result) {
                // console.log('ajax ok');
                var newWindow = window.open("","_blank");
                newWindow.location.href = "/servicio/abrir_diplomas";
                //window.location.replace("/servicio/abrir_diplomas");
            },
            error: function(xhr) {
                var error = '';
                // console.log(xhr);
                // if (!(typeof xhr.responseJSON.errors.mail === 'undefined')) {
                //     error = xhr.responseJSON.errors.mail[0];
                // }
                // window.document.getElementById('error_bd').setAttribute('class', 'alert alert-danger');
                // document.getElementById('error_bd').innerHTML = error;
                // document.getElementById('error_bd').style.visibility = "visible";
                // document.getElementById('error_bd_contorno').style.visibility = "visible";
            }
        });
    };
});