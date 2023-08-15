$(document).ready(function () {

    $('#horario-ejecucion').mask('00:00 a 00:00');

    $('#id-accion').keyup(function() {
        var idAccion = document.getElementById('id-accion');
        var numero = idAccion.value;
        idAccion.value = numeroInput(numero);
    });

    $('#fecha-ejecucion').change(function() {
        guardarDatos();
    });

    $('#select-beast-ciudad').change(function() {
        guardarDatos();
    });

    $('#id-accion').change(function() {
        guardarDatos();
    });

    $('#horario-ejecucion').change(function() {
        guardarDatos();
    });

    $('#lugar').change(function() {
        guardarDatos();
    });

    /**
     * Muestra el modal de la informacion de la propuesta
     */
    window.mostrarInformacionPropuesta = function() {
        $('#modal-informacion-propuesta').modal('toggle');
    }

    /**
     * Valida que los datos ingresados cumplan con sus restricciones
     */
    function validarDatos() {
        var valido = true;
        if(!validarFechaNoPasada(document.getElementById('fecha-ejecucion').value,'fecha-ejecucion')){
            valido = false;
        }
        if(!validarHorario(document.getElementById('horario-ejecucion').value,'horario-ejecucion')){
            valido = false;
        }
        return valido;
    }

    /**
     * Envia los datos para guardarlos en la bd
     */
    function guardarDatos() {
        // Validar los datos
        document.getElementById('validacion-guardar-datos').hidden = true;
        document.getElementById('error-guardar-datos').hidden = true;
        if (!validarDatos()) {
            document.getElementById('validacion-guardar-datos').hidden = false;
            return;
        }
        // Mostrar indicador que se estan guardando los datos
        document.getElementById('guardando-datos').hidden = false;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/guardar_datos_checklist",
            data: {
                id: $('#servicio-id').data('data'),
                fecha_ejecucion: document.getElementById('fecha-ejecucion').value,
                ciudad_id: selectizeControlCiudad.items[0],
                id_accion: document.getElementById('id-accion').value,
                horario: document.getElementById('horario-ejecucion').value,
                lugar_realizacion: document.getElementById('lugar').value
            },
            success: function(result) {
                // console.log('ajax datos ok');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('guardando-datos').hidden = true;
            },
            error: function(xhr) {
                // console.log('ajax datos error');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('guardando-datos').hidden = true;
                document.getElementById('error-guardar-datos').hidden = false;
            }
        });
    }

    /**
     * Deshabilita los campos de ingreso de datos
     */
    window.deshabilitarDatos = function() {
        this.document.getElementById('fecha-ejecucion').setAttribute('readonly','');
        this.document.getElementById('id-accion').setAttribute('readonly','');
        this.document.getElementById('horario-ejecucion').setAttribute('readonly','');
        this.document.getElementById('lugar').setAttribute('readonly','');
        selectizeControlCiudad.disable();
    }

    // Arreglo con los datos de las ciudades
    var dataCiudad = $('#data-tag-ciudad').data('data');
    // Convertir arreglo a string
    var dataCiudadJson = JSON.stringify(dataCiudad);
    // Id de la ciudad del servicio
    var dataCiudadServicio = "[" + $('#data-tag-ciudad-servicio').data('data') + "]";
    var selectCiudad = $('#select-beast-ciudad').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataCiudadServicio),
        options: JSON.parse(dataCiudadJson),
        valueField: 'id',
        labelField: 'nombre'
    });
    var selectizeControlCiudad = selectCiudad[0].selectize;

});