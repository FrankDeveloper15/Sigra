<div class="reloj p-2" id="miReloj">
    <p class="fecha"></p>
    <p class="tiempo"></p>
</div>
<div class="container-fluid">
    <a href="menuAdministrador.php"><img src="assets/img/logoSigra.svg" alt="logoSigra" class="img-fluid"></a>
</div>
<header>
    <div class="container-fluid">
        <div class="col-md-3" style="color: #fff;">
            <span class="p-2"><Strong>BIENVENIDO/A:</Strong><?php echo $_SESSION['nombreApellidos']; ?></span>
        </div>
        <div class="navb-items">
            <div class="item">
                <a href="menuAdministrador.php"><i class="fa-solid fa-house-chimney"></i></a>
            </div>
            <div class="item">
                <a href="facturasAdmin.php">FACTURACIÓN</a>
            </div>
            <div class="item">
                <a href="credencialesAdmin.php">CREDENCIALES</a>
            </div>
            <div class="item">
                <a href="contratosAdmin.php">CONTRATO</a>
            </div>
            <div class="item">
                <a href="servicios.php">SERVICIOS</a>
            </div>
            <div class="item">
                <a href="#">SOPORTE</a>
            </div>
            <div class="item">
                <i class="fa-solid fa-bell" id="abrir-notificacion"></i>
            </div>
            <div class="item-button container__button__menu">
                <a href="cerrarSesion.php" class="button__One__menu" id="cerrarSesionBtn" style="padding: 5px;"><i class="fa-solid fa-circle-xmark"></i>CERRAR SESIÓN</a>
            </div>
        </div>

        <!-- Button trigger modal -->
        <div class="mobile-toggler d-lg-none">
            <a href="#" data-bs-toggle="modal" data-bs-target="#navbModal" style="color: #fefefe;">
                <i class="fa-solid fa-bars"></i>
            </a>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="navbModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-header">
                <div class="modal-content modal-content-header">
                    <div class="modal-header modal-header-header">
                        <a href="index.php" style="color: #fefefe;">CORPORACIÓN VYS PERÚ E.I.R.L.</a>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-x"></i></button>
                    </div>
                    <div class="modal-body modal-body-header">
                        <div class="modal-line">
                            <a href="menuAdministrador.php"><i class="fa-solid fa-house-chimney"></i></a>
                        </div>
                        <div class="modal-line">
                            <a href="facturasAdmin.php">FACTURACIÓN</a>
                        </div>
                        <div class="modal-line">
                            <a href="credencialesAdmin.php">CREDENCIALES</a>
                        </div>
                        <div class="modal-line">
                            <a href="contratosAdmin.php">CONTRATO</a>
                        </div>
                        <div class="modal-line">
                            <a href="servicios.php">MIS SERVICIOS</a>
                        </div>
                        <div class="modal-line">
                            <a href="#">SOPORTE</a>
                        </div>
                        <div class="modal-line">
                            <i class="fa-solid fa-bell" id="abrir-notificacion"></i>
                        </div>
                        <div class="container__button__menu">
                            <a href="cerrarSesion.php" class="button__One__menu" id="cerrarSesionBtn" style="padding: 5px;"><i class="fa-solid fa-circle-xmark"></i>CERRAR SESIÓN</a>
                        </div>
                    </div>
                    <div class="mobile-modal-footer">
                        <a target="_blank" href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a target="_blank" href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a target="_blank" href="#"><i class="fa-brands fa-linkedin"></i></a>
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
