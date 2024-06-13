<?php
require_once("layouts/headAdmin.php");
?>

<body>
    <?php
    require_once("layouts/headerAdmin.php");
    ?>

    <div class="container-fluid p-4">
        <div class="row d-flex justify-content-around g-3">
            <div class="col-lg-3 col-md-6 mb-3 picture">
                <a href="clientes.php">
                    <img src="assets/img/customers.svg" alt="">
                    <span>CLIENTES</span>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-3 picture">
                <a href="servicios.php">
                    <img src="assets/img/services.svg" alt="">
                    <span>SERVICIOS</span>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-3 picture">
                <a href="historialPagos.php">
                    <img src="assets/img/campaign.svg" alt="">
                    <span>NOTIFICACIONES DE PAGOS</span>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-3 picture">
                <a href="accesos.php">
                    <img src="assets/img/access.svg" alt="">
                    <span>ACCESOS</span>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-3 picture">
                <a href="#">
                    <img src="assets/img/access.svg" alt="">
                    <span>ADMINISTRADOR</span>
                </a>
            </div>
        </div>
    </div>
    <?php
    require_once("layouts/footerAdmin.php");
    ?>
</body>

</html>