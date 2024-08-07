<?php
$pageTitle = "Clientes Admin";
require_once("layouts/headAdmin.php");
?>

<body>
    <?php
    require_once("Model/ClienteDAO.php");
    $clientes = new Cliente();
    $datosProcesados = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mensajesErrores = "";
        switch ($_POST['tipoEnvio']) {
            case 'insert':
                $clientes->tipoDocumento = $_POST['tipoDocumentoInsert'];
                $clientes->numDocumento = $_POST['numDocumentoInsert'];
                $clientes->nombre = $_POST['nombreInsert'];
                $clientes->razonSocial = $_POST['razonSocialInsert'];
                $clientes->nombreComercial = $_POST['nombreComercialInsert'];
                $clientes->telefonoContacto = $_POST['telefonoContactoInsert'];
                $clientes->correoContacto = $_POST['correoContactoInsert'];
                $clientes->contrasenia = $_POST['contraseniaInsert'];

                $mensajesErrores = $clientes->validarCliente();

                if (count($mensajesErrores) > 0) {
                    $datosProcesados = false;
                } else {
                    try {
                        $clientesDAO = new ClienteDAO();
                        $clientesDAO->insert($clientes);

                        $_SESSION['msj'] = "Se registro el cliente correctamente.";
                        $_SESSION['icon'] = "success";
                        $datosProcesados = true;
                    } catch (Exception $e) {
                        $mensajesErrores[] = $e->getMessage();
                        $datosProcesados = false;
                    }
                }
                break;
            case 'edit':
                $clientes->idClientes = $_POST['idClienteEdit'];
                $clientes->tipoDocumento = $_POST['tipoDocumentoEdit'];
                $clientes->numDocumento = $_POST['numDocumentoEdit'];
                $clientes->nombre = $_POST['nombreEdit'];
                $clientes->razonSocial = $_POST['razonSocialEdit'];
                $clientes->nombreComercial = $_POST['nombreComercialEdit'];
                $clientes->telefonoContacto = $_POST['telefonoContactoEdit'];
                $clientes->correoContacto = $_POST['correoContactoEdit'];
                $clientes->contrasenia = $_POST['contraseniaEdit'];
                $clientes->forPassword = $_POST['forPassword'];

                $mensajesErrores = $clientes->validarCliente();

                if (count($mensajesErrores) > 0) {
                    $datosProcesados = false;
                } else {
                    try {
                        $clientesDAO = new ClienteDAO();
                        $clientesDAO->edit($clientes);

                        $_SESSION['msj'] = "Se edito el cliente correctamente.";
                        $_SESSION['icon'] = "success";
                        $datosProcesados = true;
                    } catch (Exception $e) {
                        $mensajesErrores[] = $e->getMessage();
                        $datosProcesados = false;
                    }
                }
                break;
            case 'delete':
                $idCliente = $_POST['idClienteDelete'];

                try {
                    $clientesDAO = new ClienteDAO();
                    $clientesDAO->delete($idCliente);

                    $_SESSION['msj'] = "Se elimino el cliente correctamente.";
                    $_SESSION['icon'] = "success";
                    $datosProcesados = true;
                } catch (Exception $e) {
                    $_SESSION['msj'] = "No se puede eliminar el cliente ya que esta relacionado con otras tablas.";
                    $_SESSION['icon'] = "error";
                    $datosProcesados = true;
                }
                break;
            default:

                break;
        }

        if (!empty($mensajesErrores)) {
            header("Location: clientes.php");
            exit();
        }
    } else {
        try {
            $clientesDAO = new ClienteDAO();
            $clientesArray = array();
            $clientesArray = $clientesDAO->list();
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
        <div class="container-fluid py-4">
            <div class="row d-flex align-items-center">
                <div class="col-auto title-clientes">
                    <span>CLIENTES</span>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary w-auto btn-clientes" id="agregar-cliente" data-bs-toggle="modal" data-bs-target="#modalAgregarCliente"><i class="fa-solid fa-file-circle-plus"></i> AGREGAR</button>
                </div>
            </div>
        </div>
        <!-- Modal Agregar Cliente -->
        <div class="modal fade" id="modalAgregarCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header title-edit" style="background-color: #5410a2; margin-top: 0px;">
                        <p>AGREGAR CLIENTE</p>
                    </div>
                    <div class="modal-body">
                        <div id="alertaBusqueda" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        </div>
                        <div id="alertaErrores" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        </div>
                        <div class="container-fluid">
                            <div class="col mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label for="tipoDoc" class="col-auto col-form-label">Tipo de Doc:</label>
                                            <div class="col">
                                                <select title="Estado..." data-style="btn-secondary" class="form-control form-select" name="tipoDoc" id="tipoDoc">
                                                    <option value="DNI">DNI</option>
                                                    <option value="RUC">RUC</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label for="documento" class="col-auto col-form-label">N° Doc:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="documento" name="documento" minlength="8" maxlength="11">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" id="consultaReniec" class="btn btn-primary w-auto validar"><i class="fa-solid fa-circle-check"></i>&nbsp; VALIDAR</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-3" style="background-color: #5410a2; color: #fff;">
                                <div class="col p-2">
                                    <span>DATOS BUSCADOS</span>
                                </div>
                            </div>
                            <div class="col mb-3 px-3">
                                <form id="form-cliente" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <input type="hidden" name="tipoEnvio" value="insert">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-5">
                                            <div class="row">
                                                <label for="tipoDocumentoInsert" class="col-auto col-form-label">Tipo de Doc:</label>
                                                <div class="col">
                                                    <input readonly type="text" class="form-control" id="tipoDocumentoInsert" name="tipoDocumentoInsert">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <label for="numDocumentoInsert" class="col-auto col-form-label">N° Doc:</label>
                                                <div class="col">
                                                    <input readonly type="text" class="form-control" id="numDocumentoInsert" name="numDocumentoInsert" minlength="8" maxlength="11">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <label for="nombreInsert" class="col-auto col-form-label">Nombre:</label>
                                                <div class="col">
                                                    <input readonly type="text" class="form-control" id="nombreInsert" name="nombreInsert">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <label for="razonSocialInsert" class="col-auto col-form-label">Razon Social:</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="razonSocialInsert" name="razonSocialInsert">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <label for="nombreComercialInsert" class="col-auto col-form-label">Nombre Comercial:</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="nombreComercialInsert" name="nombreComercialInsert">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-5">
                                            <div class="row">
                                                <label for="telefonoContactoInsert" class="col-auto col-form-label">Telefono Contacto:</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="telefonoContactoInsert" name="telefonoContactoInsert" minlength="9" maxlength="9">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <label for="correoContactoInsert" class="col-auto col-form-label">Correo Contacto:</label>
                                                <div class="col">
                                                    <input type="email" class="form-control" id="correoContactoInsert" name="correoContactoInsert">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="contraseniaInsert" class="col-auto col-form-label">Contraseña:</label>
                                                <div class="col input-group">
                                                    <input type="password" class="form-control" id="contraseniaInsert" name="contraseniaInsert">
                                                    <button class="input-group-text" type="button" id="seePasswordInsert">
                                                        <i class="fa-solid fa-eye-slash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer row align-items-center p-0 pt-2">
                                        <div class="row d-flex justify-content-end">
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-secondary cancelar" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary salvar" id="guardar-cliente" data-bs-toggle="modal" data-bs-target="#modalAceptarCliente"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Aceptar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Aceptar Cliente-->
        <div class="modal fade" id="modalAceptarCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #5410a2; color: #fff;">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Agregar Cliente</h1>
                    </div>
                    <div class="modal-body">
                        El cliente sera registrado.
                    </div>
                    <div class="modal-footer row align-items-center p-0">
                        <div class="row d-flex justify-content-end">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalAgregarCliente" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" id="btn-aceptar-cliente" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de clientes -->
        <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded">
            <div class="row table-cliente">
                <table class="table table-striped" id="clientes">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>TIPO DOCUMENTO</th>
                            <th>NÚMERO DOCUMENTO</th>
                            <th>NOMBRE</th>
                            <th>TELEFONO</th>
                            <th>CORREO</th>
                            <th>ACCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientesArray as $index => $clientes) { ?>
                            <tr data-id="<?php $index + 1; ?>">
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $clientes->tipoDocumento; ?></td>
                                <td><?php echo $clientes->numDocumento; ?></td>
                                <td><?php echo $clientes->nombre; ?></td>
                                <td><?php echo $clientes->telefonoContacto; ?></td>
                                <td><?php echo $clientes->correoContacto; ?></td>
                                <td>
                                    <button class="button__administrar" id="id-administrar-<?php echo $clientes->idClientes; ?>"><i class="fa-solid fa-file-circle-plus"></i> ADMINISTRAR</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php foreach ($clientesArray as $index => $clientes) { ?>
            <?php
            $cliente2DAO = new ClienteDAO();
            $tablaFacturas = array();
            $tablaFacturas = $cliente2DAO->infoFacturas($clientes->idClientes);
            $tablaCredenciales = array();
            $tablaCredenciales = $cliente2DAO->infoCredenciales($clientes->idClientes);
            $tablaContrato = array();
            $tablaContrato = $cliente2DAO->infoContrato($clientes->idClientes);
            ?>
            <div class="container__desplegar" id="containerDesplegar-<?php echo $clientes->idClientes; ?>">
                <div class="cabezado__desplegar">
                    <i class="fa-solid fa-circle-user"></i>
                    <span>CONSTRUCTORA Y CONSULTORIA DE LA TORRE S.A.C.</span>
                    <i class="fa-solid fa-circle-xmark closed" id="closed-administrar-<?php echo $clientes->idClientes; ?>"></i>
                </div>
                <div class="menu__desplegable">
                    <span id="datos-generales-<?php echo $clientes->idClientes; ?>"><i class="fa-solid fa-house"></i>DATOS GENERALES</span>
                    <span id="editar-perfil-<?php echo $clientes->idClientes; ?>"><i class="fa-solid fa-marker"></i>EDITAR PERFIL</span>
                    <span id="historial-pagos-<?php echo $clientes->idClientes; ?>"><i class="fa-solid fa-file-lines"></i>FACTURAS</span>
                    <span id="accesos-<?php echo $clientes->idClientes; ?>"><i class="fa-solid fa-file-circle-check"></i>CREDENCIALES</span>
                    <span id="contrato-<?php echo $clientes->idClientes; ?>"><i class="fa-solid fa-file-circle-check"></i>CONTRATO</span>
                </div>

                <!-- ======================== APARTADO DE CLIENTES ================ -->
                <div class="cuerpo__general" id="cuerpo-general1-<?php echo $clientes->idClientes; ?>">
                    <div class="datos__generales">
                        <div class="general__info">
                            <span class="title__general"><i class="fa-solid fa-circle-info"></i>INFORMACIÓN DE LA EMPRESA</span>
                            <div class="part__general">
                                <p><strong>Documento: </strong><?php echo $clientes->tipoDocumento; ?></p>
                                <p><strong>N°: </strong><?php echo $clientes->numDocumento; ?></p>
                                <p><strong>Nombre: </strong><?php echo $clientes->nombre; ?></p>
                                <p><strong>Razon Social: </strong><?php echo $clientes->razonSocial; ?></p>
                                <p><strong>Nombre Comercial: </strong><?php echo $clientes->nombreComercial; ?></p>
                                <p><strong>Telefono: </strong><?php echo $clientes->telefonoContacto; ?></p>
                                <p><strong>Correo: </strong><?php echo $clientes->correoContacto; ?></p>
                            </div>
                        </div>
                        <div class="button__general">
                            <div class="eliminar">
                                <i class="fa-solid fa-trash" role="button" data-bs-toggle="modal" data-bs-target="#modalEliminarCliente-<?php echo $clientes->idClientes; ?>"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ======================== APARTADO DE EDITAR PERFIL ================ -->
                <div class="cuerpo__general2" id="cuerpo-general2-<?php echo $clientes->idClientes; ?>">
                    <div class="container-fluid">
                        <div class="col title-edit" style="background-color: #5410a2;">
                            <p>EDITAR PERFIL</p>
                        </div>
                    </div>
                    <div class="restablecer__contrasenia">
                        <div class="contrasenia__general">
                            <div class="title__contrasenia">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                <p>RECUERDE QUE AL REALIZAR LA MODIFICACION DE CUALQUIER DATO PERSONAL O DE ACCESO DE UN USUARIO NO OLVIDE COMUNICARLO AL USUARIO PARA MAYOR INFORMACIÓN ESCRIBIR AL WHATSAPP - 984404105</p>
                            </div>
                        </div>
                    </div>
                    <div id="alertaErroresEditar-<?php echo $clientes->idClientes; ?>" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    </div>
                    <div class="container-fluid">
                        <div class="col mb-3 px-3">
                            <form id="form-editar-cliente-<?php echo $clientes->idClientes; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <input type="hidden" name="tipoEnvio" value="edit">
                                <input type="hidden" id="idClienteEdit-<?php echo $clientes->idClientes; ?>" name="idClienteEdit" value="<?php echo $clientes->idClientes; ?>">
                                <input type="hidden" id="forPassword-<?php echo $clientes->idClientes; ?>" name="forPassword">
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label for="tipoDocumentoEdit-<?php echo $clientes->idClientes; ?>" class="col-auto col-form-label">Tipo de Doc:</label>
                                            <div class="col">
                                                <input readonly type="text" class="form-control" id="tipoDocumentoEdit-<?php echo $clientes->idClientes; ?>" name="tipoDocumentoEdit" value="<?php echo $clientes->tipoDocumento; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label for="numDocumentoEdit-<?php echo $clientes->idClientes; ?>" class="col-auto col-form-label">N° Doc:</label>
                                            <div class="col">
                                                <input readonly type="text" class="form-control" id="numDocumentoEdit-<?php echo $clientes->idClientes; ?>" name="numDocumentoEdit" value="<?php echo $clientes->numDocumento; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <label for="nombreEdit-<?php echo $clientes->idClientes; ?>" class="col-auto col-form-label">Nombre:</label>
                                            <div class="col">
                                                <input readonly type="text" class="form-control" id="nombreEdit-<?php echo $clientes->idClientes; ?>" name="nombreEdit" value="<?php echo $clientes->nombre; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <label for="razonSocialEdit-<?php echo $clientes->idClientes; ?>" class="col-auto col-form-label">Razon Social:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="razonSocialEdit-<?php echo $clientes->idClientes; ?>" name="razonSocialEdit" value="<?php echo $clientes->razonSocial; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <label for="nombreComercialEdit-<?php echo $clientes->idClientes; ?>" class="col-auto col-form-label">Nombre Comercial:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="nombreComercialEdit-<?php echo $clientes->idClientes; ?>" name="nombreComercialEdit" value="<?php echo $clientes->nombreComercial; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-5">
                                        <div class="row">
                                            <label for="telefonoContactoEdit-<?php echo $clientes->idClientes; ?>" class="col-auto col-form-label">Telefono Contacto:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="telefonoContactoEdit-<?php echo $clientes->idClientes; ?>" name="telefonoContactoEdit" value="<?php echo $clientes->telefonoContacto; ?>" minlength="9" maxlength="9">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row">
                                            <label for="correoContactoEdit-<?php echo $clientes->idClientes; ?>" class="col-auto col-form-label">Correo Contacto:</label>
                                            <div class="col">
                                                <input type="email" class="form-control" id="correoContactoEdit-<?php echo $clientes->idClientes; ?>" name="correoContactoEdit" value="<?php echo $clientes->correoContacto; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label for="contraseniaEdit-<?php echo $clientes->idClientes; ?>" class="col-auto col-form-label">Contraseña:</label>
                                            <div class="col input-group">
                                                <input type="password" class="form-control" id="contraseniaEdit-<?php echo $clientes->idClientes; ?>" name="contraseniaEdit">
                                                <button class="input-group-text" type="button" id="seePasswordEdit-<?php echo $clientes->idClientes; ?>">
                                                    <i class="fa-solid fa-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="row d-flex justify-content-end">
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarEditarCliente-<?php echo $clientes->idClientes; ?>" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Aceptar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- ======================== APARTADO DE FACTURAS ================ -->
                <div class="cuerpo__general3" id="cuerpo-general3-<?php echo $clientes->idClientes; ?>">
                    <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded" style="width: 90%; max-height: 400px;">
                        <div class="row table-factura">
                            <table class="table table-striped" id="facturas-<?php echo $clientes->idClientes; ?>">
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
                                        <th>Reporte Pago</th>
                                        <th>Documento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tablaFacturas as $index2 => $facturas) { ?>
                                        <tr data-id="<?php $index2 + 1; ?>">
                                            <td><?php echo $index2 + 1; ?></td>
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
                                            <?php if ($facturas->estado == 'Pendiente') { ?>
                                                <td style="color: #cb3234;"><?php echo $facturas->estado; ?></td>
                                                <td></td>
                                                <td></td>
                                            <?php } else { ?>
                                                <td style="color: #00913f;"><?php echo $facturas->estado; ?></td>
                                                <?php if (empty($facturas->reportePago)) { ?>
                                                    <td></td>
                                                <?php } else { ?>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="Facturas/<?php echo $facturas->documento; ?>">
                                                            <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver Factura
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

                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ======================== APARTADO DE CREDENCIALES ================ -->
                <div class="cuerpo__general4" id="cuerpo-general4-<?php echo $clientes->idClientes; ?>">
                    <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded">
                        <div class="row table-credenciales">
                            <table class="table table-striped" id="credenciales-<?php echo $clientes->idClientes; ?>">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cliente</th>
                                        <th>Servicio</th>
                                        <th>Usuario</th>
                                        <th>Contraseña</th>
                                        <th>Observacion</th>
                                        <th>Link de Acceso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tablaCredenciales as $index3 => $credenciales) { ?>
                                        <tr data-id="<?php $index3 + 1; ?>">
                                            <td><?php echo $index3 + 1; ?></td>
                                            <td><?php echo $credenciales->nombre; ?></td>
                                            <td><?php echo $credenciales->nombreServicios; ?></td>
                                            <td><?php echo $credenciales->usuario; ?></td>
                                            <td><?php echo $credenciales->contrasenia; ?></td>
                                            <td><?php echo $credenciales->observacion; ?></td>
                                            <td><?php echo $credenciales->linkAcceso; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ======================== APARTADO DE CONTRATO ================ -->
                <div class="cuerpo__general5" id="cuerpo-general5-<?php echo $clientes->idClientes; ?>">
                    <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded">
                        <div class="row table-contrato">
                            <table class="table table-striped" id="contratos-<?php echo $clientes->idClientes; ?>">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cliente</th>
                                        <th>Servicio</th>
                                        <th>Administrador</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Renovación</th>
                                        <th>Contrato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tablaContrato as $index4 => $contrato) { ?>
                                        <tr data-id="<?php $index4 + 1; ?>">
                                            <td><?php echo $index4 + 1; ?></td>
                                            <td><?php echo $contrato->nombre; ?></td>
                                            <td><?php echo $contrato->nombreServicios; ?></td>
                                            <td><?php echo $contrato->nombreApellidos; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($contrato->fechaInicio)); ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($contrato->fechaRenovacion)); ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-sm d-sm-inline-block download-button" role="button" target="_blank" href="File/<?php echo $contrato->documento; ?>">
                                                    <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver Contrato
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Eliminar Cliente-->
            <div class="modal fade" id="modalEliminarCliente-<?php echo $clientes->idClientes; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="form-delete-cliente-<?php echo $clientes->idClientes; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="modal-header" style="background-color: #ff0000; color: #fff;">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar Cliente</h1>
                            </div>
                            <div class="modal-body">
                                El cliente <?php echo $clientes->nombre; ?> sera eliminado.
                                <input type="hidden" name="tipoEnvio" value="delete">
                                <input type="hidden" name="idClienteDelete" value="<?php echo $clientes->idClientes; ?>">
                            </div>
                            <div class="modal-footer row align-items-center p-0">
                                <div class="row d-flex justify-content-end mb-3">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-secondary cancelar" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" id="btn-aceptar-delete-cliente-<?php echo $clientes->idClientes; ?>" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Aceptar Editar Clientes -->
            <div class="modal fade" id="modalAceptarEditarCliente-<?php echo $clientes->idClientes; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #106da2; color: #fff;">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Editar Este Cliente</h1>
                        </div>
                        <div class="modal-body">
                            El cliente <?php echo $clientes->nombre; ?> será editado.
                        </div>
                        <div class="modal-footer row align-items-center p-0">
                            <div class="row d-flex justify-content-end mb-3">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-secondary cancelar" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" id="btn-aceptar-editar-cliente-<?php echo $clientes->idClientes; ?>" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
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
        <!-- SCRIPT PARA QUE SE HABRA EL MODAL DE ADMINISTRAR -->
        <script>
            $(document).ready(function() {
                <?php foreach ($clientesArray as $clientes) { ?>
                    $('#id-administrar-<?php echo $clientes->idClientes; ?>').on('click', function(event) {

                        var containerDesplegar = $('#containerDesplegar-<?php echo $clientes->idClientes; ?>');
                        var closedAdministrar = $('#closed-administrar-<?php echo $clientes->idClientes; ?>');
                        var cuerpoGeneral1 = $('#cuerpo-general1-<?php echo $clientes->idClientes; ?>');
                        var cuerpoGeneral2 = $('#cuerpo-general2-<?php echo $clientes->idClientes; ?>');
                        var cuerpoGeneral3 = $('#cuerpo-general3-<?php echo $clientes->idClientes; ?>');
                        var cuerpoGeneral4 = $('#cuerpo-general4-<?php echo $clientes->idClientes; ?>');
                        var cuerpoGeneral5 = $('#cuerpo-general5-<?php echo $clientes->idClientes; ?>');
                        var companyText1 = $('#datos-generales-<?php echo $clientes->idClientes; ?>');
                        var companyText2 = $('#editar-perfil-<?php echo $clientes->idClientes; ?>');
                        var companyText3 = $('#historial-pagos-<?php echo $clientes->idClientes; ?>');
                        var companyText4 = $('#accesos-<?php echo $clientes->idClientes; ?>');
                        var companyText5 = $('#contrato-<?php echo $clientes->idClientes; ?>');

                        companyText1.addClass('clicked');

                        containerDesplegar.show();
                        cuerpoGeneral1.show();
                        containerDesplegar.removeClass('cerrado');

                        closedAdministrar.on('click', function() {
                            containerDesplegar.addClass('cerrado');
                            setTimeout(function() {
                                containerDesplegar.hide();
                                cuerpoGeneral2.hide();
                                cuerpoGeneral3.hide();
                                cuerpoGeneral4.hide();
                                cuerpoGeneral5.hide();
                                companyText1.addClass('clicked');
                                companyText2.removeClass('clicked');
                                companyText3.removeClass('clicked');
                                companyText4.removeClass('clicked');
                                companyText5.removeClass('clicked');
                            }, 250);
                        });

                        companyText1.on('click', function() {
                            cuerpoGeneral1.show();
                            cuerpoGeneral2.hide();
                            cuerpoGeneral3.hide();
                            cuerpoGeneral4.hide();
                            cuerpoGeneral5.hide();
                            companyText1.addClass('clicked');
                            companyText2.removeClass('clicked');
                            companyText3.removeClass('clicked');
                            companyText4.removeClass('clicked');
                            companyText5.removeClass('clicked');
                        });

                        companyText2.on('click', function() {
                            cuerpoGeneral2.show();
                            cuerpoGeneral1.hide();
                            cuerpoGeneral3.hide();
                            cuerpoGeneral4.hide();
                            cuerpoGeneral5.hide();
                            companyText2.addClass('clicked');
                            companyText1.removeClass('clicked');
                            companyText3.removeClass('clicked');
                            companyText4.removeClass('clicked');
                            companyText5.removeClass('clicked');
                        });

                        companyText3.on('click', function() {
                            cuerpoGeneral3.show();
                            cuerpoGeneral1.hide();
                            cuerpoGeneral2.hide();
                            cuerpoGeneral4.hide();
                            cuerpoGeneral5.hide();
                            companyText3.addClass('clicked');
                            companyText1.removeClass('clicked');
                            companyText2.removeClass('clicked');
                            companyText4.removeClass('clicked');
                            companyText5.removeClass('clicked');
                        });

                        companyText4.on('click', function() {
                            cuerpoGeneral4.show();
                            cuerpoGeneral1.hide();
                            cuerpoGeneral2.hide();
                            cuerpoGeneral3.hide();
                            cuerpoGeneral5.hide();
                            companyText4.addClass('clicked');
                            companyText1.removeClass('clicked');
                            companyText2.removeClass('clicked');
                            companyText3.removeClass('clicked');
                            companyText5.removeClass('clicked');
                        });

                        companyText5.on('click', function() {
                            cuerpoGeneral5.show();
                            cuerpoGeneral1.hide();
                            cuerpoGeneral2.hide();
                            cuerpoGeneral3.hide();
                            cuerpoGeneral4.hide();
                            companyText5.addClass('clicked');
                            companyText1.removeClass('clicked');
                            companyText2.removeClass('clicked');
                            companyText3.removeClass('clicked');
                            companyText4.removeClass('clicked');
                        });
                    });
                <?php } ?>
            });
        </script>
        <!-- PARA QUE SE VEA O OCULTE LA CONTRASEÑA -->
        <script>
            /* Visibilidada de contraseña Insertar*/
            document.getElementById('seePasswordInsert').addEventListener('click', function() {
                const passwordInsert = document.getElementById('contraseniaInsert');
                const icon = this.querySelector('i');
                if (passwordInsert.type === 'password') {
                    passwordInsert.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    passwordInsert.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
            /* Visibilidada de contraseña Editar*/
            <?php foreach ($clientesArray as $clientes) { ?>
                document.getElementById('seePasswordEdit-<?php echo $clientes->idClientes; ?>').addEventListener('click', function() {
                    const passwordEdit = document.getElementById('contraseniaEdit-<?php echo $clientes->idClientes; ?>');
                    const icon = this.querySelector('i');
                    if (passwordEdit.type === 'password') {
                        passwordEdit.type = 'text';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    } else {
                        passwordEdit.type = 'password';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    }
                });
            <?php } ?>
        </script>
        <!-- PARA QUE SE BUSQUE EL DNI O RUC -->
        <script>
            // Función para realizar la búsqueda y validación
            function buscarDNI() {
                var tipoDoc = $("#tipoDoc").val();
                var documento = $("#documento").val();
                var alertaBusqueda = $('#alertaBusqueda');
                var alertaErrores = $('#alertaErrores');

                // Limpiar mensajes de alerta
                alertaBusqueda.css('display', 'none');

                // Validar tipo de documento y longitud
                if (tipoDoc == "DNI") {
                    if (!documento.trim()) {
                        alertaBusqueda.css('display', 'block');
                        alertaErrores.css('display', 'none');
                        alertaBusqueda.html('Por favor, ingrese el DNI a buscar');
                        return;
                    } else if (documento.length !== 8) {
                        alertaBusqueda.css('display', 'block');
                        alertaErrores.css('display', 'none');
                        alertaBusqueda.html('El DNI debe tener 8 dígitos');
                        return;
                    }
                } else if (tipoDoc == "RUC") {
                    if (!documento.trim()) {
                        alertaBusqueda.css('display', 'block');
                        alertaErrores.css('display', 'none');
                        alertaBusqueda.html('Por favor, ingrese el RUC a buscar');
                        return;
                    } else if (documento.length !== 11) {
                        alertaBusqueda.css('display', 'block');
                        alertaErrores.css('display', 'none');
                        alertaBusqueda.html('El RUC debe tener 11 dígitos');
                        return;
                    }
                }

                // Realizar consulta AJAX
                $.ajax({
                    url: 'consulta-reniec.php', // Ruta a tu archivo PHP que maneja la consulta a Reniec o SUNAT
                    type: 'POST',
                    data: {
                        documento: documento,
                        tipoDoc: tipoDoc
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (tipoDoc === "DNI") {
                            if (data.numeroDocumento == documento) {
                                var nombreCompleto = data.nombres + ' ' + data.apellidoPaterno + ' ' + data.apellidoMaterno;
                                $('#nombreInsert').val(nombreCompleto);
                                $('#numDocumentoInsert').val(data.numeroDocumento);
                                $('#tipoDocumentoInsert').val('DNI');
                                $('#documento').val('');
                                alertaBusqueda.css('display', 'none');
                                alertaErrores.css('display', 'none');
                            }
                        } else if (tipoDoc === "RUC") {
                            if (data.numeroDocumento == documento) {
                                $('#nombreInsert').val(data.razonSocial);
                                $('#numDocumentoInsert').val(data.numeroDocumento);
                                $('#tipoDocumentoInsert').val('RUC');
                                $('#documento').val('');
                                alertaBusqueda.css('display', 'none');
                                alertaErrores.css('display', 'none');
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en la consulta AJAX:", error);
                        alertaBusqueda.css('display', 'block');
                        alertaBusqueda.html('Error al consultar el documento. Inténtelo de nuevo.');
                    }
                });
            }



            // Asociar la función buscarDNI al evento click del botón
            $("#consultaReniec").click(buscarDNI);

            // Limpiar campos que solo permiten números
            $('#documento, #numDocumentoInsert, #telefonoContactoInsert').on('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
        </script>
        <!-- PARA QUE SE MUESTRE LAS TABLAS -->
        <script>
            $('#clientes').DataTable({
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
                    "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ clientes",
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
        <script>
            $(document).ready(function() {
                <?php foreach ($clientesArray as $clientes) { ?>
                    $('#facturas-<?php echo $clientes->idClientes; ?>').DataTable({
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

                    $('#credenciales-<?php echo $clientes->idClientes; ?>').DataTable({
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
                            "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ credenciales",
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

                    $('#contratos-<?php echo $clientes->idClientes; ?>').DataTable({
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
                            "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ contratos",
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
                <?php } ?>
            });
        </script>
        <!-- Validar antes de registrar cliente -->
        <script>
            $(document).ready(function() {
                // Evento para el botón de aceptar en modalAgregarAdmin
                $('#btn-aceptar-cliente').on('click', function(event) {
                    event.preventDefault(); // Prevenir el envío automático del formulario

                    // Validar los campos utilizando el modelo Admin
                    var tipoDocumento = $('#tipoDocumentoInsert').val().trim();
                    var numDocumento = $('#numDocumentoInsert').val().trim();
                    var nombre = $('#nombreInsert').val().trim();
                    var razonSocial = $('#razonSocialInsert').val().trim();
                    var nombreComercial = $('#nombreComercialInsert').val().trim();
                    var telefonoContacto = $('#telefonoContactoInsert').val().trim();
                    var correoContacto = $('#correoContactoInsert').val().trim();
                    var contrasenia = $('#contraseniaInsert').val().trim();

                    // Validación
                    var mensajesErrores = [];

                    if (!tipoDocumento) {
                        mensajesErrores.push("El tipo de documento no puede estar vacío.");
                    } else if (tipoDocumento.length > 20) {
                        mensajesErrores.push("El tipo de documento no puede exceder 20 caracteres.");
                    }

                    if (!numDocumento) {
                        mensajesErrores.push("El número de documento no puede estar vacío.");
                    } else if (numDocumento.length > 11) {
                        mensajesErrores.push("El número de documento no puede exceder 11 caracteres.");
                    }

                    if (!nombre) {
                        mensajesErrores.push("El nombre no puede estar vacío.");
                    } else if (nombre.length > 60) {
                        mensajesErrores.push("El nombre no puede exceder 60 caracteres.");
                    }

                    if (!razonSocial) {
                        mensajesErrores.push("La razon social no puede estar vacío.");
                    } else if (razonSocial.length > 50) {
                        mensajesErrores.push("La razon social no puede exceder 50 caracteres.");
                    }

                    if (!nombreComercial) {
                        mensajesErrores.push("El nombre comercial no puede estar vacío.");
                    } else if (nombreComercial.length > 50) {
                        mensajesErrores.push("El nombre comercial no puede exceder 50 caracteres.");
                    }

                    if (!telefonoContacto) {
                        mensajesErrores.push("El teléfono contacto no puede estar vacío.");
                    } else if (telefonoContacto.length !== 9) {
                        mensajesErrores.push("El teléfono contacto debe ser de 9 dígitos.");
                    }

                    if (!correoContacto) {
                        mensajesErrores.push("El correo contacto no puede estar vacío.");
                    } else if (!/\S+@\S+\.\S+/.test(correoContacto)) {
                        mensajesErrores.push("El correo contacto tiene formato incorrecto.");
                    }

                    if (!contrasenia) {
                        mensajesErrores.push("La contraseña no puede estar vacío.");
                    } else if (contrasenia.length > 255) {
                        mensajesErrores.push("La contraseña debe exceder los 255 caracteres.");
                    }

                    if (mensajesErrores.length > 0) {
                        var alertaErrores = $('#alertaErrores');
                        alertaErrores.css('display', 'block');
                        alertaErrores.html(mensajesErrores.join('<br>'));
                        $('#modalAceptarCliente').modal('hide');
                        $('#modalAgregarCliente').modal('show');
                    } else {
                        // Si no hay errores, verificar si existe duplicidad
                        validarExistencia(); // Llamar a la función para validar la existencia después de la consulta
                    }
                });

                // Función para validar existencia de documentos y contactos
                function validarExistencia() {
                    var numDocumento = $('#numDocumentoInsert').val().trim();
                    var telefonoContacto = $('#telefonoContactoInsert').val().trim();
                    var correoContacto = $('#correoContactoInsert').val().trim();
                    var alertaErrores = $('#alertaErrores');
                    var mensajesErrores = [];

                    <?php foreach ($clientesArray as $clientes) { ?>
                        if (numDocumento === '<?php echo $clientes->numDocumento; ?>') {
                            mensajesErrores.push("El número de documento ya existe.");
                        }

                        if (telefonoContacto === '<?php echo $clientes->telefonoContacto; ?>') {
                            mensajesErrores.push("El teléfono contacto ya existe.");
                        }

                        if (correoContacto === '<?php echo $clientes->correoContacto; ?>') {
                            mensajesErrores.push("El correo contacto ya existe.");
                        }
                    <?php } ?>

                    // Mostrar errores si los hay
                    if (mensajesErrores.length > 0) {
                        alertaErrores.css('display', 'block');
                        alertaErrores.html(mensajesErrores.join('<br>'));
                        $('#modalAceptarCliente').modal('hide');
                        $('#modalAgregarCliente').modal('show');
                    } else {
                        alertaErrores.css('display', 'none');
                        $('#form-cliente').submit(); // Enviar formulario si no hay errores
                    }
                }
            });
        </script>
        <!-- Validar antes de editar cliente -->
        <script>
            $(document).ready(function() {
                <?php foreach ($clientesArray as $clientes) { ?>
                    // Evento para el botón de aceptar en modalEditarCliente
                    $('#btn-aceptar-editar-cliente-<?php echo $clientes->idClientes; ?>').on('click', function(event) {
                        event.preventDefault(); // Prevenir el envío automático del formulario

                        // Validar los campos utilizando el modelo Admin
                        var tipoDocumento = $('#tipoDocumentoEdit-<?php echo $clientes->idClientes; ?>').val().trim();
                        var numDocumento = $('#numDocumentoEdit-<?php echo $clientes->idClientes; ?>').val().trim();
                        var nombre = $('#nombreEdit-<?php echo $clientes->idClientes; ?>').val().trim();
                        var razonSocial = $('#razonSocialEdit-<?php echo $clientes->idClientes; ?>').val().trim();
                        var nombreComercial = $('#nombreComercialEdit-<?php echo $clientes->idClientes; ?>').val().trim();
                        var telefonoContacto = $('#telefonoContactoEdit-<?php echo $clientes->idClientes; ?>').val().trim();
                        var correoContacto = $('#correoContactoEdit-<?php echo $clientes->idClientes; ?>').val().trim();
                        var contrasenia = $('#contraseniaEdit-<?php echo $clientes->idClientes; ?>').val().trim();
                        var containerDesplegar = $('#containerDesplegar-<?php echo $clientes->idClientes; ?>');

                        // Validación
                        var mensajesErrores = [];

                        if (!tipoDocumento) {
                            mensajesErrores.push("El tipo de documento no puede estar vacío.");
                        } else if (tipoDocumento.length > 20) {
                            mensajesErrores.push("El tipo de documento no puede exceder 20 caracteres.");
                        }

                        if (!numDocumento) {
                            mensajesErrores.push("El número de documento no puede estar vacío.");
                        } else if (numDocumento.length > 11) {
                            mensajesErrores.push("El número de documento no puede exceder 11 caracteres.");
                        }

                        if (!nombre) {
                            mensajesErrores.push("El nombre no puede estar vacío.");
                        } else if (nombre.length > 60) {
                            mensajesErrores.push("El nombre no puede exceder 60 caracteres.");
                        }

                        if (!razonSocial) {
                            mensajesErrores.push("La razon social no puede estar vacío.");
                        } else if (razonSocial.length > 50) {
                            mensajesErrores.push("La razon social no puede exceder 50 caracteres.");
                        }

                        if (!nombreComercial) {
                            mensajesErrores.push("El nombre comercial no puede estar vacío.");
                        } else if (nombreComercial.length > 50) {
                            mensajesErrores.push("El nombre comercial no puede exceder 50 caracteres.");
                        }

                        if (!telefonoContacto) {
                            mensajesErrores.push("El teléfono contacto no puede estar vacío.");
                        } else if (telefonoContacto.length !== 9) {
                            mensajesErrores.push("El teléfono contacto debe ser de 9 dígitos.");
                        }

                        if (!correoContacto) {
                            mensajesErrores.push("El correo contacto no puede estar vacío.");
                        } else if (!/\S+@\S+\.\S+/.test(correoContacto)) {
                            mensajesErrores.push("El correo contacto tiene formato incorrecto.");
                        }

                        if (!contrasenia) {
                            $('#contraseniaEdit-<?php echo $clientes->idClientes; ?>').val('<?php echo $clientes->contrasenia; ?>');
                        } else if (contrasenia.length > 255) {
                            mensajesErrores.push("La contraseña no puede exceder los 255 caracteres.");
                        } else {
                            $('#forPassword-<?php echo $clientes->idClientes; ?>').val('new');
                        }

                        // Verificación de la existencia de los valores teléfono y correo
                        <?php foreach ($clientesArray as $value) { ?>
                            if ('<?php echo $clientes->idClientes; ?>' != '<?php echo $value->idClientes; ?>' && (numDocumento === '<?php echo $value->numDocumento; ?>')) {
                                mensajesErrores.push("El número de documento ya existe.");
                            }

                            if ('<?php echo $clientes->idClientes; ?>' != '<?php echo $value->idClientes; ?>' && (telefonoContacto === '<?php echo $value->telefonoContacto; ?>')) {
                                mensajesErrores.push("El teléfono contacto ya existe.");
                            }
                            if ('<?php echo $clientes->idClientes; ?>' != '<?php echo $value->idClientes; ?>' && (correoContacto === '<?php echo $value->correoContacto; ?>')) {
                                mensajesErrores.push("El correo contacto ya existe.");
                            }
                        <?php } ?>

                        // Mostrar errores si los hay
                        if (mensajesErrores.length > 0) {
                            var alertaErrores = $('#alertaErroresEditar-<?php echo $clientes->idClientes; ?>');
                            alertaErrores.css('display', 'block');
                            alertaErrores.html(mensajesErrores.join('<br>'));

                            if (!contrasenia) {
                                $('#contraseniaEdit-<?php echo $clientes->idClientes; ?>').val('');
                            }

                            $('#modalAceptarEditarCliente-<?php echo $clientes->idClientes; ?>').modal('hide');
                        } else {
                            var alertaErrores = $('#alertaErroresEditar-<?php echo $clientes->idClientes; ?>');
                            alertaErrores.css('display', 'none');
                            containerDesplegar.addClass('cerrado');
                            $('#form-editar-cliente-<?php echo $clientes->idClientes; ?>').submit();
                        }
                    });
                <?php } ?>
            });
        </script>
        <!-- valiar antes de eliminar cliente -->
        <script>
            $(document).ready(function() {
                <?php foreach ($clientesArray as $clientes) { ?>
                    // Evento para el botón de aceptar en modalEliminarClientes
                    $('#btn-aceptar-delete-cliente-<?php echo $clientes->idClientes; ?>').on('click', function(event) {
                        event.preventDefault(); // Prevenir el envío automático del formulario

                        $('#form-delete-cliente-<?php echo $clientes->idClientes; ?>').submit();
                    });
                <?php } ?>
            });
        </script>
    <?php
    } else {
        header("Location: clientes.php");
    }
    ?>
</body>

</html>