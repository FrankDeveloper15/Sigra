<div class="reloj p-2" id="miReloj">
    <p class="fecha"></p>
    <p class="tiempo"></p>
</div>
<div class="container-fluid">
    <a href="menuAdministrador.php"><img src="assets/img/logoSigra.svg" alt="logoSigra" class="img-fluid"></a>
</div>
<header>
    <div class="container-fluid">
        <div class="col-md-6" style="color: #fff;">
            <span class="p-2"><Strong>BIENVENIDO/A:</Strong> <?php echo $_SESSION['nombreComercial']; ?> </span>
        </div>
        <div class="navb-items">
            <div class="item">
                <a href="menuCliente.php"><i class="fa-solid fa-house-chimney"></i></a>
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
                            <a href="menuCliente.php"><i class="fa-solid fa-house-chimney"></i></a>
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
</header>