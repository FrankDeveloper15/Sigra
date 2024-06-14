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


/* =========================== ABRIR EL LADO LATERAL DERECHA ======= */
window.addEventListener('DOMContentLoaded', function () {
    // Obtener referencias a los botones y al div
    let idAdministrar = document.getElementById('id-administrar');
    let containerDesplegar = document.getElementById('containerDesplegar');
    let closedAdministrar = document.getElementById('closed-administrar');
    let cuerpoGeneral1 = document.getElementById('cuerpo-general1');
    let cuerpoGeneral2 = document.getElementById('cuerpo-general2');
    let cuerpoGeneral3 = document.getElementById('cuerpo-general3');
    let cuerpoGeneral4 = document.getElementById('cuerpo-general4');
    let cuerpoGeneral5 = document.getElementById('cuerpo-general5');
    let cuerpoGeneral6 = document.getElementById('cuerpo-general6');
    var companyText1 = document.getElementById('datos-generales');
    var companyText2 = document.getElementById('restablecer-contrasenia');
    var companyText3 = document.getElementById('editar-perfil');
    var companyText4 = document.getElementById('historial-pagos');
    var companyText5 = document.getElementById('accesos');
    var companyText6 = document.getElementById('contrato');

    companyText1.classList.add('clicked');

    // Agregar un evento de clic al botón de abrir
    idAdministrar.addEventListener('click', function () {
        // Mostrar el div al hacer clic en el botón de abrir
        containerDesplegar.style.display = 'block';
        cuerpoGeneral1.style.display = 'block';
        containerDesplegar.classList.remove('cerrado');
    });

    // Agregar un evento de clic al botón de cerrar
    closedAdministrar.addEventListener('click', function () {
        // Retrasar el ocultar del div por 500 milisegundos (medio segundo)
        containerDesplegar.classList.add('cerrado');
        setTimeout(function () {
            // Ocultar el div después del retraso
            containerDesplegar.style.display = 'none'; 
            cuerpoGeneral2.style.display = 'none'; 
            cuerpoGeneral3.style.display = 'none'; 
            cuerpoGeneral4.style.display = 'none'; 
            cuerpoGeneral5.style.display = 'none'; 
            cuerpoGeneral6.style.display = 'none'; 
            companyText1.classList.add('clicked');
            companyText2.classList.remove('clicked');
            companyText3.classList.remove('clicked');
            companyText4.classList.remove('clicked');
            companyText5.classList.remove('clicked');
            companyText6.classList.remove('clicked');
        }, 250); // 500 milisegundos de retraso
    });
});

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

/* =================== CAMBIAR EL MENU DE OPCIONES =========== */
window.addEventListener('DOMContentLoaded', function () {
    // Obtener referencias a los botones y al div
    let datosGenerales = document.getElementById('datos-generales');
    let restablecerContrasenia = document.getElementById('restablecer-contrasenia');
    let editarPerfil = document.getElementById('editar-perfil');
    let historialPagos = document.getElementById('historial-pagos');
    let accesos = document.getElementById('accesos');
    let contrato = document.getElementById('contrato');
    let cuerpoGeneral1 = document.getElementById('cuerpo-general1');
    let cuerpoGeneral2 = document.getElementById('cuerpo-general2');
    let cuerpoGeneral3 = document.getElementById('cuerpo-general3');
    let cuerpoGeneral4 = document.getElementById('cuerpo-general4');
    let cuerpoGeneral5 = document.getElementById('cuerpo-general5');
    let cuerpoGeneral6 = document.getElementById('cuerpo-general6');

    // Agregar un evento de clic al botón de cerrar
    datosGenerales.addEventListener('click', function () {
        // Retrasar el ocultar del div por 500 milisegundos (medio segundo)
        cuerpoGeneral1.style.display = 'block';
        cuerpoGeneral2.style.display = 'none';
        cuerpoGeneral3.style.display = 'none';
        cuerpoGeneral4.style.display = 'none';
        cuerpoGeneral5.style.display = 'none';
        cuerpoGeneral6.style.display = 'none';
    });

    // Agregar un evento de clic al botón de abrir
    restablecerContrasenia.addEventListener('click', function () {
        // Mostrar el div al hacer clic en el botón de abrir
        cuerpoGeneral2.style.display = 'block';
        cuerpoGeneral1.style.display = 'none';
        cuerpoGeneral3.style.display = 'none';
        cuerpoGeneral4.style.display = 'none';
        cuerpoGeneral5.style.display = 'none';
        cuerpoGeneral6.style.display = 'none';
    });

    // Agregar un evento de clic al botón de cerrar
    editarPerfil.addEventListener('click', function () {
        // Retrasar el ocultar del div por 500 milisegundos (medio segundo)
        cuerpoGeneral3.style.display = 'block';
        cuerpoGeneral1.style.display = 'none';
        cuerpoGeneral2.style.display = 'none';
        cuerpoGeneral4.style.display = 'none';
        cuerpoGeneral5.style.display = 'none';
        cuerpoGeneral6.style.display = 'none';
    });
    
    // Agregar un evento de clic al botón de cerrar
    historialPagos.addEventListener('click', function () {
        // Retrasar el ocultar del div por 500 milisegundos (medio segundo)
        cuerpoGeneral4.style.display = 'block';
        cuerpoGeneral1.style.display = 'none';
        cuerpoGeneral2.style.display = 'none';
        cuerpoGeneral3.style.display = 'none';
        cuerpoGeneral5.style.display = 'none';
        cuerpoGeneral6.style.display = 'none';
    });

    // Agregar un evento de clic al botón de cerrar
    accesos.addEventListener('click', function () {
        // Retrasar el ocultar del div por 500 milisegundos (medio segundo)
        cuerpoGeneral5.style.display = 'block';
        cuerpoGeneral1.style.display = 'none';
        cuerpoGeneral2.style.display = 'none';
        cuerpoGeneral3.style.display = 'none';
        cuerpoGeneral4.style.display = 'none';
        cuerpoGeneral6.style.display = 'none';
    });

    // Agregar un evento de clic al botón de cerrar
    contrato.addEventListener('click', function () {
        // Retrasar el ocultar del div por 500 milisegundos (medio segundo)
        cuerpoGeneral6.style.display = 'block';
        cuerpoGeneral1.style.display = 'none';
        cuerpoGeneral2.style.display = 'none';
        cuerpoGeneral3.style.display = 'none';
        cuerpoGeneral4.style.display = 'none';
        cuerpoGeneral5.style.display = 'none';
    });

});


