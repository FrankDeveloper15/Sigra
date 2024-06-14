<div class="reloj p-2" id="miReloj">
    <p class="fecha"></p>
    <p class="tiempo"></p>
</div>
<header>
    <div class="container-fluid">
        <div class="navb-logo">
            <a href="menuPrincipal.php"><img src="assets/img/logoSigra.svg" alt="logoSigra"></a>
        </div>
        <div class="navb-items">
            <div class="item-button">
                <a href="login_cliente.php" role="button" class="btn btn-primary button__One me-4">CONTÁCTANOS <img src="assets/img/contactanos.svg" alt="contactanos"></a>
                <a href="login_cliente.php" role="button" class="btn btn-primary button__Two">ÁREA DE CLIENTE <img src="assets/img/cliente.svg" alt="cliente"></a>
            </div>
        </div>

        <!-- Button trigger modal -->
        <div class="mobile-toggler d-lg-none">
            <a href="#" data-bs-toggle="modal" data-bs-target="#navbModal">
                <i class="fa-solid fa-bars"></i>
            </a>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="navbModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-header">
                <div class="modal-content modal-content-header">
                    <div class="modal-header modal-header-header">
                        <a href="menuPrincipal.php" style="color: #fefefe;">CORPORACIÓN VYS PERÚ E.I.R.L.</a>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-x"></i></button>
                    </div>
                    <div class="modal-body modal-body-header">
                        <a href="login_cliente.php" role="button" class="btn btn-primary navb-button button__One me-4">CONTÁCTANOS <img src="assets/img/contactanos.svg" alt="contactanos"></a>
                        <a href="login_cliente.php" role="button" class="btn btn-primary navb-button button__Two">ÁREA DE CLIENTE <img src="assets/img/cliente.svg" alt="cliente"></a>
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