/* ========================= PARA EL TIEMPO ==================== */
const tiempo = document.querySelector('.tiempo'),
    fecha = document.querySelector('.fecha');

function Relojdigital() {
    let f = new Date(),
        dia = f.getDate(),
        mes = f.getMonth(),
        anio = f.getFullYear(),
        diaSemana = f.getDay();

    dia = ('0' + dia).slice(-2);

    let semana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    let showSemana = semana[diaSemana];

    let meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
    let showMes = meses[mes];


    // Formato personalizado para la fecha
    let fechaString = `${showSemana} ${dia} de ${showMes} de ${anio} - ${f.toLocaleTimeString()}`;
    fecha.innerHTML = fechaString;

}

setInterval(() => {
    Relojdigital();
}, 1000);

Relojdigital();


/* =========================== ABRIR EL LADO LATERAL DERECHA NOTIFICACION ======= */
window.addEventListener('DOMContentLoaded', function () {
    // Obtener referencias a los botones y al div
    let idNotificacion = document.getElementById('abrir-notificacion');
    let containerNotificacion = document.getElementById('container-notificacion');
    let closedNotificacion = document.getElementById('closed-notificacion');

    // Agregar un evento de clic al botón de abrir
    idNotificacion.addEventListener('click', function () {
        // Mostrar el div al hacer clic en el botón de abrir
        containerNotificacion.style.display = 'block';
        containerNotificacion.classList.remove('cerrado');
    });

    // Agregar un evento de clic al botón de cerrar
    closedNotificacion.addEventListener('click', function () {
        // Retrasar el ocultar del div por 500 milisegundos (medio segundo)
        containerNotificacion.classList.add('cerrado');
        setTimeout(function () {
            // Ocultar el div después del retraso
            containerNotificacion.style.display = 'none';
        }, 250); // 500 milisegundos de retraso
    });
});

/* abrir whatsapp */

$(document).ready(function () {
    $('#soporte').click(function () {
        window.open('https://api.whatsapp.com/send?phone=51984404105&text= Hola, necesito soporte para mi cuenta.');
    });
});

$(document).ready(function () {
    $('#contactar').click(function () {
        window.open('https://api.whatsapp.com/send?phone=51984404105&text= Hola, estoy interesado de trabajar con usted.');
    });
});