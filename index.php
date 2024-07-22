<?php
require_once("layouts/head.php");
?>

<body>
    <?php require_once("layouts/header.php"); ?>
    <div class="container-fluid p-0" style="height: auto; min-height: 100vh;">

        <div id="carouselExampleSlidesOnly" class="m-0 p-0 carousel slide" data-bs-ride="carousel" style="width: 100%; height: auto;">

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>

            <div class="carousel-inner" style="width: 100%;">
                <div class="carousel-item active" data-bs-interval="5000">
                    <img src="assets/img/slider01.png" class="d-block w-100" alt="Portada01.png" style="width: 100%;">
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                    <img src="assets/img/slider02.png" class="d-block w-100" alt="Portada02.png" style="width: 100%;">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>


        </div>

        <div class="container-fluid p-0 text-start">
            <div class="row service-title text-center py-2 w-auto" id="id-servicios">
                <h2>NUESTRO SERVICIOS</h2>
            </div>
        </div>

        <div class="container-fluid d-flex justify-content-center p-0 text-center">
            <div class="row justify-content-around align-items-stretch m-2 gy-4 gx-5" style="width: 80%;">
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill text-center">
                        <img src="assets/img/S1.svg" alt="Card 1 Image" class="card-img-top mx-auto">
                        <h3 class="card-title">DESARROLLO DE SOFTWARE/APPS EMPRESARIALES</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill text-center">
                        <img src="assets/img/S3.svg" alt="Card 3 Image" class="card-img-top mx-auto">
                        <h3 class="card-title">SERVICIOS DE CONTACT CENTER-TELEMARKETING Y VENTAS</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill text-center">
                        <img src="assets/img/S4.svg" alt="Card 4 Image" class="card-img-top mx-auto">
                        <h3 class="card-title">SOFTWARE DE GESTIÓN DE COMPAÑÍAS DE SEGURO</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill text-center">
                        <img src="assets/img/S5.svg" alt="Card 5 Image" class="card-img-top mx-auto">
                        <h3 class="card-title">SERVICIOS CONTABLES, FINANCIEROS Y TRIBUTARIOS</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill text-center">
                        <img src="assets/img/S6.svg" alt="Card 6 Image" class="card-img-top mx-auto">
                        <h3 class="card-title">DISEÑO GRÁFICO PROFESIONAL</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill text-center">
                        <img src="assets/img/S7.svg" alt="Card 7 Image" class="card-img-top mx-auto">
                        <h3 class="card-title">SERVICIOS DE BUFFET Y CATERING</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill text-center">
                        <img src="assets/img/S8.svg" alt="Card 8 Image" class="card-img-top mx-auto">
                        <h3 class="card-title">ESTIMULACIÓN TEMPRANA</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill text-center">
                        <img src="assets/img/S9.svg" alt="Card 9 Image" class="card-img-top mx-auto">
                        <h3 class="card-title">ASESORÍA Y CONSULTORÍA EN MARKETING Y REDES SOCIALES</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill text-center">
                        <img src="assets/img/S10.svg" alt="Card 10 Image" class="card-img-top mx-auto">
                        <h3 class="card-title">VENTA DE PRODUCTOS PARA ÓPTICA</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill text-center">
                        <img src="assets/img/S11.svg" alt="Card 11 Image" class="card-img-top mx-auto">
                        <h3 class="card-title">SERVICIO DE CONSTRUCCIÓN EN GENERAL</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill text-center">
                        <img src="assets/img/S12.svg" alt="Card 12 Image" class="card-img-top mx-auto">
                        <h3 class="card-title">SERVICIO DE PANADERÍA Y PASTELERÍA PERSONALIZADA</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid p-0 mt-4">
            <div class="col p-4 marca">
                <p>MARCAS QUE RESPALDAMOS</p>
            </div>
            <div class="col pb-4 marca" id="id-marca">
                <div class="row d-flex justify-content-around marcasIMG">
                    <img class="img-fluid" src="assets/img/CORPORACION V&S.svg" alt="marca 1">
                    <img class="img-fluid" src="assets/img/CONTAC CORPORACION V&S.svg" alt="marca 2">
                    <img class="img-fluid" src="assets/img/SIGRA.svg" alt="marca 3">
                    <img class="img-fluid" src="assets/img/AVS.svg" alt="marca 4">
                    <img class="img-fluid" src="assets/img/N.M_-_ESTUDIO_DE_CONTADORES.png" alt="marca 5">
                </div>
            </div>
        </div>

        <div class="container-fluid p-0">
            <div class="row service-title text-center py-2 w-auto" id="id-servicios">
                <h2>POR QUÉ ELEGIRNOS</h2>
            </div>
        </div>

        <div class="container-fluid p-0">
            <div class="col" style="padding: 50px 0;">
                <div class="row d-flex justify-content-around" id="id-clientes">
                    <div class="col-lg-3 col-md-6 container__card">
                        <span class="num" data-val="5">+ 0</span>
                        <span class="text">AÑOS DE EXPERIENCIA</span>
                    </div>
                    <div class="col-lg-3 col-md-6 container__card">
                        <span class="num" data-val="70">+ 0</span>
                        <span class="text">CLIENTES SATISFECHOS</span>
                    </div>
                    <div class="col-lg-3 col-md-6 container__card">
                        <span class="num" data-val="30">+ 0</span>
                        <span class="text">EMPRESAS ASESORADAS</span>
                    </div>
                    <div class="col-lg-3 col-md-6 container__card">
                        <span class="num" data-val="10">+ 0</span>
                        <span class="text">EMPRESAS AFILIADAS</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid p-0">
            <div class="row service-title text-center py-2 w-auto" id="id-servicios">
                <h2>MARCAS ASESORADAS</h2>
            </div>
        </div>

        <div class="container-fluid p-0">
            <div class="slider w-auto m-0">
                <div class="slide-track">
                    <!-- Los 5 slider -->
                    <div class="slide">
                        <img src="assets/img/M.A - ALHEM Y N&N.png" alt="img-01" class="img-fluid">
                    </div>
                    <div class="slide">
                        <img src="assets/img/M.A - CAMARA Y UGEL.png" alt="img-02" class="img-fluid">
                    </div>
                    <div class="slide">
                        <img src="assets/img/M.A - EDY SÁNCHEZ.png" alt="img-03" class="img-fluid">
                    </div>
                    <div class="slide">
                        <img src="assets/img/M.A - FERRETQUIM.png" alt="img-04" class="img-fluid">
                    </div>
                    <div class="slide">
                        <img src="assets/img/M.A- CASA -VERDE.png" alt="img-06" class="img-fluid">
                    </div>
                    <!-- Los 5 slider repetidos para el efecto continuo -->
                    <div class="slide">
                        <img src="assets/img/M.A - ALHEM Y N&N.png" alt="img-01" class="img-fluid">
                    </div>
                    <div class="slide">
                        <img src="assets/img/M.A - CAMARA Y UGEL.png" alt="img-02" class="img-fluid">
                    </div>
                    <div class="slide">
                        <img src="assets/img/M.A - EDY SÁNCHEZ.png" alt="img-03" class="img-fluid">
                    </div>
                    <div class="slide">
                        <img src="assets/img/M.A - FERRETQUIM.png" alt="img-04" class="img-fluid">
                    </div>
                    <div class="slide">
                        <img src="assets/img/M.A- CASA -VERDE.png" alt="img-06" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php require_once("layouts/footer.php"); ?>
    <script>
        /* Para el conteo de números */

        // tu_archivo.js
        function startCounterAnimation(entries, observer) {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const valueDisplay = entry.target;
                    let startValue = 0;
                    let endValue = parseInt(valueDisplay.getAttribute("data-val"));
                    let duration = 50; // Ajusta la duración según tus necesidades

                    let counter = setInterval(function() {
                        startValue += 1;
                        valueDisplay.textContent = "+ " + startValue;
                        if (startValue === endValue) {
                            clearInterval(counter);
                        }
                    }, duration);

                    observer.unobserve(valueDisplay);
                }
            });
        }

        const observer = new IntersectionObserver(startCounterAnimation, {
            threshold: 0.5
        });

        document.querySelectorAll(".num").forEach((valueDisplay) => {
            observer.observe(valueDisplay);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalLinks = document.querySelectorAll('.modal-link');

            modalLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    var targetId = this.getAttribute('href');
                    var targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        var modal = bootstrap.Modal.getInstance(document.getElementById('navbModal'));
                        modal.hide();

                        // Espera un momento para asegurarte de que el modal se cierre antes de desplazarte
                        setTimeout(function() {
                            targetElement.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }, 500);
                    }
                });
            });
        });
    </script>
    <?php require_once("layouts/script.php"); ?>
</body>