/* ============== ESTO ES DE PARA QUE SE MANTENGA EL COLOR DE LOS INDICES DEL MENU ============================== */
document.addEventListener('DOMContentLoaded', function () {
    var companyText1 = document.getElementById('datos-generales');
    var companyText2 = document.getElementById('restablecer-contrasenia');
    var companyText3 = document.getElementById('editar-perfil');
    var companyText4 = document.getElementById('historial-pagos');
    var companyText5 = document.getElementById('accesos');
    var companyText6 = document.getElementById('contrato');

    companyText1.addEventListener('click', function () {
        // Alternar la clase 'clicked' al hacer clic
        companyText1.classList.toggle('clicked');
        companyText2.classList.remove('clicked');
        companyText3.classList.remove('clicked');
        companyText4.classList.remove('clicked');
        companyText5.classList.remove('clicked');
        companyText6.classList.remove('clicked');
    });

    companyText2.addEventListener('click', function () {
        // Alternar la clase 'clicked' al hacer clic
        companyText2.classList.toggle('clicked');
        companyText1.classList.remove('clicked');
        companyText3.classList.remove('clicked');
        companyText4.classList.remove('clicked');
        companyText5.classList.remove('clicked');
        companyText6.classList.remove('clicked');
    });

    companyText3.addEventListener('click', function () {
        // Alternar la clase 'clicked' al hacer clic
        companyText3.classList.toggle('clicked');
        companyText2.classList.remove('clicked');
        companyText1.classList.remove('clicked');
        companyText4.classList.remove('clicked');
        companyText5.classList.remove('clicked');
        companyText6.classList.remove('clicked');
    });

    companyText4.addEventListener('click', function () {
        // Alternar la clase 'clicked' al hacer clic
        companyText4.classList.toggle('clicked');
        companyText2.classList.remove('clicked');
        companyText3.classList.remove('clicked');
        companyText1.classList.remove('clicked');
        companyText5.classList.remove('clicked');
        companyText6.classList.remove('clicked');
    });

    companyText5.addEventListener('click', function () {
        // Alternar la clase 'clicked' al hacer clic
        companyText5.classList.toggle('clicked');
        companyText4.classList.remove('clicked');
        companyText2.classList.remove('clicked');
        companyText3.classList.remove('clicked');
        companyText1.classList.remove('clicked');
        companyText6.classList.remove('clicked');
    });

    companyText6.addEventListener('click', function () {
        // Alternar la clase 'clicked' al hacer clic
        companyText6.classList.toggle('clicked');
        companyText5.classList.remove('clicked');
        companyText4.classList.remove('clicked');
        companyText2.classList.remove('clicked');
        companyText3.classList.remove('clicked');
        companyText1.classList.remove('clicked');
    });
});