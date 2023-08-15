$(document).ready(function () {

    /**
     * Desplegar los archivos
     */
    window.mostrarArchivos = function(archivos,titulo) {
        // this.console.log(archivos);
        // Poner el titulo
        document.getElementById('archivos-label').innerText = titulo;
        // Hacer una tabla de html con los archivos
        // Recorrer los cursos para crear las filas de la tabla
        var archivosHtml = '';
        archivos.forEach(function(archivo) {
            archivosHtml = archivosHtml + '<tr>' + '<td>' + archivo.codigo + '</td>' + '<td>' + archivo.nombre + '</td>' + '<td>' + archivo.tipo + '</td>' + '<td class="text-right"><a class="btn btn-teal btn-sm" href="/servicio/descargar_documento/' + archivo.documento_id + '" title="Descargar"><i class="fas fa-file-download"></i></a></td>' + '</tr>';
        });
        // Hacer la tabla agregando las filas
        var html = '<table class="table">' + '<tbody>' + archivosHtml + '</tbody>' + '</table>';
        document.getElementById('archivos-disenio-tecnico').innerHTML = html;
        // Activar el pop-up (modal)
        $('#modal-archivos').modal('toggle');
    }

    var disenioTecnico = $('#data-tag-disenio-tecnico').data('data');

    // Cambiar los valores de los checkbox
    // Verificar si desabilitar la fila
    if (disenioTecnico.manual_aplica === 1) {
        document.getElementById('aplica-manual').checked = true;
        document.getElementById('text-manual').style.color = '#495057';
        document.getElementById('btn-archivos-manual').disabled = false;
    } else {
        document.getElementById('aplica-manual').checked = false;
        document.getElementById('text-manual').style.color = 'grey';
        document.getElementById('btn-archivos-manual').disabled = true;
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.prueba_aplica === 1) {
        document.getElementById('aplica-prueba').checked = true;
        document.getElementById('text-prueba').style.color = '#495057';
        document.getElementById('btn-archivos-prueba').disabled = false;
    } else {
        document.getElementById('aplica-prueba').checked = false;
        document.getElementById('text-prueba').style.color = 'grey';
        document.getElementById('btn-archivos-prueba').disabled = true;
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.guia_aplica === 1) {
        document.getElementById('aplica-guia').checked = true;
        document.getElementById('text-guia').style.color = '#495057';
        document.getElementById('btn-archivos-guia').disabled = false;
    } else {
        document.getElementById('aplica-guia').checked = false;
        document.getElementById('text-guia').style.color = 'grey';
        document.getElementById('btn-archivos-guia').disabled = true;
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.encuesta_adicionales_aplica === 1) {
        document.getElementById('aplica-encuesta-adicionales').checked = true;
        document.getElementById('text-encuesta-adicionales').style.color = '#495057';
        document.getElementById('btn-archivos-encuesta-adicionales').disabled = false;
    } else {
        document.getElementById('aplica-encuesta-adicionales').checked = false;
        document.getElementById('text-encuesta-adicionales').style.color = 'grey';
        document.getElementById('btn-archivos-encuesta-adicionales').disabled = true;
    }

    // Verificar si desabilitar la fila
    if (disenioTecnico.encuesta_empresa_aplica === 1) {
        document.getElementById('aplica-encuesta-empresa').checked = true;
        document.getElementById('text-encuesta-empresa').style.color = '#495057';
        document.getElementById('btn-archivos-encuesta-empresa').disabled = false;
    } else {
        document.getElementById('aplica-encuesta-empresa').checked = false;
        document.getElementById('text-encuesta-empresa').style.color = 'grey';
        document.getElementById('btn-archivos-encuesta-empresa').disabled = true;
    }

});