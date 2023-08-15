$(document).ready(function () {

    /**
     * Muestra el modal de los contactos
     */
    window.mostrarContactos = function() {
        $('#modal-contactos').modal('toggle');
    }

    /**
     * Muestra el boton para guardar los cambios
     */
    window.mostrarGuardar = function() {
        document.getElementById('btn-guardar').hidden = false;
    }

    /**
     * Envia los nuevos contactos
     */
    window.enviarContactos = function(servicio) {
        // Confirmacion de datos
        var respuesta = confirm("¿Está seguro que los datos están correctos?");
        if(respuesta==false){
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/actualizar_contactos",
            data: {
                propuestaId: servicio.propuesta_id,
                contactoVentaId: selectizeControlContactoVenta.getValue(),
                contactoCoordinacionId: selectizeControlContactoCoordinacion.getValue(),
                contactoAdministracionId: selectizeControlContactoAdministracion.getValue(),
                contactoOticId: selectizeControlContactoOtic.getValue()
            },
            success: function(result) {
                // console.log('ajax ok');
                window.location.replace("/servicio/checklist/" + servicio.id);
            },
            error: function(xhr) {
                // console.log('ajax error');
            }
        });
    }

    /**
     * Deshabilita los campos de ingreso de datos
     */
    window.deshabiltiarContactos = function() {
        selectizeControlContactoAdministracion.disable();
        selectizeControlContactoCoordinacion.disable();
        selectizeControlContactoVenta.disable();
        selectizeControlContactoOtic.disable();
    }

    // Select contactos empresa
    // Arreglo con los datos
    var dataContactoEmpresa = $('#data-tag-contacto-empresa').data('data');
    // Convertir arreglo a string
    var dataContactoEmpresaJson = JSON.stringify(dataContactoEmpresa);

    // Contacto Venta de la propuesta
    var dataContactoVenta = "[" + $('#data-tag-contacto-venta').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectContactoVenta = $('#select-beast-contacto-venta').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataContactoVenta),
        options: JSON.parse(dataContactoEmpresaJson),
        valueField: 'id',
        labelField: 'nombre',
        onChange: function() {
            mostrarGuardar();
            document.getElementById('select-beast-contacto-venta').setAttribute('class', 'form-control');
        },
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.nombre) + ' '
                    + escape(item.apellido)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.nombre) + ' '
                    + escape(item.apellido)
                    + '</div>';
            }
        }
    });
    var selectizeControlContactoVenta = selectContactoVenta[0].selectize;

    // Contacto coordinacion de la propuesta
    var dataContactoCoordinacion = "[" + $('#data-tag-contacto-coordinacion').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectContactoCoordinacion = $('#select-beast-contacto-coordinacion').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataContactoCoordinacion),
        options: JSON.parse(dataContactoEmpresaJson),
        valueField: 'id',
        labelField: 'nombre',
        onChange: function() {
            mostrarGuardar();
            document.getElementById('select-beast-contacto-coordinacion').setAttribute('class', 'form-control');
        },
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.nombre) + ' '
                    + escape(item.apellido)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.nombre) + ' '
                    + escape(item.apellido)
                    + '</div>';
            }
        }
    });
    var selectizeControlContactoCoordinacion = selectContactoCoordinacion[0].selectize;

    // Contacto administracion de la propuesta
    var dataContactoAdministracion = "[" + $('#data-tag-contacto-administracion').data('data') + "]";
    // Crear el input-tag (selectize)
    var selectContactoAdministracion = $('#select-beast-contacto-administracion').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataContactoAdministracion),
        options: JSON.parse(dataContactoEmpresaJson),
        valueField: 'id',
        labelField: 'nombre',
        onChange: function() {
            mostrarGuardar();
            document.getElementById('select-beast-contacto-administracion').setAttribute('class', 'form-control');
        },
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.nombre) + ' '
                    + escape(item.apellido)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.nombre) + ' '
                    + escape(item.apellido)
                    + '</div>';
            }
        }
    });
    var selectizeControlContactoAdministracion = selectContactoAdministracion[0].selectize;

    // Select contactos otic
    // Arreglo con los datos
    var dataContactoOtic = $('#data-tag-contactos-otic').data('data');
    // Convertir arreglo a string
    var dataContactoOticJson = JSON.stringify(dataContactoOtic);

    // Contacto Venta de la propuesta
    var dataContactoOtic = "[" + $('#data-tag-contacto-otic').data('data') + "]";
    // Crear elinput-tag (selectize)
    var selectContactoOtic = $('#select-beast-contacto-otic').selectize({
        create: false,
        searchField: 'nombre',
        items: JSON.parse(dataContactoOtic),
        options: JSON.parse(dataContactoOticJson),
        valueField: 'id',
        labelField: 'nombre',
        onChange: function() {
            mostrarGuardar();
            document.getElementById('select-beast-contacto-otic').setAttribute('class', 'form-control');
        },
        render: {
            option: function(item, escape) {
                return '<div>'
                    + escape(item.nombre) + ' '
                    + escape(item.apellido)
                    + '</div>';
            },
            item: function(item, escape){
                return '<div>'
                    + escape(item.nombre) + ' '
                    + escape(item.apellido)
                    + '</div>';
            }
        }
    });
    var selectizeControlContactoOtic = selectContactoOtic[0].selectize;
});