<?php
require_once("layouts/headCliente.php");
?>

<body>
    <?php
    require_once("layouts/headerCliente.php");
    ?>
    <main>
        <div class="container-fluid py-sm-3 py-5">
            <div class="row p-5 ">
                <div class="col-12 col-lg-6">
                    <span class="title__info"><i class="fa-solid fa-circle-info"></i>INFORMACIÓN DE LA EMPRESA</span>
                    <div class="info wrap-text">
                        <p>RUC: 20568757433</p>
                        <p>Razón Social: Constructora y Consultora de la Torre S.A.C.</p>
                        <p>Nombre Comercial: Casa Verde Inmobiliaria</p>
                        <p>Numero de Contacto: 987654321</p>
                        <p>Correo de Contacto: administracion@casaverdeinmobiliaria.com</p>
                        <p>Persona a Cargo: Dina Vallejos</p>
                        <p>Servicio Contratado: Correo corporativo / Pagina web</p>
                        <p>Ciclo de facturación: Ciclo 03</p>
                        <p>Renovación de contrato: 15/05/2024</p>
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
                                <a href="#" class="btn btn-primary clr-so" role="button"><i class="fa-regular fa-circle-question"></i> CONTACTAR A SOPORTE</a>
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