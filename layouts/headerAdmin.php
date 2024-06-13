<header>
    <div class="reloj p-2" id="miReloj">
        <p class="fecha"></p>
        <p class="tiempo"></p>
    </div>
    <div class="container-fluid">
        <a href="menuAdministrador.php"><img src="assets/img/logoSigra.svg" alt="logoSigra" class="img-fluid"></a>
    </div>
    <div class="container-fluid" style="background-color: #5410a2;">
        <div class="row d-flex justify-content-start">
            <div class="col-4 p-4 welcome" style="color: #fff; width: 25%;">
                <span class="p-2"><Strong>BIENVENIDO/A:</Strong><?php echo $_SESSION['nombreApellidos']; ?></span>
            </div>
            <div class="col menu__hamburguesa">
                <i class="fa-solid fa-bars" id="abrir"></i>
            </div>
            <div class="col-8 container__general general__secundario" id="container-general">
                <div class="col-md-3 container__closed">
                    <i class="fa-solid fa-circle-xmark" id="cerrar"></i>
                </div>
                <div class="col p-0 m-0">
                    <div class="row d-flex justify-content-between align-items-center column-menu">
                        <div class="col-10 pt-2">
                            <nav class="container__list__menu">
                                <ul class="list__menu">
                                    <li class="list__link__menu"><a href="menuAdministrador.php"><i class="fa-solid fa-house-chimney"></i></a></li>
                                    <li class="list__link__menu"><a href="facturasAdmin.php">FACTURACIÓN</a></li>
                                    <li class="list__link__menu"><a href="credencialesAdmin.php">CREDENCIALES</a></li>
                                    <li class="list__link__menu"><a href="contratosAdmin.php">CONTRATO</a></li>
                                    <li class="list__link__menu"><a href="servicios.php">MIS SERVICIOS</a></li>
                                    <li class="list__link__menu"><a href="accesos.php">SOPORTE</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-2">
                            <div class="row">
                                <div class="col-1 mb-3 notification" style="width: 1%;">
                                    <i class="fa-solid fa-bell" id="abrir-notificacion"></i>
                                </div>
                                <div class="col-1 mb-3 container__button__menu">
                                    <button class="button__One__menu" id="cerrarSesionAdmin"><i class="fa-solid fa-circle-xmark"></i>CERRAR SESIÓN</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container__notificacion" id="container-notificacion">
        <div class="cabezado__notificacion">
            <i class="fa-solid fa-bell"></i>
            <span>NOTIFICACIONES</span>
            <i class="fa-solid fa-circle-xmark" id="closed-notificacion"></i>
        </div>
        <div class="cuerpo__notificacion">
            <div class="part__notificacion">
                <i class="fa-solid fa-bell"></i>
                <div class="text__info">
                    <p>CONSTRUCTORA Y CONSULTORA DE LA TORRE S.A.C.</p>
                    <p>Reporto nuevo pago - Jue. 15 de febrero, 2024 09:35 a.m.</p>
                    <p>Factura del mes de Febrero 2024</p>
                    <p>Monto: S/. 37.90</p>
                </div>
            </div>
            <div class="part__notificacion">
                <i class="fa-solid fa-bell"></i>
                <div class="text__info">
                    <p>CAMARA DE COMERCIO HUANCAYO S.A.C.</p>
                    <p>Reporto nuevo pago - Mie. 14 de febrero, 2024 12:45 p.m.</p>
                    <p>Factura del mes de Febrero 2024</p>
                    <p>Monto: S/. 3754.90</p>
                </div>
            </div>
            <div class="part__notificacion">
                <i class="fa-solid fa-bell"></i>
                <div class="text__info">
                    <p>R&M CARD S.A.C.</p>
                    <p>Reporto nuevo pago - Lun. 12 de febrero, 2024 13:20 p.m.</p>
                    <p>Factura del mes de Febrero 2024</p>
                    <p>Monto: S/. 750.90</p>
                </div>
            </div>
        </div>
    </div>
</header>