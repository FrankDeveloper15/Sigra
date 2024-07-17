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
            <span class="p-2"><Strong>BIENVENIDO/A:</Strong> <?php echo $_SESSION['nombre']; ?> </span>
        </div>
        <div class="navb-items">
            <div class="item">
                <a href="menuCliente.php"><i class="fa-solid fa-house-chimney"></i></a>
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
    <?php
    require_once("Model/ClienteDAO.php");
    $clienteDAO = new ClienteDAO();
    $facturasArray = array();
    $facturasArray = $clienteDAO->infoFacturas($_SESSION['idClientes']);
    ?>


    <div class="container__notificacion" id="container-notificacion">
        <div class="cabezado__notificacion">
            <i class="fa-solid fa-bell"></i>
            <span>NOTIFICACIONES</span>
            <i class="fa-solid fa-circle-xmark" id="closed-notificacion"></i>
        </div>
        <div class="cuerpo__notificacion">
            <?php foreach ($facturasArray as $facturas) { ?>
                <?php if (($facturas->estado == "Pendiente") && ($facturas->notificacion == "1")) { ?>
                    <div class="part__notificacion">
                        <i class="fa-solid fa-bell"></i>
                        <div class="text__info">
                            <p><?php echo $facturas->nombre; ?></p>
                            <p><?php echo $facturas->nombreServicios; ?></p>
                            <p>Tiene una deuda <?php echo $facturas->estado; ?></p>
                            <p>De <?php echo $facturas->mes; ?> de un monto de <?php echo $facturas->tipoMoneda; ?> <?php echo $facturas->monto; ?></p>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <?php if (isset($_SESSION['msj'])) { ?>
            <script>
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    icon: "<?php echo $_SESSION['icon']; ?>",
                    title: "<?php echo $_SESSION['msj']; ?>",
                    timer: 2500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
            </script>
        <?php
            unset($_SESSION['icon']);
            unset($_SESSION['msj']);
        } ?>
</header>