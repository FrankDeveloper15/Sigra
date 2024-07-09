<?php
$pageTitle = "Facturas Admin";
require_once("layouts/headAdmin.php");
?>

<body>
    <?php
    require_once("Model/FacturasDAO.php");
    $facturas = new Facturas();
    $datosProcesados = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mensajesErrores = "";
        switch ($_POST['tipoEnvio']) {
            case 'insert':
                $facturas->mes = $_POST['mesInsert'];
                $facturas->tipoMoneda = $_POST['tipoMonedaInsert'];
                $facturas->monto = $_POST['montoInsert'];
                $facturas->fechaEmision = $_POST['fechaEmisionInsert'];
                $facturas->fechaVencimiento = $_POST['fechaVencimientoInsert'];
                $facturas->estado = "Pendiente";
                $facturas->documento = "";
                $facturas->reportePago = "";
                $facturas->notificacion = "1";

                $facturas->idClientes = $_POST['idClientesInsert'];

                $mensajesErrores = $facturas->validarFacturas();

                if (count($mensajesErrores) > 0) {
                    $datosProcesados = false;
                } else {
                    try {
                        $facturasDAO = new FacturasDAO();
                        $facturasDAO->insert($facturas);

                        $_SESSION['msj'] = "Se registro la factura correctamente.";
                        $_SESSION['icon'] = "success";
                        $datosProcesados = true;
                    } catch (Exception $e) {
                        $mensajesErrores[] = $e->getMessage();
                        $datosProcesados = false;
                    }
                }
                break;
            case 'edit':
                $facturas->idFacturas = $_POST['idFacturasEdit'];
                $facturas->mes = $_POST['mesEdit'];
                $facturas->tipoMoneda = $_POST['tipoMonedaEdit'];
                $facturas->monto = $_POST['montoEdit'];
                $facturas->fechaEmision = $_POST['fechaEmisionEdit'];
                $facturas->fechaVencimiento = $_POST['fechaVencimientoEdit'];
                $facturas->estado = $_POST['estadoEdit'];
                $facturas->reportePago = $_POST['reportePagoEdit'];

                if (empty($_POST['forFile'])) {
                    $facturas->documento = $_POST['documentoEdit'];
                } else {
                    if (isset($_FILES['documentoEdit']) && $_FILES['documentoEdit']['error'] == UPLOAD_ERR_OK) {
                        $uploadDir = 'Facturas/';
                        $uploadedFileName = basename($_FILES['documentoEdit']['name']);
                        $uploadFilePath = $uploadDir . $uploadedFileName;

                        // Obtener la extensión del archivo
                        $fileExtension = pathinfo($uploadFilePath, PATHINFO_EXTENSION);

                        // Verificar si el archivo es PDF
                        if (strtolower($fileExtension) === 'pdf') {
                            // Mover el archivo a la carpeta de destino
                            if (move_uploaded_file($_FILES['documentoEdit']['tmp_name'], $uploadFilePath)) {
                                $facturas->documento = $uploadedFileName;
                            } else {
                                $mensajesErrores[] = "Error al mover el archivo.";
                            }
                        } else {
                            $mensajesErrores[] = "Solo se permiten archivos PDF.";
                        }
                    } else {
                        $mensajesErrores[] = "Error al subir el archivo.";
                    }
                }

                $facturas->idClientes = $_POST['idClientesEdit'];

                $mensajesErrores = $facturas->validarFacturas();

                if (count($mensajesErrores) > 0) {
                    $datosProcesados = false;
                } else {
                    try {
                        $facturasDAO = new FacturasDAO();
                        $facturasDAO->edit($facturas);

                        $_SESSION['msj'] = "Se edito la factura correctamente.";
                        $_SESSION['icon'] = "success";
                        $datosProcesados = true;
                    } catch (Exception $e) {
                        $mensajesErrores[] = $e->getMessage();
                        $datosProcesados = false;
                    }
                }
                break;
            case 'delete':
                $idFacturas = $_POST['idFacturasDelete'];

                try {
                    $facturasDAO = new FacturasDAO();
                    $facturasDAO->delete($idFacturas);

                    $_SESSION['msj'] = "Se elimino la factura correctamente.";
                    $_SESSION['icon'] = "success";
                    $datosProcesados = true;
                } catch (Exception $e) {
                    $_SESSION['msj'] = "No se puede eliminar la factura ya que esta relacionado con otras tablas.";
                    $_SESSION['icon'] = "error";
                    $datosProcesados = true;
                }
                break;
            default:

                break;
        }

        if (!empty($mensajesErrores)) {
            header("Location: facturasAdmin.php");
            exit();
        }
    } else {
        try {
            $facturasDAO = new FacturasDAO();
            $facturasArray = array();
            $searchClientesFac = array();
            $facturasArray = $facturasDAO->list();
            $searchClientesFac = $facturasDAO->searchClientesFac();
        } catch (Exception $e) {
            $mensajesErrores[] = $e->getMessage();
        }
    }

    ?>

    <?php
    if (!$datosProcesados) {
    ?>
        <?php
        require_once("layouts/headerAdmin.php");
        ?>
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
        <div class="container-fluid p-4">
        <div class="row">
                <div class="col ms-5">
                    <span><strong>FACTURAS:</strong></span>
                </div>
                <div class="col">
                <button type="button" class="btn btn-primary clr-fac" id="agregar-factura" data-bs-toggle="modal" data-bs-target="#modalAgregarFacturas"><i class="fa-solid fa-file-circle-plus"></i>&nbsp; AGREGAR</button>
                </div>
            </div>
        </div>
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
                            <th>Estado</th>
                            <th>Reporte Pago</th>
                            <th>Documento</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($facturasArray as $index => $facturas) { ?>
                            <tr data-id="<?php $index + 1; ?>">
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $facturas->nombre; ?></td>
                                <td><?php echo $facturas->nombreServicios; ?></td>
                                <td><?php echo $facturas->mes; ?></td>
                                <td><?php echo $facturas->tipoMoneda; ?></td>
                                <td><?php echo $facturas->monto; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($facturas->fechaEmision)); ?></td>
                                <td><?php echo date('d-m-Y', strtotime($facturas->fechaVencimiento)); ?></td>
                                <?php if ($facturas->estado == 'Pendiente') { ?>
                                    <td style="color: #cb3234;"><?php echo $facturas->estado; ?></td>
                                <?php } else { ?>
                                    <td style="color: #00913f;"><?php echo $facturas->estado; ?></td>
                                <?php } ?>
                                <?php if (empty($facturas->reportePago)) { ?>
                                    <td></td>
                                <?php } else { ?>
                                    <td>
                                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="ReportePago/<?php echo $facturas->reportePago; ?>">
                                            <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Dowloand
                                        </a>
                                    </td>
                                <?php } ?>
                                <?php if (empty($facturas->documento)) { ?>
                                    <td></td>
                                <?php } else { ?>
                                    <td>
                                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="Facturas/<?php echo $facturas->documento; ?>">
                                            <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver Factura
                                        </a>
                                    </td>
                                <?php } ?>
                                <td>
                                    <button class="btn btn-primary clr-cre" id="edit-facturas" data-bs-target="#modalEditarFacturas-<?php echo $facturas->idFacturas; ?>" data-bs-toggle="modal" style="border-radius: 10px 10px 10px 10px;"><i class="fa-solid fa-pen"></i></button><button class="btn btn-primary clr-so" id="delete-facturas" data-bs-target="#modalEliminarFacturas-<?php echo $facturas->idFacturas; ?>" data-bs-toggle="modal" style="border-radius: 10px 10px 10px 10px;"><i class="fa-solid fa-circle-xmark"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Agregar Facturas -->
        <div class="modal fade" id="modalAgregarFacturas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header title-edit" style="background-color: #5410a2; margin-top: 0px;">
                        <p>AGREGAR FACTURA</p>
                    </div>
                    <div class="modal-body">
                        <div id="alertaErrores" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        </div>
                        <div class="col mb-3 px-3">
                            <form id="form-factura" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="tipoEnvio" value="insert">
                                <input type="hidden" id="forFile" name="forFile">
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-10">
                                        <div class="row">
                                            <label for="idClientesInsert" class="col-auto col-form-label">Clientes:</label>
                                            <div class="col">
                                                <select title="Selecciona Cliente" data-style="btn-secondary" class="form-control form-select selectpicker show-tick" name="idClientesInsert" id="idClientesInsert" data-size="4" data-live-search="true">
                                                    <?php foreach ($searchClientesFac as $clientes) { ?>
                                                        <option value="<?php echo $clientes->idClientes; ?>"><?php echo $clientes->nombre; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label for="mesInsert" class="col-auto col-form-label">Mes:</label>
                                            <div class="col">
                                                <select title="Selecciona Mes" data-style="btn-secondary" class="form-control form-select selectpicker show-tick" name="mesInsert" id="mesInsert" data-size="3" data-live-search="true">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <label for="tipoMonedaInsert" class="col-auto col-form-label">Tipo Moneda:</label>
                                            <div class="col">
                                                <select title="Estado..." data-style="btn-secondary" class="form-control form-select" name="tipoMonedaInsert" id="tipoMonedaInsert">
                                                    <option value="">Seleccionar</option>
                                                    <option value="S/.">S/.</option>
                                                    <option value="$">$</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label for="montoInsert" class="col-auto col-form-label">Monto:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="montoInsert" name="montoInsert">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <label for="fechaEmisionInsert" class="col-auto col-form-label">Fecha Inicio:</label>
                                            <div class="col">
                                                <input readonly type="date" class="form-control" id="fechaEmisionInsert" name="fechaEmisionInsert">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <label for="fechaVencimientoInsert" class="col-auto col-form-label">Fecha Vencimiento:</label>
                                            <div class="col">
                                                <input type="date" class="form-control" id="fechaVencimientoInsert" name="fechaVencimientoInsert">
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
                                            <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarFacturas" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Aceptar</button>
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
        <div class="modal fade" id="modalAceptarFacturas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #5410a2; color: #fff;">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Agregar Factura</h1>
                    </div>
                    <div class="modal-body">
                        La factura sera registrado.
                    </div>
                    <div class="modal-footer row align-items-center p-0">
                        <div class="row d-flex justify-content-end mb-3">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalAgregarFacturas" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" id="btn-aceptar-factura" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php foreach ($facturasArray as $facturas) { ?>
            <!-- Modal Eliminar Factura-->
            <div class="modal fade" id="modalEliminarFacturas-<?php echo $facturas->idFacturas; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="form-delete-facturas-<?php echo $facturas->idFacturas; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="modal-header" style="background-color: #5410a2; color: #fff;">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar la Factura</h1>
                            </div>
                            <div class="modal-body">
                                La factura del cliente <?php echo $facturas->nombre; ?> del servicio <?php echo $facturas->nombreServicios; ?> sera eliminado.
                                <input type="hidden" name="tipoEnvio" value="delete">
                                <input type="hidden" name="idFacturasDelete" value="<?php echo $facturas->idFacturas; ?>">
                            </div>
                            <div class="modal-footer row align-items-center p-0">
                                <div class="row d-flex justify-content-end mb-3">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-secondary cancelar" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary salvar" id="btn-aceptar-delete-facturas-<?php echo $facturas->idFacturas; ?>"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Editar Facturas -->
            <div class="modal fade" id="modalEditarFacturas-<?php echo $facturas->idFacturas; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header title-edit" style="background-color: #5410a2; margin-top: 0px;">
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
                                    <input type="hidden" id="reportePagoEdit-<?php echo $facturas->idFacturas; ?>" name="reportePagoEdit" value="<?php echo $facturas->reportePago; ?>">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-10">
                                            <div class="row">
                                                <label for="idClientesEdit-<?php echo $facturas->idFacturas; ?>" class="col-auto col-form-label">Clientes:</label>
                                                <div class="col">
                                                    <select title="Selecciona Cliente" data-style="btn-secondary" class="form-control" name="idClientesEdit" id="idClientesEdit-<?php echo $facturas->idFacturas; ?>">
                                                        <option value="<?php echo $facturas->idClientes; ?>"><?php echo $facturas->nombre; ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="tipoMonedaEdit-<?php echo $facturas->idFacturas; ?>" class="col-auto col-form-label">Tipo Moneda:</label>
                                                <div class="col">
                                                    <select title="Estado..." data-style="btn-secondary" class="form-control form-select" name="tipoMonedaEdit" id="tipoMonedaEdit-<?php echo $facturas->idFacturas; ?>">
                                                        <option value="">Selecciona Moneda</option>
                                                        <?php $op = ($facturas->tipoMoneda == 'S/.') ? "selected" : ""; ?>
                                                        <option <?php echo $op; ?> value="S/.">S/.</option>
                                                        <?php $op = ($facturas->tipoMoneda == '$') ? "selected" : ""; ?>
                                                        <option <?php echo $op; ?> value="$">$</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <label for="montoEdit-<?php echo $facturas->idFacturas; ?>" class="col-auto col-form-label">Monto:</label>
                                                <div class="col">
                                                    <input readonly type="text" class="form-control" id="montoEdit-<?php echo $facturas->idFacturas; ?>" name="montoEdit" value="<?php echo $facturas->monto; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <label for="fechaEmisionEdit-<?php echo $facturas->idFacturas; ?>" class="col-auto col-form-label">Fecha Inicio:</label>
                                                <div class="col">
                                                    <input readonly type="date" class="form-control" id="fechaEmisionEdit-<?php echo $facturas->idFacturas; ?>" name="fechaEmisionEdit" value="<?php echo $facturas->fechaEmision; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <label for="fechaVencimientoEdit-<?php echo $facturas->idFacturas; ?>" class="col-auto col-form-label">Fecha Vencimiento:</label>
                                                <div class="col">
                                                    <input type="date" class="form-control" id="fechaVencimientoEdit-<?php echo $facturas->idFacturas; ?>" name="fechaVencimientoEdit" value="<?php echo $facturas->fechaVencimiento; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-5">
                                            <div class="row">
                                                <label for="estadoEdit-<?php echo $facturas->idFacturas; ?>" class="col-auto col-form-label">Estado:</label>
                                                <div class="col">
                                                    <select title="Estado..." data-style="btn-secondary" class="form-control form-select" name="estadoEdit" id="estadoEdit-<?php echo $facturas->idFacturas; ?>">
                                                        <option value="">Seleccionar Estado</option>
                                                        <?php $op = ($facturas->estado == 'Pendiente') ? "selected" : ""; ?>
                                                        <option <?php echo $op; ?> value="Pendiente">Pendiente</option>
                                                        <?php $op = ($facturas->estado == 'Pago') ? "selected" : ""; ?>
                                                        <option <?php echo $op; ?> value="Pago">Pago</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="row">
                                                <label for="mesEdit-<?php echo $facturas->idFacturas; ?>" class="col-auto col-form-label">Mes:</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="mesEdit-<?php echo $facturas->idFacturas; ?>" name="mesEdit" value="<?php echo $facturas->mes; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($facturas->estado == "Pago") { ?>
                                        <div class="row align-items-center mb-3">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <label for="documentoEdit-<?php echo $facturas->idFacturas; ?>" class="col-auto col-form-label">Archivo:</label>
                                                    <div class="col">
                                                        <input type="file" class="form-control" id="documentoEdit-<?php echo $facturas->idFacturas; ?>" name="documentoEdit" value="<?php echo $facturas->documento; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="verificarEdit-<?php echo $facturas->idFacturas; ?>" name="verificarEdit" value="new">
                                    <?php } else if ($facturas->estado == "Pendiente") { ?>
                                        <input type="hidden" id="documentoEdit-<?php echo $facturas->idFacturas; ?>" name="documentoEdit" value="<?php echo $facturas->documento; ?>">
                                        <input type="hidden" id="verificarEdit-<?php echo $facturas->idFacturas; ?>" name="verificarEdit" value="">
                                    <?php } ?>
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
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Editar Factura</h1>
                        </div>
                        <div class="modal-body">
                            La factura del cliente <?php echo $facturas->nombre; ?> del servicio <?php echo $facturas->nombreServicios; ?> sera editado.
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
        <!-- Para que aparesca el mes y año en el select -->
        <script>
            const mesSelect = document.getElementById('mesInsert');
            const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];
            const anioActual = new Date().getFullYear();

            meses.forEach((mes, index) => {
                const option = document.createElement('option');
                option.value = mes + '-' + anioActual;
                option.text = mes + ' ' + anioActual;
                mesSelect.appendChild(option);
            });
        </script>
        <!-- Para traer la fecha actual -->
        <script>
            // Obtener la fecha actual
            let today = new Date();
            let day = String(today.getDate()).padStart(2, '0');
            let month = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0
            let year = today.getFullYear();

            // Formatear la fecha en formato Y-m-d para el input
            let formattedDateForInput = `${year}-${month}-${day}`;

            // Establecer el valor del input
            document.getElementById('fechaEmisionInsert').value = formattedDateForInput;
        </script>
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
        <!-- Para validar antes de agregar factura -->
        <script>
            $(document).ready(function() {
                // Evento para el botón de aceptar en modalAgregarContrato
                $('#btn-aceptar-factura').on('click', function(event) {
                    event.preventDefault(); // Prevenir el envío automático del formulario

                    // Validar los campos utilizando el modelo Facturas
                    var mes = $('#mesInsert').val().trim();
                    var tipoMoneda = $('#tipoMonedaInsert').val().trim();
                    var monto = $('#montoInsert').val().trim();
                    var fechaEmision = $('#fechaEmisionInsert').val().trim();
                    var fechaVencimiento = $('#fechaVencimientoInsert').val().trim();
                    var idClientes = $('#idClientesInsert').val().trim();

                    // Validación
                    var mensajesErrores = [];

                    // Función para validar el formato de la fecha
                    function esFechaValida(fecha) {
                        var regex = /^\d{4}-\d{2}-\d{2}$/;
                        if (!fecha.match(regex)) return false; // Formato inválido
                        var d = new Date(fecha);
                        var dNum = d.getTime();
                        if (!dNum && dNum !== 0) return false; // No es una fecha válida
                        return d.toISOString().slice(0, 10) === fecha;
                    }

                    if (!mes) {
                        mensajesErrores.push("El mes no puede estar vacía.");
                    } else if (mes.length > 30) {
                        mensajesErrores.push("El mes no debe de exceder de 30 caracteres.");
                    }

                    if (!tipoMoneda) {
                        mensajesErrores.push("El tipo de moneda no puede estar vacía.");
                    } else if (tipoMoneda.length > 10) {
                        mensajesErrores.push("El tipo de moneda no debe de exceder de 10 caracteres.");
                    }

                    if (!monto) {
                        mensajesErrores.push("El monto no puede estar vacía.");
                    } else if (monto.length > 5) {
                        mensajesErrores.push("El monto no debe de exceder de 5 caracteres.");
                    }

                    if (!fechaEmision) {
                        mensajesErrores.push("La fecha de emisión no puede estar vacía.");
                    } else if (!esFechaValida(fechaEmision)) {
                        mensajesErrores.push("La fecha de emisión debe tener el formato Y-m-d.");
                    }

                    if (!fechaVencimiento) {
                        mensajesErrores.push("La fecha de vencimiento no puede estar vacía.");
                    } else if (!esFechaValida(fechaVencimiento)) {
                        mensajesErrores.push("La fecha de vencimiento debe tener el formato Y-m-d.");
                    }

                    if (!idClientes) {
                        mensajesErrores.push("No selecciono ningun cliente.");
                    } else if (idClientes.length > 6) {
                        mensajesErrores.push("El cliente no debe de exceder de 6 caracteres.");
                    }

                    <?php foreach ($facturasArray as $facturas) { ?>
                        if ((idClientes === '<?php echo $facturas->idClientes; ?>') && (mes === '<?php echo $facturas->mes; ?>')) {
                            mensajesErrores.push("La factura del mes del cliente ya existe.");
                        }
                    <?php } ?>

                    if (mensajesErrores.length > 0) {
                        var alertaErrores = $('#alertaErrores');
                        alertaErrores.css('display', 'block');
                        alertaErrores.html(mensajesErrores.join('<br>'));

                        $('#forFile').val('');
                        $('#modalAceptarFacturas').modal('hide');
                        $('#modalAgregarFacturas').modal('show');
                    } else {
                        // Si no hay errores, verificar si existe duplicidad
                        $('#form-factura').submit(); // Enviar formulario si no hay errores
                    }
                });
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
                        var mes = $('#mesEdit-<?php echo $facturas->idFacturas; ?>').val().trim();
                        var tipoMoneda = $('#tipoMonedaEdit-<?php echo $facturas->idFacturas; ?>').val().trim();
                        var monto = $('#montoEdit-<?php echo $facturas->idFacturas; ?>').val().trim();
                        var fechaEmision = $('#fechaEmisionEdit-<?php echo $facturas->idFacturas; ?>').val().trim();
                        var fechaVencimiento = $('#fechaVencimientoEdit-<?php echo $facturas->idFacturas; ?>').val().trim();
                        var estado = $('#estadoEdit-<?php echo $facturas->idFacturas; ?>').val().trim();
                        var documento = $('#documentoEdit-<?php echo $facturas->idFacturas; ?>').val().trim();
                        var idClientes = $('#idClientesEdit-<?php echo $facturas->idFacturas; ?>').val().trim();
                        var verificarEdit = $('#verificarEdit-<?php echo $facturas->idFacturas; ?>').val().trim();

                        // Validación
                        var mensajesErrores = [];

                        // Función para validar el formato de la fecha
                        function esFechaValida(fecha) {
                            var regex = /^\d{4}-\d{2}-\d{2}$/;
                            if (!fecha.match(regex)) return false; // Formato inválido
                            var d = new Date(fecha);
                            var dNum = d.getTime();
                            if (!dNum && dNum !== 0) return false; // No es una fecha válida
                            return d.toISOString().slice(0, 10) === fecha;
                        }

                        if (!mes) {
                            mensajesErrores.push("El mes no puede estar vacía.");
                        } else if (mes.length > 30) {
                            mensajesErrores.push("El mes no debe de exceder de 30 caracteres.");
                        }

                        if (!tipoMoneda) {
                            mensajesErrores.push("El tipo de moneda no puede estar vacía.");
                        } else if (tipoMoneda.length > 10) {
                            mensajesErrores.push("El tipo de moneda no debe de exceder de 10 caracteres.");
                        }

                        if (!monto) {
                            mensajesErrores.push("El monto no puede estar vacía.");
                        } else if (monto.length > 5) {
                            mensajesErrores.push("El monto no debe de exceder de 5 caracteres.");
                        }

                        if (!fechaEmision) {
                            mensajesErrores.push("La fecha de emisión no puede estar vacía.");
                        } else if (!esFechaValida(fechaEmision)) {
                            mensajesErrores.push("La fecha de emisión debe tener el formato Y-m-d.");
                        }

                        if (!fechaVencimiento) {
                            mensajesErrores.push("La fecha de vencimiento no puede estar vacía.");
                        } else if (!esFechaValida(fechaVencimiento)) {
                            mensajesErrores.push("La fecha de vencimiento debe tener el formato Y-m-d.");
                        }

                        if (!estado) {
                            mensajesErrores.push("No selecciono ningun estado.");
                        } else if (estado.length > 15) {
                            mensajesErrores.push("El tipo de moneda no debe de exceder de 10 caracteres.");
                        }

                        var extension = "";
                        var nombreArchivoInsertado = "";
                        if (!verificarEdit) {
                            $('#forFile-<?php echo $facturas->idFacturas; ?>').val('');
                        } else {
                            // Obtener la extensión del archivo
                            extension = documento.split('.').pop().toLowerCase();

                            if (!documento) {
                                $('#documentoEdit-<?php echo $facturas->idFacturas; ?>').attr('type', 'text');
                                $('#documentoEdit-<?php echo $facturas->idFacturas; ?>').val('<?php echo $facturas->documento; ?>');
                                $('#forFile-<?php echo $facturas->idFacturas; ?>').val('');
                            } else if (extension !== 'pdf') {
                                mensajesErrores.push("El documento debe ser un archivo PDF.");
                            } else {
                                $('#forFile-<?php echo $facturas->idFacturas; ?>').val('new');
                            }

                            // Obtener solo el nombre del archivo del documento insertado
                            nombreArchivoInsertado = documento.split('\\').pop().split('/').pop();
                        }

                        if (!idClientes) {
                            mensajesErrores.push("No selecciono ningun cliente.");
                        } else if (idClientes.length > 6) {
                            mensajesErrores.push("El cliente no debe de exceder de 6 caracteres.");
                        }

                        // Verificación de la existencia de los valores 
                        <?php foreach ($facturasArray as $value) { ?>
                            if (('<?php echo $facturas->idFacturas; ?>' != '<?php echo $value->idFacturas; ?>') && (nombreArchivoInsertado === '<?php echo $value->documento; ?>') && (nombreArchivoInsertado != "")) {
                                mensajesErrores.push("Este archivo ya esta registrado.");
                            }

                            if ('<?php echo $facturas->idFacturas; ?>' != '<?php echo $value->idFacturas; ?>' && ((idClientes === '<?php echo $value->idClientes; ?>') && (mes === '<?php echo $value->mes; ?>'))) {
                                mensajesErrores.push("La factura del mes del cliente ya existe.");
                            }
                        <?php } ?>

                        // Mostrar errores si los hay
                        if (mensajesErrores.length > 0) {
                            var alertaErrores = $('#alertaErroresEditar-<?php echo $facturas->idFacturas; ?>');
                            alertaErrores.css('display', 'block');
                            alertaErrores.html(mensajesErrores.join('<br>'));

                            if (!verificarEdit) {
                                ('#forFile-<?php echo $facturas->idFacturas; ?>').val('');
                            } else {
                                if (!documento) {
                                    $('#documentoEdit-<?php echo $facturas->idFacturas; ?>').attr('type', 'file');
                                    $('#documentoEdit-<?php echo $facturas->idFacturas; ?>').val('');
                                }
                            }

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
        <!-- Para eliminar el factura -->
        <script>
            $(document).ready(function() {
                <?php foreach ($facturasArray as $facturas) { ?>
                    // Evento para el botón de aceptar en modalEliminarFacturas
                    $('#btn-aceptar-delete-facturas-<?php echo $facturas->idFacturas; ?>').on('click', function(event) {
                        event.preventDefault(); // Prevenir el envío automático del formulario

                        $('#form-delete-facturas-<?php echo $facturas->idFacturas; ?>').submit();
                    });
                <?php } ?>
            });
        </script>
    <?php
    } else {
        header("Location: facturasAdmin.php");
    }
    ?>
</body>

</html>