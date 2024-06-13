<header>
    <div class="reloj p-2" id="miReloj">
        <p class="fecha"></p>
        <p class="tiempo"></p>
    </div>

    <div class="container-fluid" style="background-color: #fff;">
        <div class="row d-flex justify-content-start container-orden">
            <div class="col-3 p-4 container-logo">
                <a href="menuAdministrador.php"><img src="assets/img/logoSigra.svg" alt="logoSigra" class="img-fluid"></a>
            </div>
            <div class="col-3 menu__hamburguesa">
                <i class="fa-solid fa-bars" id="abrir"></i>
            </div>
            <div class="col-9 container__general" id="container-general">
                <div class="col-md-3 container__closed">
                    <i class="fa-solid fa-circle-xmark" id="cerrar"></i>
                </div>
                <div class="col-12 container-adaptar">
                    <div class="row d-flex justify-content-between align-items-center column-menu">
                        <div class="col-7 pt-4 container-adaptar">
                            <ul class="list__menu">
                                <li class="list__link__menu"><a href="#id-servicios">SERVICIOS</a></li>
                                <li class="list__link__menu"><a href="#id-marca">MARCAS</a></li>
                                <li class="list__link__menu"><a href="#porque-elegirnos">PORQUE ELEGIRNOS</a></li>
                                <li class="list__link__menu"><a href="#id-clientes">CLIENTES</a></li>
                            </ul>
                        </div>
                        <div class="col-5 pt-2 button-container">
                            <a href="login_cliente.php" role="button" class="btn btn-primary button__One me-4" id="cerrarSesionAdmin">CONTÁCTANOS <img src="assets/img/contactanos.svg" alt="contactanos"></a>
                            <a href="login_cliente.php" role="button" class="btn btn-primary button__Two" id="cerrarSesionAdmin">ÁREA DE CLIENTE <img src="assets/img/cliente.svg" alt="cliente"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>