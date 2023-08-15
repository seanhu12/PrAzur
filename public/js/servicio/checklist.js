$(document).ready(function () {

    (function($) {
        $.fn.goTo = function() {
            $('html, body').animate({
                scrollTop: $(this).offset().top + 'px'
            }, 'fast');
            return this; // for chaining...
        }
    })(jQuery);

    window.irDatos = function() {
        $('#datos').goTo();
        mostrarDatos();
    }

    window.irDisenio = function() {
        $('#disenio').goTo();
        mostrarDisenio();
    }

    window.irLogistica = function() {
        $('#logistica').goTo();
        mostrarLogistica();
    }

    window.irCierre = function() {
        $('#cierre').goTo();
        mostrarCierre();
    }

    window.irArchivos = function() {
        $('#archivo').goTo();
        mostrarArchivo();
    }

    window.irObservaciones = function() {
        $('#observaciones').goTo();
        mostrarObservaciones();
    }

    window.mostrarDatos = function() {
        document.getElementById('datos-contenido').hidden = false;
        document.getElementById('btn-datos-ocultar').hidden = false;
        document.getElementById('btn-datos-mostrar').hidden = true;
    }

    window.ocultarDatos = function() {
        document.getElementById('datos-contenido').hidden = true;
        document.getElementById('btn-datos-ocultar').hidden = true;
        document.getElementById('btn-datos-mostrar').hidden = false;
    }

    window.mostrarDisenio = function() {
        document.getElementById('disenio-contenido').hidden = false;
        document.getElementById('btn-disenio-ocultar').hidden = false;
        document.getElementById('btn-disenio-mostrar').hidden = true;
    }

    window.ocultarDisenio = function() {
        document.getElementById('disenio-contenido').hidden = true;
        document.getElementById('btn-disenio-ocultar').hidden = true;
        document.getElementById('btn-disenio-mostrar').hidden = false;
    }

    window.mostrarLogistica = function() {
        document.getElementById('logistica-contenido').hidden = false;
        document.getElementById('btn-logistica-ocultar').hidden = false;
        document.getElementById('btn-logistica-mostrar').hidden = true;
    }

    window.ocultarLogistica = function() {
        document.getElementById('logistica-contenido').hidden = true;
        document.getElementById('btn-logistica-ocultar').hidden = true;
        document.getElementById('btn-logistica-mostrar').hidden = false;
    }

    window.mostrarCierre = function() {
        document.getElementById('cierre-contenido').hidden = false;
        document.getElementById('btn-cierre-ocultar').hidden = false;
        document.getElementById('btn-cierre-mostrar').hidden = true;
    }

    window.ocultarCierre = function() {
        document.getElementById('cierre-contenido').hidden = true;
        document.getElementById('btn-cierre-ocultar').hidden = true;
        document.getElementById('btn-cierre-mostrar').hidden = false;
    }

    window.mostrarArchivo = function() {
        document.getElementById('archivos-contenido').hidden = false;
        document.getElementById('btn-archivos-ocultar').hidden = false;
        document.getElementById('btn-archivos-mostrar').hidden = true;
    }

    window.ocultarArchivo = function() {
        document.getElementById('archivos-contenido').hidden = true;
        document.getElementById('btn-archivos-ocultar').hidden = true;
        document.getElementById('btn-archivos-mostrar').hidden = false;
    }

    window.mostrarObservaciones = function() {
        document.getElementById('observaciones-contenido').hidden = false;
        document.getElementById('btn-observaciones-ocultar').hidden = false;
        document.getElementById('btn-observaciones-mostrar').hidden = true;
    }

    window.ocultarObservaciones = function() {
        document.getElementById('observaciones-contenido').hidden = true;
        document.getElementById('btn-observaciones-ocultar').hidden = true;
        document.getElementById('btn-observaciones-mostrar').hidden = false;
    }

    function deshabilitarArchivos() {
        this.document.getElementById('archivo-4').setAttribute('disabled','');
    }

    var tipoServicio = $('#tipo-servicio').data('data');

    function deshabilitarOpcionesPrograma() {
        if (tipoServicio === 1) {
            document.getElementById('btn-generar-diplomas-programa').hidden = true;
            document.getElementById('btn-generar-diplomas-programa-deshabilitado').hidden = false;
            document.getElementById('btn-exportar-participantes-programa').hidden = true;
            document.getElementById('btn-exportar-participantes-programa-deshabilitado').hidden = false;
        } else {
            document.getElementById('btn-generar-diplomas-programa').hidden = true;
            document.getElementById('btn-generar-diplomas-programa-deshabilitado').hidden = true;
            document.getElementById('btn-exportar-participantes-programa').hidden = true;
            document.getElementById('btn-exportar-participantes-programa-deshabilitado').hidden = true;
        }
    }

    if (tipoServicio === 1) {
        document.getElementById('btn-generar-diplomas-programa').hidden = false;
        document.getElementById('btn-generar-diplomas-programa-deshabilitado').hidden = true;
        document.getElementById('btn-exportar-participantes-programa').hidden = false;
        document.getElementById('btn-exportar-participantes-programa-deshabilitado').hidden = true;
    } else {
        document.getElementById('btn-generar-diplomas-programa').hidden = true;
        document.getElementById('btn-generar-diplomas-programa-deshabilitado').hidden = true;
        document.getElementById('btn-exportar-participantes-programa').hidden = true;
        document.getElementById('btn-exportar-participantes-programa-deshabilitado').hidden = true;
    }

    var etapa = $('#etapa').data('data');

    // disenio tecnico
    if (etapa === 1) {
        deshabilitarOpcionesPrograma();
        deshabilitarCierre();
        irDatos();
    }

    // logistica
    if (etapa === 2) {
        deshabilitarOpcionesPrograma();
        deshabilitarCierre();
        irLogistica();
    }

    // preparado
    if (etapa === 3) {
        deshabilitarOpcionesPrograma();
        deshabilitarCierre();
    }

    // ejecucion
    if (etapa === 4) {
        deshabilitarOpcionesPrograma();
        deshabilitarDatos();
        deshabilitarLogistica();
        deshabilitarCierre();
    }

    // cierre
    if (etapa === 5) {
        deshabilitarDatos();
        deshabilitarLogistica();
        irCierre();
        // habilitar boton para descargar checklist
        document.getElementById('btn-descargar-checklist').hidden = false;
        document.getElementById('btn-descargar-checklist-deshabilitado').hidden = true;
        // habilitar boton para descargar el reporte basico
        document.getElementById('btn-reporte-basico').hidden = false;
        document.getElementById('btn-reporte-basico-deshabilitado').hidden = true;
    }

    // cerrado
    if (etapa === 6) {
        deshabilitarDatos();
        deshabilitarLogistica();
        deshabilitarCierre();
        // deshabilitarArchivos();
        deshabiltiarContactos();
        // deshabilitar observaciones
        document.getElementById('observaciones-checklist').setAttribute('disabled','');
        // habilitar boton para descargar checklist
        document.getElementById('btn-descargar-checklist').hidden = false;
        document.getElementById('btn-descargar-checklist-deshabilitado').hidden = true;
        // habilitar boton para descargar el reporte basico
        document.getElementById('btn-reporte-basico').hidden = false;
        document.getElementById('btn-reporte-basico-deshabilitado').hidden = true;
    }

    var estadoOperacional = $('#estado-operacional').data('data');

    // cerrado
    if (estadoOperacional === 5) {
        deshabilitarDatos();
        deshabilitarLogistica();
        deshabilitarCierre();
        // deshabilitarArchivos();
        deshabiltiarContactos();
        // deshabilitar observaciones
        document.getElementById('observaciones-checklist').setAttribute('disabled','');
        // habilitar boton para descargar checklist
        document.getElementById('btn-descargar-checklist').hidden = false;
        document.getElementById('btn-descargar-checklist-deshabilitado').hidden = true;
        // habilitar boton para descargar el reporte basico
        document.getElementById('btn-reporte-basico').hidden = false;
        document.getElementById('btn-reporte-basico-deshabilitado').hidden = true;
    }
});