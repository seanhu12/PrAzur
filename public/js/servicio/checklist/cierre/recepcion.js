$(document).ready(function() {

    // Material Receptor

    /**
     * Habilitar proyector
     */
    window.habilitarProyectorCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-proyector').hidden = false;
    }

    /**
     * Deshabilitar proyector
     */
    window.deshabilitarProyectorCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-proyector').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-proyector').checked = false;
    }

    /**
     * Habilitar notebook
     */
    window.habilitarNotebookCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-notebook').hidden = false;
    }

    /**
     * Deshabilitar notebook
     */
    window.deshabilitarNotebookCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-notebook').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-notebook').checked = false;
    }

    /**
     * Habilitar encuesta empresa
     */
    window.habilitarEncuestaEmpresaCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-encuesta-empresa').hidden = false;
    }

    /**
     * Deshabilitar encuesta empresa
     */
    window.deshabilitarEncuestaEmpresaCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-encuesta-empresa').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-encuesta-empresa').checked = false;
    }

    /**
     * Habilitar encuesta adicionales
     */
    window.habilitarEncuestaAdicionalesCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-encuesta-adicionales').hidden = false;
    }

    /**
     * Deshabilitar encuesta adicionales
     */
    window.deshabilitarEncuestaAdicionalesCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-encuesta-adicionales').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-encuesta-adicionales').checked = false;
    }

    /**
     * Habilitar guia
     */
    window.habilitarGuiaCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-guia').hidden = false;
    }

    /**
     * Deshabilitar guia
     */
    window.deshabilitarGuiaCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-guia').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-guia').checked = false;
    }

    /**
     * Habilitar prueba
     */
    window.habilitarPruebaCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-prueba').hidden = false;
    }

    /**
     * Deshabilitar prueba
     */
    window.deshabilitarPruebaCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-prueba').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-prueba').checked = false;
    }

    /**
     * Habilitar plumones
     */
    window.habilitarPlumonesCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-plumones').hidden = false;
    }

    /**
     * Deshabilitar plumones
     */
    window.deshabilitarPlumonesCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-plumones').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-plumones').checked = false;
    }

    // Sence

    /**
     * Habilitar lector biometrico
     */
    window.habilitarLectorBiometricoCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-lector-biometrico').hidden = false;
    }

    /**
     * Deshabilitar lector biometrico
     */
    window.deshabilitarLectorBiometricoCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-lector-biometrico').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-lector-biometrico').checked = false;
    }

    // Outdoor

    /**
     * Habilitar venda
     */
    window.habilitarVendaCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-venda').hidden = false;
    }

    /**
     * Deshabilitar venda
     */
    window.deshabilitarVendaCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-venda').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-venda').checked = false;
    }

    /**
     * Habilitar pvc
     */
    window.habilitarPvcCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-pvc').hidden = false;
    }

    /**
     * Deshabilitar pvc
     */
    window.deshabilitarPvcCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-pvc').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-pvc').checked = false;
    }

    /**
     * Habilitar pelota
     */
    window.habilitarPelotaCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-pelota').hidden = false;
    }

    /**
     * Deshabilitar pelota
     */
    window.deshabilitarPelotaCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-pelota').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-pelota').checked = false;
    }

    /**
     * Habilitar plumon
     */
    window.habilitarPlumonCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-plumon').hidden = false;
    }

    /**
     * Deshabilitar plumon
     */
    window.deshabilitarPlumonCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-plumon').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-plumon').checked = false;
    }

    /**
     * Habilitar papel kraft
     */
    window.habilitarPapelKraftCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-papel-kraft').hidden = false;
    }

    /**
     * Deshabilitar papel kraft
     */
    window.deshabilitarPapelKraftCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-papel-kraft').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-papel-kraft').checked = false;
    }

    /**
     * Habilitar pechera
     */
    window.habilitarPecheraCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-pechera').hidden = false;
    }

    /**
     * Deshabilitar pechera
     */
    window.deshabilitarPecheraCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-pechera').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-pechera').checked = false;
    }

    /**
     * Habilitar masking
     */
    window.habilitarMaskingCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-masking').hidden = false;
    }

    /**
     * Deshabilitar masking
     */
    window.deshabilitarMaskingCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-masking').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-masking').checked = false;
    }

    /**
     * Habilitar bolsa basura
     */
    window.habilitarBolsaBasuraCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-bolsa-basura').hidden = false;
    }

    /**
     * Deshabilitar bolsa basura
     */
    window.deshabilitarBolsaBasuraCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-bolsa-basura').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-bolsa-basura').checked = false;
    }

    /**
     * Habilitar cono
     */
    window.habilitarConoCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-cono').hidden = false;
    }

    /**
     * Deshabilitar cono
     */
    window.deshabilitarConoCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-cono').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-cono').checked = false;
    }

    /**
     * Habilitar plato
     */
    window.habilitarPlatoCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-plato').hidden = false;
    }

    /**
     * Deshabilitar plato
     */
    window.deshabilitarPlatoCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-plato').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-plato').checked = false;
    }

    /**
     * Habilitar aro madera
     */
    window.habilitarAroMaderaCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-aro-madera').hidden = false;
    }

    /**
     * Deshabilitar aro madera
     */
    window.deshabilitarAroMaderaCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-aro-madera').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-aro-madera').checked = false;
    }

    /**
     * Habilitar tijera
     */
    window.habilitarTijeraCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-tijera').hidden = false;
    }

    /**
     * Deshabilitar tijera
     */
    window.deshabilitarTijeraCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-tijera').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-tijera').checked = false;
    }

    /**
     * Habilitar esqui
     */
    window.habilitarEsquiCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-esqui').hidden = false;
    }

    /**
     * Deshabilitar esqui
     */
    window.deshabilitarEsquiCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-esqui').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-esqui').checked = false;
    }

    // audio iluminacion

    /**
     * Habilitar parlante
     */
    window.habilitarParlanteCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-parlante').hidden = false;
    }

    /**
     * Deshabilitar parlante
     */
    window.deshabilitarParlanteCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-parlante').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-parlante').checked = false;
    }

    /**
     * Habilitar atril
     */
    window.habilitarAtrilCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-atril').hidden = false;
    }

    /**
     * Deshabilitar atril
     */
    window.deshabilitarAtrilCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-atril').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-atril').checked = false;
    }

    /**
     * Habilitar alargador
     */
    window.habilitarAlargadorCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-alargador').hidden = false;
    }

    /**
     * Deshabilitar alargador
     */
    window.deshabilitarAlargadorCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-alargador').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-alargador').checked = false;
    }

    /**
     * Habilitar foco
     */
    window.habilitarFocoCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-foco').hidden = false;
    }

    /**
     * Deshabilitar foco
     */
    window.deshabilitarFocoCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-foco').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-foco').checked = false;
    }

    /**
     * Habilitar microfono cintillo
     */
    window.habilitarMicrofonoCintilloCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-microfono-cintillo').hidden = false;
    }

    /**
     * Deshabilitar microfono cintillo
     */
    window.deshabilitarMicrofonoCintilloCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-microfono-cintillo').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-microfono-cintillo').checked = false;
    }

    /**
     * Habilitar microfono inalambrico
     */
    window.habilitarMicrofonoInalambricoCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-microfono-inalambrico').hidden = false;
    }

    /**
     * Deshabilitar microfono inalambrico
     */
    window.deshabilitarMicrofonoInalambricoCierre = function() {
        // mostrar checkbox
        document.getElementById('cierre-microfono-inalambrico').hidden = true;
        // deshablitar checkbox
        document.getElementById('cierre-listo-microfono-inalambrico').checked = false;
    }

    // Guardar los cambios

    // Material Relator

    $('#cierre-listo-pendon').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-proyector').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-notebook').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-encuesta-empresa').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-encuesta-adicionales').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-guia').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-prueba').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-plumones').change (function() {
        guardarDatos();
    });

    // Sence

    $('#cierre-listo-lector-biometrico').change (function() {
        guardarDatos();
    });

    // Outdoor

    $('#cierre-listo-venda').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-pvc').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-pelota').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-plumon').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-papel-kraft').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-pechera').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-masking').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-bolsa-basura').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-cono').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-plato').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-aro-madera').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-tijera').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-esqui').change (function() {
        guardarDatos();
    });

    // Audio iluminacion

    $('#cierre-listo-parlante').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-atril').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-alargador').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-foco').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-microfono-cintillo').change (function() {
        guardarDatos();
    });

    $('#cierre-listo-microfono-inalambrico').change (function() {
        guardarDatos();
    });

    /**
     * Envia los datos de recepcion del cierre para guardarlos en la bd
     */
    function guardarDatos() {
        // document.getElementById('cierre-recepcion-validacion-listo').hidden = true;
        // document.getElementById('cierre-recepcion-validacion-guardar-datos').hidden = true;
        document.getElementById('cierre-recepcion-error-guardar-datos').hidden = true;
        // Mostrar indicador que se estan guardando los datos
        document.getElementById('cierre-recepcion-guardando-datos').hidden = false;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/guardar_cierre_recepcion_checklist",
            data: {
                id: $('#servicio-id').data('data'),
                // Material Participante
                libro_asistencia_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-libro-asistencia').checked),
                encuesta_ads_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-encuesta-ads').checked),
                encuesta_empresa_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-encuesta-empresa').checked),
                pendones_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-pendon').checked),
                proyector_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-proyector').checked),
                preparar_guia_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-guia').checked),
                preparar_prueba_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-prueba').checked),
                plumones_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-plumones').checked),
                notebook_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-notebook').checked),
                encuesta_adicional_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-encuesta-adicionales').checked),
                // Sence
                verificar_lector_bio_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-lector-biometrico').checked),
                // Outdoor
                venda_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-venda').checked),
                pvc_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-pvc').checked),
                pelota_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-pelota').checked),
                plumones_recepcion_outdoor: reemplazarTrueFalse(document.getElementById('cierre-listo-plumon').checked),
                papel_craf_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-papel-kraft').checked),
                pechera_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-pechera').checked),
                masquin_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-masking').checked),
                bolsa_basura_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-bolsa-basura').checked),
                cono_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-cono').checked),
                plato_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-plato').checked),
                aro_madera_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-aro-madera').checked),
                tijera_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-tijera').checked),
                esqui_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-esqui').checked),
                // Audio iluminacion
                parlantes_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-parlante').checked),
                atril_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-atril').checked),
                alargador_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-alargador').checked),
                foco_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-foco').checked),
                microfono_cintillo_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-microfono-cintillo').checked),
                microfono_inalambrico_recepcion: reemplazarTrueFalse(document.getElementById('cierre-listo-microfono-inalambrico').checked),
            },
            success: function(result) {
                // console.log('ajax datos recepcion ok');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('cierre-recepcion-guardando-datos').hidden = true;
            },
            error: function(xhr) {
                // console.log('ajax datos recepcion error');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('cierre-recepcion-guardando-datos').hidden = true;
                document.getElementById('cierre-recepcion-error-guardar-datos').hidden = false;
            }
        });
    }

    window.guardarRecepcionCierre = function() {
        guardarDatos();
    }


    /**
     * Deshabilita los campos de ingreso de datos
     */
    window.deshabilitarRecepcion = function() {
        // --material relator
        // -pendon
        // listo
        this.document.getElementById('cierre-listo-pendon').disabled = true;
        this.document.getElementById('cierre-listo-pendon-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-pendon-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -proyector
        // listo
        this.document.getElementById('cierre-listo-proyector').disabled = true;
        this.document.getElementById('cierre-listo-proyector-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-proyector-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -notebook
        // listo
        this.document.getElementById('cierre-listo-notebook').disabled = true;
        this.document.getElementById('cierre-listo-notebook-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-notebook-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -encuesta empresa
        // listo
        this.document.getElementById('cierre-listo-encuesta-empresa').disabled = true;
        this.document.getElementById('cierre-listo-encuesta-empresa-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-encuesta-empresa-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -encuesta adicionales
        // listo
        this.document.getElementById('cierre-listo-encuesta-adicionales').disabled = true;
        this.document.getElementById('cierre-listo-encuesta-adicionales-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-encuesta-adicionales-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -guia
        // listo
        this.document.getElementById('cierre-listo-guia').disabled = true;
        this.document.getElementById('cierre-listo-guia-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-guia-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -prueba
        // listo
        this.document.getElementById('cierre-listo-prueba').disabled = true;
        this.document.getElementById('cierre-listo-prueba-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-prueba-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -plumones
        // listo
        this.document.getElementById('cierre-listo-plumones').disabled = true;
        this.document.getElementById('cierre-listo-plumones-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-plumones-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // --sence
        // -lector biometrico
        // listo
        this.document.getElementById('cierre-listo-lector-biometrico').disabled = true;
        this.document.getElementById('cierre-listo-lector-biometrico-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-lector-biometrico-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // --outdoor
        // -venda
        // listo
        this.document.getElementById('cierre-listo-venda').disabled = true;
        this.document.getElementById('cierre-listo-venda-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-venda-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -pvc
        // listo
        this.document.getElementById('cierre-listo-pvc').disabled = true;
        this.document.getElementById('cierre-listo-pvc-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-pvc-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -pelota
        // listo
        this.document.getElementById('cierre-listo-pelota').disabled = true;
        this.document.getElementById('cierre-listo-pelota-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-pelota-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -plumon
        // listo
        this.document.getElementById('cierre-listo-plumon').disabled = true;
        this.document.getElementById('cierre-listo-plumon-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-plumon-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -papel kraft
        // listo
        this.document.getElementById('cierre-listo-papel-kraft').disabled = true;
        this.document.getElementById('cierre-listo-papel-kraft-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-papel-kraft-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -pechera
        // listo
        this.document.getElementById('cierre-listo-pechera').disabled = true;
        this.document.getElementById('cierre-listo-pechera-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-pechera-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -masking
        // listo
        this.document.getElementById('cierre-listo-masking').disabled = true;
        this.document.getElementById('cierre-listo-masking-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-masking-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -bolsa basura
        // listo
        this.document.getElementById('cierre-listo-bolsa-basura').disabled = true;
        this.document.getElementById('cierre-listo-bolsa-basura-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-bolsa-basura-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -cono
        // listo
        this.document.getElementById('cierre-listo-cono').disabled = true;
        this.document.getElementById('cierre-listo-cono-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-cono-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -plato
        // listo
        this.document.getElementById('cierre-listo-plato').disabled = true;
        this.document.getElementById('cierre-listo-plato-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-plato-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -aro madera
        // listo
        this.document.getElementById('cierre-listo-aro-madera').disabled = true;
        this.document.getElementById('cierre-listo-aro-madera-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-aro-madera-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -tijera
        // listo
        this.document.getElementById('cierre-listo-tijera').disabled = true;
        this.document.getElementById('cierre-listo-tijera-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-tijera-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -esqui
        // listo
        this.document.getElementById('cierre-listo-esqui').disabled = true;
        this.document.getElementById('cierre-listo-esqui-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-esqui-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // --audio iluminacion
        // -parlante
        // listo
        this.document.getElementById('cierre-listo-parlante').disabled = true;
        this.document.getElementById('cierre-listo-parlante-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-parlante-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -atril
        // listo
        this.document.getElementById('cierre-listo-atril').disabled = true;
        this.document.getElementById('cierre-listo-atril-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-atril-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -alargador
        // listo
        this.document.getElementById('cierre-listo-alargador').disabled = true;
        this.document.getElementById('cierre-listo-alargador-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-alargador-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -foco
        // listo
        this.document.getElementById('cierre-listo-foco').disabled = true;
        this.document.getElementById('cierre-listo-foco-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-foco-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -microfono cintillo
        // listo
        this.document.getElementById('cierre-listo-microfono-cintillo').disabled = true;
        this.document.getElementById('cierre-listo-microfono-cintillo-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-microfono-cintillo-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // -microfono inalambrico
        // listo
        this.document.getElementById('cierre-listo-microfono-inalambrico').disabled = true;
        this.document.getElementById('cierre-listo-microfono-inalambrico-color').removeAttribute('class');
        this.document.getElementById('cierre-listo-microfono-inalambrico-color').setAttribute('class','colorinput-color bg-cyan-lighter');
    }

    // Cargar los recepcion de la bd

    // Material Relator

    var checkMaterialRelator = $('#data-tag-check-material-relator').data('data');

    if (checkMaterialRelator.libro_asistencia_recepcion === 1) {
        document.getElementById('cierre-listo-libro-asistencia').checked = true;
    }

    if (checkMaterialRelator.pendones_recepcion === 1) {
        document.getElementById('cierre-listo-pendon').checked = true;
    }

    if (checkMaterialRelator.proyector_recepcion === 1) {
        document.getElementById('cierre-listo-proyector').checked = true;
    }

    if (checkMaterialRelator.notebook_recepcion === 1) {
        document.getElementById('cierre-listo-notebook').checked = true;
    }

    if (checkMaterialRelator.encuesta_ads_recepcion === 1) {
        document.getElementById('cierre-listo-encuesta-ads').checked = true;
    }

    if (checkMaterialRelator.encuesta_empresa_recepcion === 1) {
        document.getElementById('cierre-listo-encuesta-empresa').checked = true;
    }

    if (checkMaterialRelator.encuesta_adicional_recepcion === 1) {
        document.getElementById('cierre-listo-encuesta-adicionales').checked = true;
    }

    if (checkMaterialRelator.preparar_guia_recepcion === 1) {
        document.getElementById('cierre-listo-guia').checked = true;
    }

    if (checkMaterialRelator.preparar_prueba_recepcion === 1) {
        document.getElementById('cierre-listo-prueba').checked = true;
    }

    if (checkMaterialRelator.plumones_recepcion === 1) {
        document.getElementById('cierre-listo-plumones').checked = true;
    }

    // Sence

    var checkSence = $('#data-tag-check-sence').data('data');

    if (checkSence.verificar_lector_bio_recepcion === 1) {
        document.getElementById('cierre-listo-lector-biometrico').checked = true;
    }

    // Outdoor

    var checkOutdoor = $('#data-tag-check-outdoor').data('data');

    if (checkOutdoor.venda_recepcion === 1) {
        document.getElementById('cierre-listo-venda').checked = true;
    }

    if (checkOutdoor.pvc_recepcion === 1) {
        document.getElementById('cierre-listo-pvc').checked = true;
    }

    if (checkOutdoor.pelota_recepcion === 1) {
        document.getElementById('cierre-listo-pelota').checked = true;
    }

    if (checkOutdoor.plumones_recepcion === 1) {
        document.getElementById('cierre-listo-plumon').checked = true;
    }

    if (checkOutdoor.papel_craf_recepcion === 1) {
        document.getElementById('cierre-listo-papel-kraft').checked = true;
    }

    if (checkOutdoor.pechera_recepcion === 1) {
        document.getElementById('cierre-listo-pechera').checked = true;
    }

    if (checkOutdoor.masquin_recepcion === 1) {
        document.getElementById('cierre-listo-masking').checked = true;
    }

    if (checkOutdoor.bolsa_basura_recepcion === 1) {
        document.getElementById('cierre-listo-bolsa-basura').checked = true;
    }

    if (checkOutdoor.cono_recepcion === 1) {
        document.getElementById('cierre-listo-cono').checked = true;
    }

    if (checkOutdoor.plato_recepcion === 1) {
        document.getElementById('cierre-listo-plato').checked = true;
    }

    if (checkOutdoor.aro_madera_recepcion === 1) {
        document.getElementById('cierre-listo-aro-madera').checked = true;
    }

    if (checkOutdoor.tijera_recepcion === 1) {
        document.getElementById('cierre-listo-tijera').checked = true;
    }

    if (checkOutdoor.esqui_recepcion === 1) {
        document.getElementById('cierre-listo-esqui').checked = true;
    }

    // Audio iluminacion

    var checkAudioIluminacion = $('#data-tag-check-audio-iluminacion').data('data');

    if (checkAudioIluminacion.parlantes_recepcion === 1) {
        document.getElementById('cierre-listo-parlante').checked = true;
    }

    if (checkAudioIluminacion.atril_recepcion === 1) {
        document.getElementById('cierre-listo-atril').checked = true;
    }

    if (checkAudioIluminacion.alargador_recepcion === 1) {
        document.getElementById('cierre-listo-alargador').checked = true;
    }

    if (checkAudioIluminacion.foco_recepcion === 1) {
        document.getElementById('cierre-listo-foco').checked = true;
    }

    if (checkAudioIluminacion.microfono_cintillo_recepcion === 1) {
        document.getElementById('cierre-listo-microfono-cintillo').checked = true;
    }

    if (checkAudioIluminacion.microfono_inalambrico_recepcion === 1) {
        document.getElementById('cierre-listo-microfono-inalambrico').checked = true;
    }

});