$(document).ready(function () {

    // darle formato a los numeros traidos de la bd
    document.getElementById('practicas').innerText = formatoNumeroShow(document.getElementById('practicas').innerText);
    document.getElementById('teoricas').innerText = formatoNumeroShow(document.getElementById('teoricas').innerText);
    document.getElementById('total').innerText = formatoNumeroShow(document.getElementById('total').innerText);
    document.getElementById('participantes').innerText = formatoNumeroShow(document.getElementById('participantes').innerText);
});
