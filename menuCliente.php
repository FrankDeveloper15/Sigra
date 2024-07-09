<?php
require_once("layouts/headCliente.php");
?>

<body>
    <?php
    require_once("Model/ClienteDAO.php");
    $clienteDAO = new ClienteDAO();
    $cliente = new Cliente();
    $cliente = $clienteDAO->infoClientes($_SESSION['idClientes']);
    ?>
    <?php
    require_once("layouts/headerCliente.php");
    ?>
    <main>
        <div class="container-fluid py-sm-3 py-5">
            <div class="row p-5 ">
                <div class="col-12 col-lg-6">
                    <span class="title__info"><i class="fa-solid fa-circle-info"></i>INFORMACIÓN DE LA EMPRESA</span>
                    <div class="info wrap-text">
                        <p><strong>Documento: </strong><?php echo $cliente->tipoDocumento; ?></p>
                        <p><strong>N°: </strong><?php echo $cliente->numDocumento; ?></p>
                        <p><strong>Nombre: </strong><?php echo $cliente->nombre; ?></p>
                        <p><strong>Razon Social: </strong><?php echo $cliente->razonSocial; ?></p>
                        <p><strong>Nombre Comercial: </strong><?php echo $cliente->nombreComercial; ?></p>
                        <p><strong>Telefono: </strong><?php echo $cliente->telefonoContacto; ?></p>
                        <p><strong>Correo: </strong><?php echo $cliente->correoContacto; ?></p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="w-100">
                        <div class="row w-100 mb-3 justify-content-center mt-5">
                            <div class="col-12 col-md-4 d-flex justify-content-center mb-3 mb-md-0">
                                <a href="facturasCliente.php" class="btn btn-primary clr-fac" role="button"><i class="fa-solid fa-file-circle-check"></i> VER FACTURAS</a>
                            </div>
                            <div class="col-12 col-md-4  d-flex justify-content-center mb-3 mb-md-0">
                                <a href="contratosCliente.php" class="btn btn-primary clr-con"><i class="fa-solid fa-file-circle-check"></i> CONTRATO</a>
                            </div>
                            <div class="col-12 col-md-4 d-flex justify-content-center mb-3 mb-md-0">
                                <a href="credencialesCliente.php" class="btn btn-primary clr-cre" role="button"><i class="fa-solid fa-file-import"></i> CREDENCIALES</a>
                            </div>
                        </div>
                        <div class="row w-100 justify-content-center mt-5">
                            <div class="col-md-4 d-flex justify-content-center mb-3 mb-md-0">
                                <a href="reportePagoCliente.php" class="btn btn-primary clr-pa" id="reportarPagoBtn" role="button"><i class="fa-solid fa-file-circle-check"></i> REPORTAR PAGO</a>
                            </div>
                            <div class="col-md-5 d-flex justify-content-center mb-3 mb-md-0">
                                <button id="soporte" class="btn btn-primary clr-so" role="button"><i class="fa-regular fa-circle-question"></i> CONTACTAR A SOPORTE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <?php
    require_once("layouts/footer.php");
    ?>

    <?php require_once("layouts/script.php"); ?>
</body>

</html>