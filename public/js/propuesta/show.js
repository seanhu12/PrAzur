$(document).ready(function () {
    /**
     * Desplegar los cursos del programa
     */
    window.desplegarCursosPrograma = function() {
        document.getElementById('cursos-programa-label').textContent = $('#programa_nombre').data('data');
        // Obtener los cursos del programa
        var cursosPrograma = JSON.parse(getCursosPrograma($('#programa_id').data('data')));
        // Hacer una tabla de html con los cursos
        // Recorrer los cursos para crear las filas de la tabla
        var cursosHtml = '';
        cursosPrograma.forEach(function(curso) {
            cursosHtml = cursosHtml + '<tr>' + '<td>' + curso.nombre_venta + '</td>' + '</tr>';
        });
        // Hacer la tabla agregando las filas
        var html = '<table class="table">' + '<thead>' + '<tr>' + '<th>' + '<label class="form-label">Cursos</label>' + '</th>' + '</tr>' + '</thead>' + '<tbody>' + cursosHtml + '</tbody>' + '</table>';
        document.getElementById('cursos-programa').innerHTML = html;
        // Activar el pop-up (modal)
        $('#modal-cursos-programa').modal('toggle');
    }

    /**
     * Obtener los cursos de un programa
     */
    window.getCursosPrograma = function(programaId) {
        var resultadoCursos;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/propuesta/cursos_programa",
            async: false,
            data: {
                programaId: programaId
            },
            success: function(result) {
                resultadoCursos = result;
            },
            error: function() {
                // console.log('error datos cursos programa');
            }
        });
        return resultadoCursos;
    }

    // darle formato a los numeros traidos de la bd
    document.getElementById('cant-total-horas').innerText = formatoNumeroShow(document.getElementById('cant-total-horas').innerText);
    document.getElementById('uf-hora').innerText = formatoDineroShow(document.getElementById('uf-hora').innerText);
    document.getElementById('monto').innerText = formatoDineroShow(document.getElementById('monto').innerText);
});
