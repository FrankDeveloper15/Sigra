<?php
require_once("layouts/headAdmin.php");
?>

<body>
    <?php
    require_once("Model/ContratoDAO.php");
    $contrato = new Contrato();
    $datosProcesados = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mensajesErrores = "";
        switch ($_POST['tipoEnvio']) {
            case 'insert':
                $contrato->fechaInicio = $_POST['fechaInicioInsert'];
                $contrato->fechaRenovacion = $_POST['fechaRenovacionInsert'];

                if (isset($_FILES['documentoInsert']) && $_FILES['documentoInsert']['error'] == UPLOAD_ERR_OK) {
                    $uploadDir = 'File/';
                    $uploadedFileName = basename($_FILES['documentoInsert']['name']);
                    $uploadFilePath = $uploadDir . $uploadedFileName;

                    // Obtener la extensión del archivo
                    $fileExtension = pathinfo($uploadFilePath, PATHINFO_EXTENSION);

                    // Verificar si el archivo es PDF
                    if (strtolower($fileExtension) === 'pdf') {
                        // Mover el archivo a la carpeta de destino
                        if (move_uploaded_file($_FILES['documentoInsert']['tmp_name'], $uploadFilePath)) {
                            $contrato->documento = $uploadedFileName;
                        } else {
                            $mensajesErrores[] = "Error al mover el archivo.";
                        }
                    } else {
                        $mensajesErrores[] = "Solo se permiten archivos PDF.";
                    }
                } else {
                    $mensajesErrores[] = "Error al subir el archivo.";
                }

                $contrato->idCredenciales = $_POST['idCredencialesInsert'];
                $contrato->idAdmin = $_POST['idAdminInsert'];

                $mensajesErrores = $contrato->validarContrato();

                if (count($mensajesErrores) > 0) {
                    $datosProcesados = false;
                } else {
                    try {
                        $contratoDAO = new ContratoDAO();
                        $contratoDAO->insert($contrato);

                        $_SESSION['msj'] = "Se registro el contrato correctamente.";
                        $datosProcesados = true;
                    } catch (Exception $e) {
                        $mensajesErrores[] = $e->getMessage();
                        $datosProcesados = false;
                    }
                }
                break;
            case 'edit':
                $contrato->idContrato = $_POST['idContratoEdit'];
                $contrato->fechaInicio = $_POST['fechaInicioEdit'];
                $contrato->fechaRenovacion = $_POST['fechaRenovacionEdit'];
                if (empty($_POST['forFile'])) {
                    $contrato->documento = $_POST['documentoEdit'];
                } else {
                    if (isset($_FILES['documentoEdit']) && $_FILES['documentoEdit']['error'] == UPLOAD_ERR_OK) {
                        $uploadDir = 'File/';
                        $uploadedFileName = basename($_FILES['documentoEdit']['name']);
                        $uploadFilePath = $uploadDir . $uploadedFileName;

                        // Obtener la extensión del archivo
                        $fileExtension = pathinfo($uploadFilePath, PATHINFO_EXTENSION);

                        // Verificar si el archivo es PDF
                        if (strtolower($fileExtension) === 'pdf') {
                            // Mover el archivo a la carpeta de destino
                            if (move_uploaded_file($_FILES['documentoEdit']['tmp_name'], $uploadFilePath)) {
                                $contrato->documento = $uploadedFileName;
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
                $contrato->idCredenciales = $_POST['idCredencialesEdit'];
                $contrato->idAdmin = $_POST['idAdminEdit'];
                $contrato->forFile = $_POST['forFile'];

                $mensajesErrores = $contrato->validarContrato();

                if (count($mensajesErrores) > 0) {
                    $datosProcesados = false;
                } else {
                    try {
                        $contratoDAO = new ContratoDAO();
                        $contratoDAO->edit($contrato);

                        $_SESSION['msj'] = "Se edito el contrato correctamente.";
                        $datosProcesados = true;
                    } catch (Exception $e) {
                        $mensajesErrores[] = $e->getMessage();
                        $datosProcesados = false;
                    }
                }
                break;
            case 'delete':
                $idContrato = $_POST['idContratoDelete'];

                try {
                    $contratoDAO = new ContratoDAO();
                    $contratoDAO->delete($idContrato);

                    $_SESSION['msj'] = "Se elimino el contrato correctamente.";
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
            header("Location: contratosAdmin.php");
            exit();
        }
    } else {
        try {
            $contratoDAO = new ContratoDAO();
            $contratoArray = array();
            $searchClientesCon = array();
            $searchAdmin = array();
            $contratoArray = $contratoDAO->list();
            $searchClientesCon = $contratoDAO->searchClientesCon();
            $searchAdmin = $contratoDAO->searchAdmin();
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
                    icon: "success",
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
            unset($_SESSION['msj']);
        } ?>
        <div class="container-fluid p-4">
            <button type="button" class="btn btn-primary w-auto clr-con" id="agregar-contrato" data-bs-toggle="modal" data-bs-target="#modalAgregarContrato"><i class="fa-solid fa-file-circle-plus"></i> AGREGAR</button>
        </div>
        <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded">
            <div class="row table-contrato">
                <table class="table table-striped" id="contrato">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Servicio</th>
                            <th>Administrador</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Renovación</th>
                            <th>Contrato</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contratoArray as $index => $contrato) { ?>
                            <tr data-id="<?php $index + 1; ?>">
                                <td><?php echo $index + 1; ?></td>
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
                                <td>
                                    <button class="btn btn-primary clr-cre" id="edit-contrato" data-bs-target="#modalEditarContrato-<?php echo $contrato->idContrato; ?>" data-bs-toggle="modal" style="border-radius: 10px 0 0 10px;"><i class="fa-solid fa-pen"></i></button><button class="btn btn-primary clr-so" id="delete-contrato" data-bs-target="#modalEliminarContrato-<?php echo $contrato->idContrato; ?>" data-bs-toggle="modal" style="border-radius: 0 10px 10px 0;"><i class="fa-solid fa-circle-xmark"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Agregar Contrato -->
        <div class="modal fade" id="modalAgregarContrato" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header title-edit" style="background-color: #4a4a4a; margin-top: 0px;">
                        <p>AGREGAR CONTRATO</p>
                    </div>
                    <div class="modal-body">
                        <div id="alertaErrores" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        </div>
                        <div class="col mb-3 px-3">
                            <form id="form-contrato" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="tipoEnvio" value="insert">
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-5">
                                        <div class="row">
                                            <label for="idAdminInsert" class="col-auto col-form-label">Admin:</label>
                                            <div class="col">
                                                <select title="Admin..." data-style="btn-secondary" class="form-control form-select" name="idAdminInsert" id="idAdminInsert">
                                                    <option value="">Selecciona un Administrador</option>
                                                    <?php foreach ($searchAdmin as $admin) { ?>
                                                        <option value="<?php echo $admin->idAdmin; ?>"><?php echo $admin->nombreApellidos; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row">
                                            <label for="idCredencialesInsert" class="col-auto col-form-label">Credenciales:</label>
                                            <div class="col">
                                                <select title="Credenciales..." data-style="btn-secondary" class="form-control form-select" name="idCredencialesInsert" id="idCredencialesInsert">
                                                    <option value="">Seleccion de Cliente y Servicio</option>
                                                    <?php foreach ($searchClientesCon as $clientesCon) { ?>
                                                        <option value="<?php echo $clientesCon->idCredenciales; ?>"><?php echo $clientesCon->nombre; ?> -> <?php echo $clientesCon->nombreServicios; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <label for="fechaInicioInsert" class="col-auto col-form-label">Fecha Inicio:</label>
                                            <div class="col">
                                                <input readonly type="date" class="form-control" id="fechaInicioInsert" name="fechaInicioInsert">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <label for="fechaRenovacionInsert" class="col-auto col-form-label">Fecha Renovación:</label>
                                            <div class="col">
                                                <input type="date" class="form-control" id="fechaRenovacionInsert" name="fechaRenovacionInsert">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label for="documentoInsert" class="col-auto col-form-label">Archivo Contrato:</label>
                                            <div class="col">
                                                <input type="file" class="form-control" id="documentoInsert" name="documentoInsert" accept="application/pdf">
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
                                            <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarContrato" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Aceptar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Aceptar Contrato-->
        <div class="modal fade" id="modalAceptarContrato" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #4a4a4a; color: #fff;">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Agregar Contrato</h1>
                    </div>
                    <div class="modal-body">
                        El contrato sera registrado.
                    </div>
                    <div class="modal-footer row align-items-center p-0">
                        <div class="row d-flex justify-content-end mb-3">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalAgregarContrato" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" id="btn-aceptar-contrato" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php foreach ($contratoArray as $contrato) { ?>
            <!-- Modal Eliminar Contrato-->
            <div class="modal fade" id="modalEliminarContrato-<?php echo $contrato->idContrato; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="form-delete-contrato-<?php echo $contrato->idContrato; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="modal-header" style="background-color: #4a4a4a; color: #fff;">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar Contrato</h1>
                            </div>
                            <div class="modal-body">
                                El contrato del cliente <?php echo $contrato->nombre; ?> del servicio de <?php echo $contrato->nombreServicios; ?> administrado por <?php echo $contrato->nombreApellidos; ?> sera eliminado.
                                <input type="hidden" name="tipoEnvio" value="delete">
                                <input type="hidden" name="idContratoDelete" value="<?php echo $contrato->idContrato; ?>">
                            </div>
                            <div class="modal-footer row align-items-center p-0">
                                <div class="row d-flex justify-content-end mb-3">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-secondary cancelar" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary salvar" id="btn-aceptar-delete-contrato-<?php echo $contrato->idContrato; ?>"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Editar Contrato -->
            <div class="modal fade" id="modalEditarContrato-<?php echo $contrato->idContrato; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header title-edit" style="background-color: #4a4a4a; margin-top: 0px;">
                            <p>EDITAR CONTRATO</p>
                        </div>
                        <div class="modal-body">
                            <div id="alertaErroresEditar-<?php echo $contrato->idContrato; ?>" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                            </div>
                            <div class="col mb-3 px-3">
                                <form id="form-editar-contrato-<?php echo $contrato->idContrato; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="tipoEnvio" value="edit">
                                    <input type="hidden" id="idContratoEdit-<?php echo $contrato->idContrato; ?>" name="idContratoEdit" value="<?php echo $contrato->idContrato; ?>">
                                    <input type="hidden" id="forFile-<?php echo $contrato->idContrato; ?>" name="forFile">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-5">
                                            <div class="row">
                                                <label for="idAdminEdit-<?php echo $contrato->idContrato; ?>" class="col-auto col-form-label">Admin:</label>
                                                <div class="col">
                                                    <select title="Admin..." data-style="btn-secondary" class="form-control form-select" name="idAdminEdit" id="idAdminEdit-<?php echo $contrato->idContrato; ?>">
                                                        <option value="">Selecciona un Administrador</option>
                                                        <?php foreach ($searchAdmin as $admin) { ?>
                                                            <?php $op = ($contrato->idAdmin == $admin->idAdmin) ? "selected" : ""; ?>
                                                            <option <?php echo $op; ?> value="<?php echo $admin->idAdmin; ?>"><?php echo $admin->nombreApellidos; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <label for="idCredencialesEdit-<?php echo $contrato->idContrato; ?>" class="col-auto col-form-label">Credenciales:</label>
                                                <div class="col">
                                                    <select title="Credenciales..." data-style="btn-secondary" class="form-control form-select" name="idCredencialesEdit" id="idCredencialesEdit-<?php echo $contrato->idContrato; ?>">
                                                        <option value="<?php echo $contrato->idCredenciales; ?>"><?php echo $contrato->nombre; ?> -> <?php echo $contrato->nombreServicios; ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <label for="fechaInicioEdit-<?php echo $contrato->idContrato; ?>" class="col-auto col-form-label">Fecha Inicio:</label>
                                                <div class="col">
                                                    <input readonly type="date" class="form-control" id="fechaInicioEdit-<?php echo $contrato->idContrato; ?>" name="fechaInicioEdit" value="<?php echo $contrato->fechaInicio; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <label for="fechaRenovacionEdit-<?php echo $contrato->idContrato; ?>" class="col-auto col-form-label">Fecha Renovación:</label>
                                                <div class="col">
                                                    <input type="date" class="form-control" id="fechaRenovacionEdit-<?php echo $contrato->idContrato; ?>" name="fechaRenovacionEdit" value="<?php echo $contrato->fechaRenovacion; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <label for="documentoEdit-<?php echo $contrato->idContrato; ?>" class="col-auto col-form-label">Archivo Contrato:</label>
                                                <div class="col">
                                                    <input type="file" class="form-control" id="documentoEdit-<?php echo $contrato->idContrato; ?>" name="documentoEdit" accept="application/pdf">
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
                                                <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarEditarContrato-<?php echo $contrato->idContrato; ?>" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Aceptar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Aceptar Editar Contrato-->
            <div class="modal fade" id="modalAceptarEditarContrato-<?php echo $contrato->idContrato; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #4a4a4a; color: #fff;">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Editar Contrato</h1>
                        </div>
                        <div class="modal-body">
                            El contrato del cliente <?php echo $contrato->nombre; ?> del servicio de <?php echo $contrato->nombreServicios; ?> sera editado.
                        </div>
                        <div class="modal-footer row align-items-center p-0">
                            <div class="row d-flex justify-content-end mb-3">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalEditarContrato-<?php echo $contrato->idContrato; ?>" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" id="btn-aceptar-editar-contrato-<?php echo $contrato->idContrato; ?>" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Editar</button>
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
            document.getElementById('fechaInicioInsert').value = formattedDateForInput;
        </script>
        <!-- Para la tabla de contrato -->
        <script>
            $('#contrato').DataTable({
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
                    "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ contrato",
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
        <!-- Para validar antes de agregar contrato -->
        <script>
            $(document).ready(function() {
                // Evento para el botón de aceptar en modalAgregarContrato
                $('#btn-aceptar-contrato').on('click', function(event) {
                    event.preventDefault(); // Prevenir el envío automático del formulario

                    // Validar los campos utilizando el modelo Contrato
                    var fechaInicio = $('#fechaInicioInsert').val().trim();
                    var fechaRenovacion = $('#fechaRenovacionInsert').val().trim();
                    var documento = $('#documentoInsert').val().trim();
                    var idCredenciales = $('#idCredencialesInsert').val().trim();
                    var idAdmin = $('#idAdminInsert').val().trim();

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

                    if (!fechaInicio) {
                        mensajesErrores.push("La fecha de inicio no puede estar vacía.");
                    } else if (!esFechaValida(fechaInicio)) {
                        mensajesErrores.push("La fecha de inicio debe tener el formato Y-m-d.");
                    }

                    if (!fechaRenovacion) {
                        mensajesErrores.push("La fecha de renovación no puede estar vacía.");
                    } else if (!esFechaValida(fechaRenovacion)) {
                        mensajesErrores.push("La fecha de renovación debe tener el formato Y-m-d.");
                    }

                    if (!documento) {
                        mensajesErrores.push("El documento no puede estar vacío.");
                    } else {
                        // Obtener la extensión del archivo
                        var extension = documento.split('.').pop().toLowerCase();

                        // Verificar si la extensión es PDF
                        if (extension !== 'pdf') {
                            mensajesErrores.push("El documento debe ser un archivo PDF.");
                        }
                    }

                    if (!idCredenciales) {
                        mensajesErrores.push("No selecciono ninguna credencial.");
                    } else if (idCredenciales.length > 6) {
                        mensajesErrores.push("El codigo de credenciales excede 6 caracteres.");
                    }

                    if (!idAdmin) {
                        mensajesErrores.push("No selecciono ningun administrador.");
                    } else if (idAdmin.length > 6) {
                        mensajesErrores.push("El codigo del administrador excede 6 caracteres.");
                    }

                    // Obtener solo el nombre del archivo del documento insertado
                    var nombreArchivoInsertado = documento.split('\\').pop().split('/').pop();

                    <?php foreach ($contratoArray as $contrato) { ?>
                        if ((idAdmin === '<?php echo $contrato->idAdmin; ?>') && (idCredenciales === '<?php echo $contrato->idCredenciales; ?>')) {
                            mensajesErrores.push("El administrador ya tiene a cargo de este credencial.");
                        }

                        if (nombreArchivoInsertado === '<?php echo $contrato->documento; ?>') {
                            mensajesErrores.push("El documento ya existe.");
                        }
                    <?php } ?>

                    if (mensajesErrores.length > 0) {
                        var alertaErrores = $('#alertaErrores');
                        alertaErrores.css('display', 'block');
                        alertaErrores.html(mensajesErrores.join('<br>'));
                        $('#modalAceptarContrato').modal('hide');
                        $('#modalAgregarContrato').modal('show');
                    } else {
                        // Si no hay errores, verificar si existe duplicidad
                        $('#form-contrato').submit(); // Enviar formulario si no hay errores
                    }
                });
            });
        </script>
        <!-- Para validar antes de editar contrato -->
        <script>
            $(document).ready(function() {
                <?php foreach ($contratoArray as $contrato) { ?>
                    // Evento para el botón de aceptar en modalEditarContrato
                    $('#btn-aceptar-editar-contrato-<?php echo $contrato->idContrato; ?>').on('click', function(event) {
                        event.preventDefault(); // Prevenir el envío automático del formulario

                        // Validar los campos utilizando el modelo Contrato
                        var fechaInicio = $('#fechaInicioEdit-<?php echo $contrato->idContrato; ?>').val().trim();
                        var fechaRenovacion = $('#fechaRenovacionEdit-<?php echo $contrato->idContrato; ?>').val().trim();
                        var documento = $('#documentoEdit-<?php echo $contrato->idContrato; ?>').val().trim();
                        var idCredenciales = $('#idCredencialesEdit-<?php echo $contrato->idContrato; ?>').val().trim();
                        var idAdmin = $('#idAdminEdit-<?php echo $contrato->idContrato; ?>').val().trim();

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

                        if (!fechaInicio) {
                            mensajesErrores.push("La fecha de inicio no puede estar vacía.");
                        } else if (!esFechaValida(fechaInicio)) {
                            mensajesErrores.push("La fecha de inicio debe tener el formato Y-m-d.");
                        }

                        if (!fechaRenovacion) {
                            mensajesErrores.push("La fecha de renovación no puede estar vacía.");
                        } else if (!esFechaValida(fechaRenovacion)) {
                            mensajesErrores.push("La fecha de renovación debe tener el formato Y-m-d.");
                        }

                        // Obtener la extensión del archivo
                        var extension = documento.split('.').pop().toLowerCase();

                        if (!documento) {
                            $('#documentoEdit-<?php echo $contrato->idContrato; ?>').attr('type', 'text');
                            $('#documentoEdit-<?php echo $contrato->idContrato; ?>').val('<?php echo $contrato->documento; ?>');
                        } else if (extension !== 'pdf') {
                            mensajesErrores.push("El documento debe ser un archivo PDF.");
                        } else {
                            $('#forFile-<?php echo $contrato->idContrato; ?>').val('new');
                        }


                        if (!idCredenciales) {
                            mensajesErrores.push("No selecciono ninguna credencial.");
                        } else if (idCredenciales.length > 6) {
                            mensajesErrores.push("El codigo de credenciales excede 6 caracteres.");
                        }

                        if (!idAdmin) {
                            mensajesErrores.push("No selecciono ningun administrador.");
                        } else if (idAdmin.length > 6) {
                            mensajesErrores.push("El codigo del administrador excede 6 caracteres.");
                        }

                        // Obtener solo el nombre del archivo del documento insertado
                        var nombreArchivoInsertado = documento.split('\\').pop().split('/').pop();

                        // Verificación de la existencia de los valores 
                        <?php foreach ($contratoArray as $value) { ?>
                            if (('<?php echo $contrato->idContrato; ?>' != '<?php echo $value->idContrato; ?>') && (nombreArchivoInsertado === '<?php echo $value->documento; ?>')) {
                                mensajesErrores.push("Este archivo ya esta registrado.");
                            }
                            if ('<?php echo $contrato->idContrato; ?>' != '<?php echo $value->idContrato; ?>' && ((idAdmin === '<?php echo $value->idAdmin; ?>') && (idCredenciales === '<?php echo $value->idCredenciales; ?>'))) {
                                mensajesErrores.push("El administrador ya tiene a cargo de este credencial.");
                            }
                        <?php } ?>

                        // Mostrar errores si los hay
                        if (mensajesErrores.length > 0) {
                            var alertaErrores = $('#alertaErroresEditar-<?php echo $contrato->idContrato; ?>');
                            alertaErrores.css('display', 'block');
                            alertaErrores.html(mensajesErrores.join('<br>'));

                            if (!documento) {
                                $('#documentoEdit-<?php echo $contrato->idContrato; ?>').attr('type', 'file');
                                $('#documentoEdit-<?php echo $contrato->idContrato; ?>').val('');
                            }

                            $('#forFile-<?php echo $contrato->idContrato; ?>').val('');
                            $('#modalAceptarEditarContrato-<?php echo $contrato->idContrato; ?>').modal('hide');
                            $('#modalEditarContrato-<?php echo $contrato->idContrato; ?>').modal('show');
                        } else {
                            var alertaErrores = $('#alertaErroresEditar-<?php echo $contrato->idContrato; ?>');
                            alertaErrores.css('display', 'none');
                            $('#form-editar-contrato-<?php echo $contrato->idContrato; ?>').submit();
                        }
                    });
                <?php } ?>
            });
        </script>
        <!-- Para eliminar el contrato -->
        <script>
            $(document).ready(function() {
                <?php foreach ($contratoArray as $contrato) { ?>
                    // Evento para el botón de aceptar en modalEditarContrato
                    $('#btn-aceptar-delete-contrato-<?php echo $contrato->idContrato; ?>').on('click', function(event) {
                        event.preventDefault(); // Prevenir el envío automático del formulario

                        $('#form-delete-contrato-<?php echo $contrato->idContrato; ?>').submit();
                    });
                <?php } ?>
            });
        </script>
    <?php
    } else {
        header("Location: contratosAdmin.php");
    }
    ?>
</body>

</html>