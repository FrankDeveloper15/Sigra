<?php
$pageTitle = "Reporte Pago";
require_once("layouts/headCliente.php");
?>

<body>
    <?php
    require_once("Model/ClienteDAO.php");
    require_once("Model/FacturasDAO.php");
    $facturas = new Facturas();
    $datosProcesados = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mensajesErrores = "";
        switch ($_POST['tipoEnvio']) {
            case 'edit':
                $facturas->idFacturas = $_POST['idFacturasEdit'];

                if (empty($_POST['forFile'])) {
                    $facturas->reportePago = "";
                } else {
                    if (isset($_FILES['reportePagoEdit']) && $_FILES['reportePagoEdit']['error'] == UPLOAD_ERR_OK) {
                        $uploadDir = 'ReportePago/';
                        $uploadedFileName = basename($_FILES['reportePagoEdit']['name']);
                        $uploadFilePath = $uploadDir . $uploadedFileName;

                        // Obtener la extensión del archivo
                        $fileExtension = strtolower(pathinfo($uploadFilePath, PATHINFO_EXTENSION));

                        // Extensiones permitidas
                        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];

                        // Verificar si el archivo es una imagen
                        if (in_array($fileExtension, $allowedExtensions)) {
                            // Mover el archivo a la carpeta de destino
                            if (move_uploaded_file($_FILES['reportePagoEdit']['tmp_name'], $uploadFilePath)) {
                                $facturas->reportePago = $uploadedFileName;
                            } else {
                                $mensajesErrores[] = "Error al mover el archivo.";
                            }
                        } else {
                            $mensajesErrores[] = "Solo se permiten archivos de imagen (jpg, jpeg, png, gif, bmp).";
                        }
                    } else {
                        $mensajesErrores[] = "Error al subir el archivo.";
                    }
                }

                $facturas->notificacion = "0";

                try {
                    $clienteDAO = new ClienteDAO();
                    $clienteDAO->editReportePago($facturas);

                    $_SESSION['msj'] = "Se agrego correctamente el reporte de Pago.";
                    $_SESSION['icon'] = "success";
                    $datosProcesados = true;
                } catch (Exception $e) {
                    $mensajesErrores[] = $e->getMessage();
                    $datosProcesados = false;
                }
                break;
            default:

                break;
        }

        if (!empty($mensajesErrores)) {
            header("Location: reportePagoCliente.php");
            exit();
        }
    } else {
        try {
            $clienteDAO = new ClienteDAO();
            $facturasDAO = new FacturasDAO();
            $facturasArray = array();
            $listFacturas = array();
            $facturasArray = $clienteDAO->infoFacturas($_SESSION['idClientes']);
            $listFactura = $facturasDAO->list();
        } catch (Exception $e) {
            $mensajesErrores[] = $e->getMessage();
        }
    }

    ?>

    <?php
    if (!$datosProcesados) {
    ?>
        <?php
        require_once("layouts/headerCliente.php");
        ?>
        <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded">
            <div class="row table-factura">
                <table class="table table-striped" id="factura">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Servicio</th>
                            <th>Mes</th>
                            <th>Tipo Moneda</th>
                            <th>Monto</th>
                            <th>Fecha Emision</th>
                            <th>Fecha Vencimiento</th>
                            <th>Orden Pago</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($facturasArray as $index => $facturas) { ?>
                            <?php if (($facturas->estado == "Pendiente") && ($facturas->notificacion == "1")) { ?>
                                <tr data-id="<?php $index + 1; ?>">
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $facturas->nombre; ?></td>
                                    <td><?php echo $facturas->nombreServicios; ?></td>
                                    <td><?php echo $facturas->mes; ?></td>
                                    <td><?php echo $facturas->tipoMoneda; ?></td>
                                    <td><?php echo $facturas->monto; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($facturas->fechaEmision)); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($facturas->fechaVencimiento)); ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm d-sm-inline-block download-button" role="button" target="_blank" href="OrdenPago/<?php echo $facturas->ordenPago; ?>">
                                            <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Orden Pago
                                        </a>
                                    </td>
                                    <td style="color: #cb3234;"><?php echo $facturas->estado; ?></td>
                                    <td>
                                        <button class="btn btn-primary clr-cre" id="edit-facturas" data-bs-target="#modalEditarFacturas-<?php echo $facturas->idFacturas; ?>" data-bs-toggle="modal" style="border-radius: 10px 10px 10px 10px;"><i class="fa-solid fa-file-arrow-up"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php foreach ($facturasArray as $facturas) { ?>
            <!-- Modal Editar Facturas -->
            <div class="modal fade" id="modalEditarFacturas-<?php echo $facturas->idFacturas; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header title-edit" style="background-color: #5410a2; margin-top: 0px; color: #fff; font-weight: bold; font-size: 20px;">
                            <p>EDITAR FACTURA</p>
                        </div>
                        <div class="modal-body">
                            <div id="alertaErroresEditar-<?php echo $facturas->idFacturas; ?>" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                            </div>
                            <div id="alertaErrores" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                            </div>
                            <div class="col mb-3 px-3">
                                <form id="form-editar-factura-<?php echo $facturas->idFacturas; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="tipoEnvio" value="edit">
                                    <input type="hidden" id="idFacturasEdit-<?php echo $facturas->idFacturas; ?>" name="idFacturasEdit" value="<?php echo $facturas->idFacturas; ?>">
                                    <input type="hidden" id="forFile-<?php echo $facturas->idFacturas; ?>" name="forFile">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <label for="reportePagoEdit-<?php echo $facturas->idFacturas; ?>" class="col-auto col-form-label">Archivo:</label>
                                                <div class="col">
                                                    <input type="file" class="form-control" id="reportePagoEdit-<?php echo $facturas->idFacturas; ?>" name="reportePagoEdit" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer row align-items-center p-0 pt-2">
                                        <div class="row d-flex justify-content-end mb-3">
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-secondary cancelar" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarEditarFacturas-<?php echo $facturas->idFacturas; ?>" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Aceptar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Aceptar Factura-->
            <div class="modal fade" id="modalAceptarEditarFacturas-<?php echo $facturas->idFacturas; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #5410a2; color: #fff;">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Subir el Archivo</h1>
                        </div>
                        <div class="modal-body">
                            <p>La factura del cliente <?php echo $facturas->nombre; ?> del servicio <?php echo $facturas->nombreServicios; ?> sera subido su reporte de pago.</p>
                            <strong style="color: #cb3234; font-weight: bold;">¡ANTES DE SUBIR EL ARCHIVO VERIFIQUE BIEN QUE ESTA SUBIENDO EL REPORTE DE PAGO!</strong>
                        </div>
                        <div class="modal-footer row align-items-center p-0">
                            <div class="row d-flex justify-content-end mb-3">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalEditarFacturas-<?php echo $facturas->idFacturas; ?>" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" id="btn-aceptar-editar-factura-<?php echo $facturas->idFacturas; ?>" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php
        require_once("layouts/footer.php");
        ?>

        <?php require_once("layouts/script.php"); ?>
        <!-- Para la tabla de factura -->
        <script>
            $('#factura').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar " +
                        `<select class="custom-select custom-select-sm w-50 form-select form-select-sm mb-2">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                    </select>`,
                    "zeroRecords": "No se encontró nada - lo siento",
                    "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ facturas",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "paginate": {
                        "next": ">",
                        "previous": "<"
                    }
                }
            });
        </script>
        <!-- Para validar antes de editar factura -->
        <script>
            $(document).ready(function() {
                <?php foreach ($facturasArray as $facturas) { ?>
                    // Evento para el botón de aceptar en modalEditarFacturas
                    $('#btn-aceptar-editar-factura-<?php echo $facturas->idFacturas; ?>').on('click', function(event) {
                        event.preventDefault(); // Prevenir el envío automático del formulario

                        // Validar los campos utilizando el modelo Facturas
                        var reportePago = $('#reportePagoEdit-<?php echo $facturas->idFacturas; ?>').val().trim();

                        // Validación
                        var mensajesErrores = [];

                        if (!reportePago) {
                            mensajesErrores.push("El archivo no debe estar vacío.");
                        } else {
                            // Obtener solo el nombre del archivo del documento insertado
                            var nombreArchivoInsertado = reportePago.split('\\').pop().split('/').pop();

                            // Obtener la extensión del archivo
                            var fileExtension = nombreArchivoInsertado.split('.').pop().toLowerCase();

                            // Extensiones permitidas
                            var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];

                            // Verificar si el archivo es una imagen
                            if (allowedExtensions.includes(fileExtension)) {
                                // Verificación de la existencia de los valores
                                <?php foreach ($listFactura as $value) { ?>
                                    if ('<?php echo $facturas->idFacturas; ?>' != '<?php echo $value->idFacturas; ?>' && nombreArchivoInsertado === '<?php echo $value->documento; ?>' && nombreArchivoInsertado != "") {
                                        mensajesErrores.push("Este archivo ya está registrado.");
                                    }
                                <?php } ?>
                                $('#forFile-<?php echo $facturas->idFacturas; ?>').val('new');
                            } else {
                                mensajesErrores.push("Solo se permiten archivos de imagen (jpg, jpeg, png, gif, bmp).");
                            }
                        }



                        // Mostrar errores si los hay
                        if (mensajesErrores.length > 0) {
                            var alertaErrores = $('#alertaErroresEditar-<?php echo $facturas->idFacturas; ?>');
                            alertaErrores.css('display', 'block');
                            alertaErrores.html(mensajesErrores.join('<br>'));

                            $('#forFile-<?php echo $facturas->idFacturas; ?>').val('');
                            $('#modalAceptarEditarFacturas-<?php echo $facturas->idFacturas; ?>').modal('hide');
                            $('#modalEditarFacturas-<?php echo $facturas->idFacturas; ?>').modal('show');
                        } else {
                            var alertaErrores = $('#alertaErroresEditar-<?php echo $facturas->idFacturas; ?>');
                            alertaErrores.css('display', 'none');
                            $('#form-editar-factura-<?php echo $facturas->idFacturas; ?>').submit();
                        }
                    });
                <?php } ?>
            });
        </script>
    <?php
    } else {
        header("Location: reportePagoCliente.php");
    }
    ?>
</body>

</html>