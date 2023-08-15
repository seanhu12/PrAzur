$(document).ready(function () {

    /**
     * Validar que se tickearon todos los checkbox
     */
    function validarFinalizarLogistica() {
        // Coordinacion
        if (document.getElementById('logistica-aplica-sala').checked) {
            if (!document.getElementById('logistica-listo-sala').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-coffee').checked) {
            if (!document.getElementById('logistica-listo-coffee').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-almuerzo').checked) {
            if (!document.getElementById('logistica-listo-almuerzo').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-nomina-participantes').checked) {
            if (!document.getElementById('logistica-listo-nomina-participantes').checked) {
                return true;
            }
        }
        // Material participante
        if (document.getElementById('logistica-aplica-gafete').checked) {
            if (!document.getElementById('logistica-listo-gafete').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-bitacora').checked) {
            if (!document.getElementById('logistica-listo-bitacora').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-carpeta').checked) {
            if (!document.getElementById('logistica-listo-carpeta').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-velobind').checked) {
            if (!document.getElementById('logistica-listo-velobind').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-lapices').checked) {
            if (!document.getElementById('logistica-listo-lapices').checked) {
                return true;
            }
        }
        // Sence
        if (document.getElementById('logistica-aplica-sence-notebook').checked) {
            if (!document.getElementById('logistica-listo-sence-notebook').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-lector-biometrico').checked) {
            if (!document.getElementById('logistica-listo-lector-biometrico').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-reglamento-sence').checked) {
            if (!document.getElementById('logistica-listo-reglamento-sence').checked) {
                return true;
            }
        }
        // Material Relator
        if (document.getElementById('logistica-aplica-libro-asistencia').checked) {
            if (!document.getElementById('logistica-listo-libro-asistencia').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-pendon').checked) {
            if (!document.getElementById('logistica-listo-pendon').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-proyector').checked) {
            if (!document.getElementById('logistica-listo-proyector').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-notebook').checked) {
            if (!document.getElementById('logistica-listo-notebook').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-encuesta-ads').checked) {
            if (!document.getElementById('logistica-listo-encuesta-ads').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-encuesta-empresa').checked) {
            if (!document.getElementById('logistica-listo-encuesta-empresa').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-encuesta-adicionales').checked) {
            if (!document.getElementById('logistica-listo-encuesta-adicionales').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-guia').checked) {
            if (!document.getElementById('logistica-listo-guia').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-prueba').checked) {
            if (!document.getElementById('logistica-listo-prueba').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-plumones').checked) {
            if (!document.getElementById('logistica-listo-plumones').checked) {
                return true;
            }
        }
        // Outdoor
        if (document.getElementById('logistica-aplica-venda').checked) {
            if (!document.getElementById('logistica-listo-venda').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-pvc').checked) {
            if (!document.getElementById('logistica-listo-pvc').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-pelota').checked) {
            if (!document.getElementById('logistica-listo-pelota').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-plumon').checked) {
            if (!document.getElementById('logistica-listo-plumon').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-papel-kraft').checked) {
            if (!document.getElementById('logistica-listo-papel-kraft').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-pechera').checked) {
            if (!document.getElementById('logistica-listo-pechera').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-masking').checked) {
            if (!document.getElementById('logistica-listo-masking').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-bolsa-basura').checked) {
            if (!document.getElementById('logistica-listo-bolsa-basura').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-cono').checked) {
            if (!document.getElementById('logistica-listo-cono').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-plato').checked) {
            if (!document.getElementById('logistica-listo-plato').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-aro-madera').checked) {
            if (!document.getElementById('logistica-listo-aro-madera').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-tijera').checked) {
            if (!document.getElementById('logistica-listo-tijera').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-esqui').checked) {
            if (!document.getElementById('logistica-listo-esqui').checked) {
                return true;
            }
        }
        // Audio iluminacion
        if (document.getElementById('logistica-aplica-parlante').checked) {
            if (!document.getElementById('logistica-listo-parlante').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-atril').checked) {
            if (!document.getElementById('logistica-listo-atril').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-alargador').checked) {
            if (!document.getElementById('logistica-listo-alargador').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-foco').checked) {
            if (!document.getElementById('logistica-listo-foco').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-microfono-cintillo').checked) {
            if (!document.getElementById('logistica-listo-microfono-cintillo').checked) {
                return true;
            }
        }
        if (document.getElementById('logistica-aplica-microfono-inalambrico').checked) {
            if (!document.getElementById('logistica-listo-microfono-inalambrico').checked) {
                return true;
            }
        }
    }

    $('#btn-finalizar-logistica').click( function() {
        document.getElementById('validacion-finalizar-logistica').hidden = true;
        // Validar que se tickearon todos los checkbox
        if (validarFinalizarLogistica()) {
            document.getElementById('validacion-finalizar-logistica').hidden = false;
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/finalizar_logistica",
            data: {
                id: $('#servicio-id').data('data')
            },
            success: function(result) {
                // console.log('ajax finalizar logistica ok');
                document.getElementById('listo-logistica').checked = true;
                document.getElementById('etapa-text').innerText = 'Etapa: Preparado';
                ocultarLogistica();
            },
            error: function(xhr) {
                // console.log('ajax finalizar logistica error');
            }
        });
    });

    /**
     * Asignar 1 check, 0 no check
     */
    window.reemplazarTrueFalse = function(check) {
        if (check) {
            return '1';
        } else {
            return '0';
        }
    }

    /**
     * Asignar true check, false no check
     */
    window.reemplazarTrueFalseInverso = function(valor) {
        if (valor == '1') {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Deshabilita los campos de ingreso de datos
     */
    window.deshabilitarLogistica = function() {
        deshabilitarCoordinacion();
        deshabilitarMaterialRelator();
        deshabilitarMaterialParticipante();
        deshabilitarSence();
        deshabilitarOutdoor();
        deshabilitarAudioIluminacion();
        this.document.getElementById('finalizar-logistica').hidden = true;
    }

    if ($('#etapa').data('data') === 1) {
        document.getElementById('finalizar-logistica').hidden = true;
    }

});