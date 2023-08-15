$(document).ready(function () {

    /**
     * Validar que se tickearon todos los checkbox
     */
    function validarFinalizarCierre() {
        // Cierre
        if (document.getElementById('cierre-aplica-libro-asistencia').checked) {
            if (!document.getElementById('cierre-listo-libro-asistencia').checked) {
                return true;
            }
        }
        if (document.getElementById('cierre-aplica-certificado-sence').checked) {
            if (!document.getElementById('cierre-listo-libro-asistencia').checked) {
                return true;
            }
        }
        if (document.getElementById('cierre-aplica-encuesta-ads').checked) {
            if (!document.getElementById('cierre-listo-encuesta-ads').checked) {
                return true;
            }
        }
        if (document.getElementById('cierre-aplica-notas').checked) {
            if (!document.getElementById('cierre-listo-notas').checked) {
                return true;
            }
        }
        if (document.getElementById('cierre-aplica-diploma').checked) {
            if (!document.getElementById('cierre-listo-diploma').checked) {
                return true;
            }
        }
        if (document.getElementById('cierre-aplica-oc').checked) {
            if (!document.getElementById('cierre-listo-oc').checked) {
                return true;
            }
        }
        // Sence
        if (document.getElementById('logistica-aplica-lector-biometrico').checked) {
            if (!document.getElementById('cierre-listo-lector-biometrico').checked) {
                return true;
            }
        }
        // Material Relator
        if (document.getElementById('logistica-aplica-pendon').checked) {
            if (!document.getElementById('cierre-listo-pendon').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-proyector').checked) {
            if (!document.getElementById('cierre-listo-proyector').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-notebook').checked) {
            if (!document.getElementById('cierre-listo-notebook').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-encuesta-empresa').checked) {
            if (!document.getElementById('cierre-listo-encuesta-empresa').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-encuesta-adicionales').checked) {
            if (!document.getElementById('cierre-listo-encuesta-adicionales').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-guia').checked) {
            if (!document.getElementById('cierre-listo-guia').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-prueba').checked) {
            if (!document.getElementById('cierre-listo-prueba').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-plumones').checked) {
            if (!document.getElementById('cierre-listo-plumones').checked) {
                return true;
            }
        }
        // Outdoor
        if (document.getElementById('logistica-aplica-venda').checked) {
            if (!document.getElementById('cierre-listo-venda').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-pvc').checked) {
            if (!document.getElementById('cierre-listo-pvc').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-pelota').checked) {
            if (!document.getElementById('cierre-listo-pelota').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-plumon').checked) {
            if (!document.getElementById('cierre-listo-plumon').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-papel-kraft').checked) {
            if (!document.getElementById('cierre-listo-papel-kraft').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-pechera').checked) {
            if (!document.getElementById('cierre-listo-pechera').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-masking').checked) {
            if (!document.getElementById('cierre-listo-masking').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-bolsa-basura').checked) {
            if (!document.getElementById('cierre-listo-bolsa-basura').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-cono').checked) {
            if (!document.getElementById('cierre-listo-cono').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-plato').checked) {
            if (!document.getElementById('cierre-listo-plato').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-aro-madera').checked) {
            if (!document.getElementById('cierre-listo-aro-madera').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-tijera').checked) {
            if (!document.getElementById('cierre-listo-tijera').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-esqui').checked) {
            if (!document.getElementById('cierre-listo-esqui').checked) {
                return true;
            }
        }
        // Audio iluminacion
        if (document.getElementById('logistica-aplica-parlante').checked) {
            if (!document.getElementById('cierre-listo-parlante').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-atril').checked) {
            if (!document.getElementById('cierre-listo-atril').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-alargador').checked) {
            if (!document.getElementById('cierre-listo-alargador').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-foco').checked) {
            if (!document.getElementById('cierre-listo-foco').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-microfono-cintillo').checked) {
            if (!document.getElementById('cierre-listo-microfono-cintillo').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-microfono-inalambrico').checked) {
            if (!document.getElementById('cierre-listo-microfono-inalambrico').checked) {
                return true;
            }
        }
    }

    $('#btn-finalizar-cierre').click( function() {
        document.getElementById('validacion-finalizar-cierre').hidden = true;
        // Validar que se tickearon todos los checkbox
        if (validarFinalizarCierre()) {
            document.getElementById('validacion-finalizar-cierre').hidden = false;
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/finalizar_cierre",
            data: {
                id: $('#servicio-id').data('data')
            },
            success: function(result) {
                // console.log('ajax finalizar cierre ok');
                document.getElementById('listo-cierre').checked = true;
                document.getElementById('etapa-text').innerText = 'Etapa: Cerrado';
                ocultarCierre();
                document.getElementById('btn-descargar-checklist').hidden = false;
                document.getElementById('btn-descargar-checklist-deshabilitado').hidden = true;
            },
            error: function(xhr) {
                // console.log('ajax finalizar cierre error');
            }
        });
    });


    /**
     * Deshabilita los campos de ingreso de datos
     */
    window.deshabilitarCierre = function() {
        deshabilitarCierreServicio();
        deshabilitarRecepcion();
        this.document.getElementById('finalizar-cierre').hidden = true;
    }
});