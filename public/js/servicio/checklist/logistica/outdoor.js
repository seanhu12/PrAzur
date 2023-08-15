$(document).ready(function () {

    /**
     * Habilitar venda
     */
    function habilitarVenda() {
        // hablitar checkbox
        document.getElementById('logistica-listo-venda').disabled = false;
        document.getElementById('logistica-listo-venda-color').removeAttribute('class');
        document.getElementById('logistica-listo-venda-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-venda').style.color = '#495057';
    }

    /**
     * Deshabilitar venda
     */
    function deshabilitarVenda() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-venda').disabled = true;
        document.getElementById('logistica-listo-venda').checked = false;
        document.getElementById('logistica-listo-venda-color').removeAttribute('class');
        document.getElementById('logistica-listo-venda-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-venda').style.color = 'grey';
    }

    /**
     * Habilitar pvc
     */
    function habilitarPvc() {
        // hablitar checkbox
        document.getElementById('logistica-listo-pvc').disabled = false;
        document.getElementById('logistica-listo-pvc-color').removeAttribute('class');
        document.getElementById('logistica-listo-pvc-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-pvc').style.color = '#495057';
    }

    /**
     * Deshabilitar pvc
     */
    function deshabilitarPvc() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-pvc').disabled = true;
        document.getElementById('logistica-listo-pvc').checked = false;
        document.getElementById('logistica-listo-pvc-color').removeAttribute('class');
        document.getElementById('logistica-listo-pvc-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-pvc').style.color = 'grey';
    }

    /**
     * Habilitar pelota
     */
    function habilitarPelota() {
        // hablitar checkbox
        document.getElementById('logistica-listo-pelota').disabled = false;
        document.getElementById('logistica-listo-pelota-color').removeAttribute('class');
        document.getElementById('logistica-listo-pelota-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-pelota').style.color = '#495057';
    }

    /**
     * Deshabilitar pelota
     */
    function deshabilitarPelota() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-pelota').disabled = true;
        document.getElementById('logistica-listo-pelota').checked = false;
        document.getElementById('logistica-listo-pelota-color').removeAttribute('class');
        document.getElementById('logistica-listo-pelota-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-pelota').style.color = 'grey';
    }

    /**
     * Habilitar plumon
     */
    function habilitarPlumon() {
        // hablitar checkbox
        document.getElementById('logistica-listo-plumon').disabled = false;
        document.getElementById('logistica-listo-plumon-color').removeAttribute('class');
        document.getElementById('logistica-listo-plumon-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-plumon').style.color = '#495057';
    }

    /**
     * Deshabilitar plumon
     */
    function deshabilitarPlumon() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-plumon').disabled = true;
        document.getElementById('logistica-listo-plumon').checked = false;
        document.getElementById('logistica-listo-plumon-color').removeAttribute('class');
        document.getElementById('logistica-listo-plumon-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-plumon').style.color = 'grey';
    }

    /**
     * Habilitar papel kraft
     */
    function habilitarPapelKraft() {
        // hablitar checkbox
        document.getElementById('logistica-listo-papel-kraft').disabled = false;
        document.getElementById('logistica-listo-papel-kraft-color').removeAttribute('class');
        document.getElementById('logistica-listo-papel-kraft-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-papel-kraft').style.color = '#495057';
    }

    /**
     * Deshabilitar papel kraft
     */
    function deshabilitarPapelKraft() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-papel-kraft').disabled = true;
        document.getElementById('logistica-listo-papel-kraft').checked = false;
        document.getElementById('logistica-listo-papel-kraft-color').removeAttribute('class');
        document.getElementById('logistica-listo-papel-kraft-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-papel-kraft').style.color = 'grey';
    }

    /**
     * Habilitar pechera
     */
    function habilitarPechera() {
        // hablitar checkbox
        document.getElementById('logistica-listo-pechera').disabled = false;
        document.getElementById('logistica-listo-pechera-color').removeAttribute('class');
        document.getElementById('logistica-listo-pechera-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-pechera').style.color = '#495057';
    }

    /**
     * Deshabilitar pechera
     */
    function deshabilitarPechera() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-pechera').disabled = true;
        document.getElementById('logistica-listo-pechera').checked = false;
        document.getElementById('logistica-listo-pechera-color').removeAttribute('class');
        document.getElementById('logistica-listo-pechera-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-pechera').style.color = 'grey';
    }

    /**
     * Habilitar masking
     */
    function habilitarMasking() {
        // hablitar checkbox
        document.getElementById('logistica-listo-masking').disabled = false;
        document.getElementById('logistica-listo-masking-color').removeAttribute('class');
        document.getElementById('logistica-listo-masking-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-masking').style.color = '#495057';
    }

    /**
     * Deshabilitar masking
     */
    function deshabilitarMasking() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-masking').disabled = true;
        document.getElementById('logistica-listo-masking').checked = false;
        document.getElementById('logistica-listo-masking-color').removeAttribute('class');
        document.getElementById('logistica-listo-masking-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-masking').style.color = 'grey';
    }

    /**
     * Habilitar bolsa basura
     */
    function habilitarBolsaBasura() {
        // hablitar checkbox
        document.getElementById('logistica-listo-bolsa-basura').disabled = false;
        document.getElementById('logistica-listo-bolsa-basura-color').removeAttribute('class');
        document.getElementById('logistica-listo-bolsa-basura-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-bolsa-basura').style.color = '#495057';
    }

    /**
     * Deshabilitar bolsa basura
     */
    function deshabilitarBolsaBasura() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-bolsa-basura').disabled = true;
        document.getElementById('logistica-listo-bolsa-basura').checked = false;
        document.getElementById('logistica-listo-bolsa-basura-color').removeAttribute('class');
        document.getElementById('logistica-listo-bolsa-basura-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-bolsa-basura').style.color = 'grey';
    }

    /**
     * Habilitar cono
     */
    function habilitarCono() {
        // hablitar checkbox
        document.getElementById('logistica-listo-cono').disabled = false;
        document.getElementById('logistica-listo-cono-color').removeAttribute('class');
        document.getElementById('logistica-listo-cono-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-cono').style.color = '#495057';
    }

    /**
     * Deshabilitar cono
     */
    function deshabilitarCono() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-cono').disabled = true;
        document.getElementById('logistica-listo-cono').checked = false;
        document.getElementById('logistica-listo-cono-color').removeAttribute('class');
        document.getElementById('logistica-listo-cono-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-cono').style.color = 'grey';
    }

    /**
     * Habilitar plato
     */
    function habilitarPlato() {
        // hablitar checkbox
        document.getElementById('logistica-listo-plato').disabled = false;
        document.getElementById('logistica-listo-plato-color').removeAttribute('class');
        document.getElementById('logistica-listo-plato-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-plato').style.color = '#495057';
    }

    /**
     * Deshabilitar plato
     */
    function deshabilitarPlato() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-plato').disabled = true;
        document.getElementById('logistica-listo-plato').checked = false;
        document.getElementById('logistica-listo-plato-color').removeAttribute('class');
        document.getElementById('logistica-listo-plato-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-plato').style.color = 'grey';
    }

    /**
     * Habilitar aro madera
     */
    function habilitarAroMadera() {
        // hablitar checkbox
        document.getElementById('logistica-listo-aro-madera').disabled = false;
        document.getElementById('logistica-listo-aro-madera-color').removeAttribute('class');
        document.getElementById('logistica-listo-aro-madera-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-aro-madera').style.color = '#495057';
    }

    /**
     * Deshabilitar aro madera
     */
    function deshabilitarAroMadera() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-aro-madera').disabled = true;
        document.getElementById('logistica-listo-aro-madera').checked = false;
        document.getElementById('logistica-listo-aro-madera-color').removeAttribute('class');
        document.getElementById('logistica-listo-aro-madera-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-aro-madera').style.color = 'grey';
    }

    /**
     * Habilitar tijera
     */
    function habilitarTijera() {
        // hablitar checkbox
        document.getElementById('logistica-listo-tijera').disabled = false;
        document.getElementById('logistica-listo-tijera-color').removeAttribute('class');
        document.getElementById('logistica-listo-tijera-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-tijera').style.color = '#495057';
    }

    /**
     * Deshabilitar tijera
     */
    function deshabilitarTijera() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-tijera').disabled = true;
        document.getElementById('logistica-listo-tijera').checked = false;
        document.getElementById('logistica-listo-tijera-color').removeAttribute('class');
        document.getElementById('logistica-listo-tijera-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-tijera').style.color = 'grey';
    }

    /**
     * Habilitar esqui
     */
    function habilitarEsqui() {
        // hablitar checkbox
        document.getElementById('logistica-listo-esqui').disabled = false;
        document.getElementById('logistica-listo-esqui-color').removeAttribute('class');
        document.getElementById('logistica-listo-esqui-color').setAttribute('class','colorinput-color bg-cyan');
        // cambiar color labels
        document.getElementById('logistica-text-esqui').style.color = '#495057';
    }

    /**
     * Deshabilitar esqui
     */
    function deshabilitarEsqui() {
        // deshablitar checkbox
        document.getElementById('logistica-listo-esqui').disabled = true;
        document.getElementById('logistica-listo-esqui').checked = false;
        document.getElementById('logistica-listo-esqui-color').removeAttribute('class');
        document.getElementById('logistica-listo-esqui-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cambiar color labels
        document.getElementById('logistica-text-esqui').style.color = 'grey';
    }

    // Habilitar/deshabilitar venda
    $('#logistica-aplica-venda').change(function() {
        if (this.checked) {
            habilitarVenda();
            habilitarVendaCierre();
        } else {
            deshabilitarVenda();
            deshabilitarVendaCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar pvc
    $('#logistica-aplica-pvc').change(function() {
        if (this.checked) {
            habilitarPvc();
            habilitarPvcCierre();
        } else {
            deshabilitarPvc();
            deshabilitarPvcCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar pelota
    $('#logistica-aplica-pelota').change(function() {
        if (this.checked) {
            habilitarPelota();
            habilitarPelotaCierre();
        } else {
            deshabilitarPelota();
            deshabilitarPelotaCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar plumon
    $('#logistica-aplica-plumon').change(function() {
        if (this.checked) {
            habilitarPlumon();
            habilitarPlumonCierre();
        } else {
            deshabilitarPlumon();
            deshabilitarPlumonCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar papel kraft
    $('#logistica-aplica-papel-kraft').change(function() {
        if (this.checked) {
            habilitarPapelKraft();
            habilitarPapelKraftCierre();
        } else {
            deshabilitarPapelKraft();
            deshabilitarPapelKraftCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar pechera
    $('#logistica-aplica-pechera').change(function() {
        if (this.checked) {
            habilitarPechera();
            habilitarPecheraCierre();
        } else {
            deshabilitarPechera();
            deshabilitarPecheraCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar masking
    $('#logistica-aplica-masking').change(function() {
        if (this.checked) {
            habilitarMasking();
            habilitarMaskingCierre();
        } else {
            deshabilitarMasking();
            deshabilitarMaskingCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar bolsa basura
    $('#logistica-aplica-bolsa-basura').change(function() {
        if (this.checked) {
            habilitarBolsaBasura();
            habilitarBolsaBasuraCierre();
        } else {
            deshabilitarBolsaBasura();
            deshabilitarBolsaBasuraCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar cono
    $('#logistica-aplica-cono').change(function() {
        if (this.checked) {
            habilitarCono();
            habilitarConoCierre();
        } else {
            deshabilitarCono();
            deshabilitarConoCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar plato
    $('#logistica-aplica-plato').change(function() {
        if (this.checked) {
            habilitarPlato();
            habilitarPlatoCierre();
        } else {
            deshabilitarPlato();
            deshabilitarPlatoCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar aro madera
    $('#logistica-aplica-aro-madera').change(function() {
        if (this.checked) {
            habilitarAroMadera();
            habilitarAroMaderaCierre();
        } else {
            deshabilitarAroMadera();
            deshabilitarAroMaderaCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar tijera
    $('#logistica-aplica-tijera').change(function() {
        if (this.checked) {
            habilitarTijera();
            habilitarTijeraCierre();
        } else {
            deshabilitarTijera();
            deshabilitarTijeraCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    // Habilitar/deshabilitar esqui
    $('#logistica-aplica-esqui').change(function() {
        if (this.checked) {
            habilitarEsqui();
            habilitarEsquiCierre();
        } else {
            deshabilitarEsqui();
            deshabilitarEsquiCierre();
        }
        guardarDatos();
        guardarRecepcionCierre();
    });

    $('#logistica-listo-venda').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-pvc').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-pelota').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-plumon').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-papel-kraft').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-pechera').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-masking').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-bolsa-basura').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-cono').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-plato').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-aro-madera').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-tijera').change (function() {
        guardarDatos();
    });

    $('#logistica-listo-esqui').change (function() {
        guardarDatos();
    });

    $('#logistica-outdoor-otros').change (function() {
        guardarDatos();
    });

    /**
     * Envia los datos de la coordinacion para guardarlos en la bd
     */
    function guardarDatos() {
        document.getElementById('logistica-outdoor-error-guardar-datos').hidden = true;
        // Mostrar indicador que se estan guardando los datos
        document.getElementById('logistica-outdoor-guardando-datos').hidden = false;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/servicio/guardar_logistica_outdoor_checklist",
            data: {
                id: $('#servicio-id').data('data'),
                venda_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-venda').checked),
                venda_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-venda').checked),
                pvc_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-pvc').checked),
                pvc_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-pvc').checked),
                pelota_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-pelota').checked),
                pelota_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-pelota').checked),
                plumones_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-plumon').checked),
                plumones_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-plumon').checked),
                papel_craf_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-papel-kraft').checked),
                papel_craf_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-papel-kraft').checked),
                pechera_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-pechera').checked),
                pechera_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-pechera').checked),
                masquin_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-masking').checked),
                masquin_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-masking').checked),
                bolsa_basura_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-bolsa-basura').checked),
                bolsa_basura_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-bolsa-basura').checked),
                cono_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-cono').checked),
                cono_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-cono').checked),
                plato_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-plato').checked),
                plato_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-plato').checked),
                aro_madera_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-aro-madera').checked),
                aro_madera_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-aro-madera').checked),
                tijera_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-tijera').checked),
                tijera_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-tijera').checked),
                esqui_aplica: reemplazarTrueFalse(document.getElementById('logistica-aplica-esqui').checked),
                esqui_listo: reemplazarTrueFalse(document.getElementById('logistica-listo-esqui').checked),
                otros: document.getElementById('logistica-outdoor-otros').value
            },
            success: function(result) {
                // console.log('ajax datos ok');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('logistica-outdoor-guardando-datos').hidden = true;
            },
            error: function(xhr) {
                // console.log('ajax datos error');
                // Ocultar indicador que se estan guardando los datos
                document.getElementById('logistica-outdoor-guardando-datos').hidden = true;
                document.getElementById('logistica-outdoor-error-guardar-datos').hidden = false;
            }
        });
    }


    /**
     * Deshabilita los campos de ingreso de datos
     */
    window.deshabilitarOutdoor = function() {
        // venda
        // aplica
        this.document.getElementById('logistica-aplica-venda').disabled = true;
        this.document.getElementById('logistica-aplica-venda-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-venda-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-venda').disabled = true;
        this.document.getElementById('logistica-listo-venda-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-venda-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // pvc
        // aplica
        this.document.getElementById('logistica-aplica-pvc').disabled = true;
        this.document.getElementById('logistica-aplica-pvc-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-pvc-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-pvc').disabled = true;
        this.document.getElementById('logistica-listo-pvc-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-pvc-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // pelota
        // aplica
        this.document.getElementById('logistica-aplica-pelota').disabled = true;
        this.document.getElementById('logistica-aplica-pelota-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-pelota-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-pelota').disabled = true;
        this.document.getElementById('logistica-listo-pelota-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-pelota-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // plumon
        // aplica
        this.document.getElementById('logistica-aplica-plumon').disabled = true;
        this.document.getElementById('logistica-aplica-plumon-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-plumon-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-plumon').disabled = true;
        this.document.getElementById('logistica-listo-plumon-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-plumon-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // papel kraft
        // aplica
        this.document.getElementById('logistica-aplica-papel-kraft').disabled = true;
        this.document.getElementById('logistica-aplica-papel-kraft-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-papel-kraft-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-papel-kraft').disabled = true;
        this.document.getElementById('logistica-listo-papel-kraft-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-papel-kraft-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // pechera
        // aplica
        this.document.getElementById('logistica-aplica-pechera').disabled = true;
        this.document.getElementById('logistica-aplica-pechera-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-pechera-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-pechera').disabled = true;
        this.document.getElementById('logistica-listo-pechera-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-pechera-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // masking
        // aplica
        this.document.getElementById('logistica-aplica-masking').disabled = true;
        this.document.getElementById('logistica-aplica-masking-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-masking-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-masking').disabled = true;
        this.document.getElementById('logistica-listo-masking-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-masking-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // bolsa basura
        // aplica
        this.document.getElementById('logistica-aplica-bolsa-basura').disabled = true;
        this.document.getElementById('logistica-aplica-bolsa-basura-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-bolsa-basura-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-bolsa-basura').disabled = true;
        this.document.getElementById('logistica-listo-bolsa-basura-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-bolsa-basura-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // cono
        // aplica
        this.document.getElementById('logistica-aplica-cono').disabled = true;
        this.document.getElementById('logistica-aplica-cono-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-cono-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-cono').disabled = true;
        this.document.getElementById('logistica-listo-cono-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-cono-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // plato
        // aplica
        this.document.getElementById('logistica-aplica-plato').disabled = true;
        this.document.getElementById('logistica-aplica-plato-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-plato-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-plato').disabled = true;
        this.document.getElementById('logistica-listo-plato-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-plato-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // aro madera
        // aplica
        this.document.getElementById('logistica-aplica-aro-madera').disabled = true;
        this.document.getElementById('logistica-aplica-aro-madera-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-aro-madera-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-aro-madera').disabled = true;
        this.document.getElementById('logistica-listo-aro-madera-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-aro-madera-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // tijera
        // aplica
        this.document.getElementById('logistica-aplica-tijera').disabled = true;
        this.document.getElementById('logistica-aplica-tijera-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-tijera-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-tijera').disabled = true;
        this.document.getElementById('logistica-listo-tijera-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-tijera-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // esqui
        // aplica
        this.document.getElementById('logistica-aplica-esqui').disabled = true;
        this.document.getElementById('logistica-aplica-esqui-color').removeAttribute('class');
        this.document.getElementById('logistica-aplica-esqui-color').setAttribute('class','custom-switch-indicator bg-cyan-lighter');
        // listo
        this.document.getElementById('logistica-listo-esqui').disabled = true;
        this.document.getElementById('logistica-listo-esqui-color').removeAttribute('class');
        this.document.getElementById('logistica-listo-esqui-color').setAttribute('class','colorinput-color bg-cyan-lighter');
        // otros
        this.document.getElementById('logistica-outdoor-otros').setAttribute('readonly','');
    }

    var checkOutdoor = $('#data-tag-check-outdoor').data('data');

    // Cargar los listos de la bd
    if (checkOutdoor.venda_listo === 1) {
        document.getElementById('logistica-listo-venda').checked = true;
    }

    if (checkOutdoor.pvc_listo === 1) {
        document.getElementById('logistica-listo-pvc').checked = true;
    }

    if (checkOutdoor.pelota_listo === 1) {
        document.getElementById('logistica-listo-pelota').checked = true;
    }

    if (checkOutdoor.plumones_listo === 1) {
        document.getElementById('logistica-listo-plumon').checked = true;
    }

    if (checkOutdoor.papel_craf_listo === 1) {
        document.getElementById('logistica-listo-papel-kraft').checked = true;
    }

    if (checkOutdoor.pechera_listo === 1) {
        document.getElementById('logistica-listo-pechera').checked = true;
    }

    if (checkOutdoor.masquin_listo === 1) {
        document.getElementById('logistica-listo-masking').checked = true;
    }

    if (checkOutdoor.bolsa_basura_listo === 1) {
        document.getElementById('logistica-listo-bolsa-basura').checked = true;
    }

    if (checkOutdoor.cono_listo === 1) {
        document.getElementById('logistica-listo-cono').checked = true;
    }

    if (checkOutdoor.plato_listo === 1) {
        document.getElementById('logistica-listo-plato').checked = true;
    }

    if (checkOutdoor.aro_madera_listo === 1) {
        document.getElementById('logistica-listo-aro-madera').checked = true;
    }

    if (checkOutdoor.tijera_listo === 1) {
        document.getElementById('logistica-listo-tijera').checked = true;
    }

    if (checkOutdoor.esqui_listo === 1) {
        document.getElementById('logistica-listo-esqui').checked = true;
    }

    // Verificar si venda esta deshabilitado
    if (checkOutdoor.venda_aplica === 1) {
        document.getElementById('logistica-aplica-venda').checked = true;
        habilitarVenda();
        habilitarVendaCierre();
    } else {
        document.getElementById('logistica-aplica-venda').checked = false;
        deshabilitarVenda();
        deshabilitarVendaCierre();
    }

    // Verificar si pvc esta deshabilitado
    if (checkOutdoor.pvc_aplica === 1) {
        document.getElementById('logistica-aplica-pvc').checked = true;
        habilitarPvc();
        habilitarPvcCierre();
    } else {
        document.getElementById('logistica-aplica-pvc').checked = false;
        deshabilitarPvc();
        deshabilitarPvcCierre();
    }

    // Verificar si pelota esta deshabilitado
    if (checkOutdoor.pelota_aplica === 1) {
        document.getElementById('logistica-aplica-pelota').checked = true;
        habilitarPelota();
        habilitarPelotaCierre();
    } else {
        document.getElementById('logistica-aplica-pelota').checked = false;
        deshabilitarPelota();
        deshabilitarPelotaCierre();
    }

    // Verificar si plumon esta deshabilitado
    if (checkOutdoor.plumones_aplica === 1) {
        document.getElementById('logistica-aplica-plumon').checked = true;
        habilitarPlumon();
        habilitarPlumonCierre();
    } else {
        document.getElementById('logistica-aplica-plumon').checked = false;
        deshabilitarPlumon();
        deshabilitarPlumonCierre();
    }

    // Verificar si papel kraft es esta deshabilitado
    if (checkOutdoor.papel_craf_aplica === 1) {
        document.getElementById('logistica-aplica-papel-kraft').checked = true;
        habilitarPapelKraft();
        habilitarPapelKraftCierre();
    } else {
        document.getElementById('logistica-aplica-papel-kraft').checked = false;
        deshabilitarPapelKraft();
        deshabilitarPapelKraftCierre();
    }

    // Verificar si pechera esta deshabilitado
    if (checkOutdoor.pechera_aplica === 1) {
        document.getElementById('logistica-aplica-pechera').checked = true;
        habilitarPechera();
        habilitarPecheraCierre();
    } else {
        document.getElementById('logistica-aplica-pechera').checked = false;
        deshabilitarPechera();
        deshabilitarPecheraCierre();
    }

    // Verificar si masking esta deshabilitado
    if (checkOutdoor.masquin_aplica === 1) {
        document.getElementById('logistica-aplica-masking').checked = true;
        habilitarMasking();
        habilitarMaskingCierre();
    } else {
        document.getElementById('logistica-aplica-masking').checked = false;
        deshabilitarMasking();
        deshabilitarMaskingCierre();
    }

    // Verificar si bolsa basura esta deshabilitado
    if (checkOutdoor.bolsa_basura_aplica === 1) {
        document.getElementById('logistica-aplica-bolsa-basura').checked = true;
        habilitarBolsaBasura();
        habilitarBolsaBasuraCierre();
    } else {
        document.getElementById('logistica-aplica-bolsa-basura').checked = false;
        deshabilitarBolsaBasura();
        deshabilitarBolsaBasuraCierre();
    }

    // Verificar si cono esta deshabilitado
    if (checkOutdoor.cono_aplica === 1) {
        document.getElementById('logistica-aplica-cono').checked = true;
        habilitarCono();
        habilitarConoCierre();
    } else {
        document.getElementById('logistica-aplica-cono').checked = false;
        deshabilitarCono();
        deshabilitarConoCierre();
    }

    // Verificar si plato esta deshabilitado
    if (checkOutdoor.plato_aplica === 1) {
        document.getElementById('logistica-aplica-plato').checked = true;
        habilitarPlato();
        habilitarPlatoCierre();
    } else {
        document.getElementById('logistica-aplica-plato').checked = false;
        deshabilitarPlato();
        deshabilitarPlatoCierre();
    }

    // Verificar si aro madera esta deshabilitado
    if (checkOutdoor.aro_madera_aplica === 1) {
        document.getElementById('logistica-aplica-aro-madera').checked = true;
        habilitarAroMadera();
        habilitarAroMaderaCierre();
    } else {
        document.getElementById('logistica-aplica-aro-madera').checked = false;
        deshabilitarAroMadera();
        deshabilitarAroMaderaCierre();
    }

    // Verificar si tijera esta deshabilitado
    if (checkOutdoor.tijera_aplica === 1) {
        document.getElementById('logistica-aplica-tijera').checked = true;
        habilitarTijera();
        habilitarTijeraCierre();
    } else {
        document.getElementById('logistica-aplica-tijera').checked = false;
        deshabilitarTijera();
        deshabilitarTijeraCierre();
    }

    // Verificar si esqui esta deshabilitado
    if (checkOutdoor.esqui_aplica === 1) {
        document.getElementById('logistica-aplica-esqui').checked = true;
        habilitarEsqui();
        habilitarEsquiCierre();
    } else {
        document.getElementById('logistica-aplica-esqui').checked = false;
        deshabilitarEsqui();
        deshabilitarEsquiCierre();
    }

});