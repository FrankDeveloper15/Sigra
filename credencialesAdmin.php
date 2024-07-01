<?php
require_once("layouts/headAdmin.php");
?>

<body>
    <?php
    require_once("Model/CredencialesDAO.php");
    $credenciales = new Credenciales();
    $datosProcesados = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mensajesErrores = "";
        switch ($_POST['tipoEnvio']) {
            case 'insert':
                $credenciales->usuario = $_POST['usuarioInsert'];
                $credenciales->contrasenia = $_POST['contraseniaInsert'];
                $credenciales->observacion = $_POST['observacionInsert'];
                $credenciales->idClientes = $_POST['idClientesInsert'];
                $credenciales->idServicios = $_POST['idServiciosInsert'];

                $mensajesErrores = $credenciales->validarCredenciales();

                if (count($mensajesErrores) > 0) {
                    $datosProcesados = false;
                } else {
                    try {
                        $credencialesDAO = new CredencialesDAO();
                        $credencialesDAO->insert($credenciales);

                        $_SESSION['msj'] = "Se registro la credencial correctamente.";
                        $_SESSION['icon'] = "success";
                        $datosProcesados = true;
                    } catch (Exception $e) {
                        $mensajesErrores[] = $e->getMessage();
                        $datosProcesados = false;
                    }
                }
                break;
            case 'edit':
                $credenciales->idCredenciales = $_POST['idCredencialesEdit'];
                $credenciales->usuario = $_POST['usuarioEdit'];
                $credenciales->contrasenia = $_POST['contraseniaEdit'];
                $credenciales->observacion = $_POST['observacionEdit'];
                $credenciales->idClientes = $_POST['idClientesEdit'];
                $credenciales->idServicios = $_POST['idServiciosEdit'];
                $credenciales->forPassword = $_POST['forPassword'];

                $mensajesErrores = $credenciales->validarCredenciales();

                if (count($mensajesErrores) > 0) {
                    $datosProcesados = false;
                } else {
                    try {
                        $credencialesDAO = new CredencialesDAO();
                        $credencialesDAO->edit($credenciales);

                        $_SESSION['msj'] = "Se edito la credencial correctamente.";
                        $_SESSION['icon'] = "success";
                        $datosProcesados = true;
                    } catch (Exception $e) {
                        $mensajesErrores[] = $e->getMessage();
                        $datosProcesados = false;
                    }
                }
                break;
            case 'delete':
                $idCredenciales = $_POST['idCredencialesDelete'];

                try {
                    $credencialesDAO = new CredencialesDAO();
                    $credencialesDAO->delete($idCredenciales);

                    $_SESSION['msj'] = "Se elimino la credencial correctamente.";
                    $_SESSION['icon'] = "success";
                    $datosProcesados = true;
                } catch (Exception $e) {
                    $_SESSION['msj'] = "No se puede eliminar el credencial ya que esta relacionado con otras tablas.";
                    $_SESSION['icon'] = "error";
                    $datosProcesados = true;
                }
                break;
            default:

                break;
        }

        if (!empty($mensajesErrores)) {
            header("Location: credencialesAdmin.php");
            exit();
        }
    } else {
        try {
            $credencialesDAO = new CredencialesDAO();
            $credencialesArray = array();
            $searchClientes = array();
            $searchServicios = array();
            $credencialesArray = $credencialesDAO->list();
            $searchClientes = $credencialesDAO->searchClientesCre();
            $searchServicios = $credencialesDAO->searchServiciosCre();
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
            <button type="button" class="btn btn-primary w-auto clr-cre" id="agregar-accesos" data-bs-toggle="modal" data-bs-target="#modalAgregarCredenciales"><i class="fa-solid fa-file-circle-plus"></i> AGREGAR</button>
        </div>
        <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded">
            <div class="row table-credenciales">
                <table class="table table-striped" id="credenciales">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Servicio</th>
                            <th>Usuario</th>
                            <th>Observacion</th>
                            <th>Link de Acceso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($credencialesArray as $index => $credenciales) { ?>
                            <tr data-id="<?php $index + 1; ?>">
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $credenciales->nombre; ?></td>
                                <td><?php echo $credenciales->nombreServicios; ?></td>
                                <td><?php echo $credenciales->usuario; ?></td>
                                <td><?php echo $credenciales->observacion; ?></td>
                                <td><?php echo $credenciales->linkAcceso; ?></td>
                                <td>
                                    <button class="btn btn-primary clr-cre" id="edit-credenciales" data-bs-target="#modalEditarCredenciales-<?php echo $credenciales->idCredenciales; ?>" data-bs-toggle="modal" style="border-radius: 10px 0 0 10px;"><i class="fa-solid fa-pen"></i></button><button class="btn btn-primary clr-so" id="delete-credenciales" data-bs-target="#modalEliminarCredenciales-<?php echo $credenciales->idCredenciales; ?>" data-bs-toggle="modal" style="border-radius: 0 10px 10px 0;"><i class="fa-solid fa-circle-xmark"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Agregar Credenciales o Accesos -->
        <div class="modal fade" id="modalAgregarCredenciales" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header title-edit" style="background-color: #106da2; margin-top: 0px;">
                        <p>AGREGAR CREDENCIALES</p>
                    </div>
                    <div class="modal-body">
                        <div id="alertaErrores" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        </div>
                        <div class="col mb-3 px-3">
                            <form id="form-credenciales" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <input type="hidden" name="tipoEnvio" value="insert">
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-5">
                                        <div class="col">
                                            <label for="idClientesInsert" class="col-auto col-form-label">Clientes:</label>
                                            <div class="col">
                                                <select title="Selecciona Clientes" data-style="btn-secondary" class="form-control form-select selectpicker show-tick" name="idClientesInsert" id="idClientesInsert" data-size="5" data-live-search="true">
                                                    <?php foreach ($searchClientes as $clientes) { ?>
                                                        <option value="<?php echo $clientes->idClientes; ?>"><?php echo $clientes->nombre; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="col">
                                            <label for="idServiciosInsert" class="col-auto col-form-label">Servicios:</label>
                                            <div class="col">
                                                <select title="Selecciona Servicio" data-style="btn-secondary" class="form-control form-select selectpicker show-tick" name="idServiciosInsert" id="idServiciosInsert" data-size="5" data-live-search="true">
                                                    <?php foreach ($searchServicios as $servicios) { ?>
                                                        <option value="<?php echo $servicios->idServicios; ?>"><?php echo $servicios->nombreServicios; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <label for="usuarioInsert" class="col-auto col-form-label">Usuario:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="usuarioInsert" name="usuarioInsert">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
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
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label for="observacionInsert" class="col-auto col-form-label">Observacion:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="observacionInsert" name="observacionInsert">
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
                                            <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarCredenciales" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Aceptar Credenciales-->
        <div class="modal fade" id="modalAceptarCredenciales" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #106da2; color: #fff;">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Agregar Credencial</h1>
                    </div>
                    <div class="modal-body">
                        La credencial sera registrado.
                    </div>
                    <div class="modal-footer row align-items-center p-0">
                        <div class="row d-flex justify-content-end mb-3">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalAgregarCredenciales" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" id="btn-aceptar-credenciales" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php foreach ($credencialesArray as $credenciales) { ?>
            <!-- Modal Eliminar Credenciales-->
            <div class="modal fade" id="modalEliminarCredenciales-<?php echo $credenciales->idCredenciales; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="form-delete-credenciales-<?php echo $credenciales->idCredenciales; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="modal-header" style="background-color: #106da2; color: #fff;">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar Credenciales</h1>
                            </div>
                            <div class="modal-body">
                                La credencial del cliente <?php echo $credenciales->nombre; ?> y servicio <?php echo $credenciales->nombreServicios; ?> sera eliminado.
                                <input type="hidden" name="tipoEnvio" value="delete">
                                <input type="hidden" name="idCredencialesDelete" value="<?php echo $credenciales->idCredenciales; ?>">
                            </div>
                            <div class="modal-footer row align-items-center p-0">
                                <div class="row d-flex justify-content-end mb-3">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-secondary cancelar" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" id="btn-aceptar-delete-credenciales-<?php echo $credenciales->idCredenciales; ?>" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Editar Credenciales o Accesos -->
            <div class="modal fade" id="modalEditarCredenciales-<?php echo $credenciales->idCredenciales; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header title-edit" style="background-color: #106da2; margin-top: 0px;">
                            <p>EDITAR CREDENCIALES</p>
                        </div>
                        <div class="modal-body">
                            <div id="alertaErroresEditar-<?php echo $credenciales->idCredenciales; ?>" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                            </div>
                            <div class="col mb-3 px-3">
                                <form id="form-editar-credenciales-<?php echo $credenciales->idCredenciales; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <input type="hidden" name="tipoEnvio" value="edit">
                                    <input type="hidden" id="idCredencialesEdit-<?php echo $credenciales->idCredenciales; ?>" name="idCredencialesEdit" value="<?php echo $credenciales->idCredenciales; ?>">
                                    <input type="hidden" id="forPassword-<?php echo $credenciales->idCredenciales; ?>" name="forPassword">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-5">
                                            <div class="col">
                                                <label for="idClientesEdit-<?php echo $credenciales->idCredenciales; ?>" class="col-auto col-form-label">Clientes:</label>
                                                <div class="col">
                                                    <select title="Clientes..." data-style="btn-secondary" class="form-control" name="idClientesEdit" id="idClientesEdit-<?php echo $credenciales->idCredenciales; ?>">
                                                        <option value="<?php echo $credenciales->idClientes; ?>"><?php echo $credenciales->nombre; ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="col">
                                                <label for="idServiciosEdit-<?php echo $credenciales->idCredenciales; ?>" class="col-auto col-form-label">Servicios:</label>
                                                <div class="col">
                                                    <select title="Selecciona Servicio" data-style="btn-secondary" class="form-control form-select selectpicker show-tick" name="idServiciosEdit" id="idServiciosEdit-<?php echo $credenciales->idCredenciales; ?>" data-size="5" data-live-search="true">
                                                        <?php foreach ($searchServicios as $servicios) { ?>
                                                            <?php $op = ($credenciales->idServicios == $servicios->idServicios) ? "selected" : ""; ?>
                                                            <option <?php echo $op; ?> value="<?php echo $servicios->idServicios; ?>"><?php echo $servicios->nombreServicios; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <label for="usuarioEdit-<?php echo $credenciales->idCredenciales; ?>" class="col-auto col-form-label">Usuario:</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="usuarioEdit-<?php echo $credenciales->idCredenciales; ?>" name="usuarioEdit" value="<?php echo $credenciales->usuario; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <label for="contraseniaEdit-<?php echo $credenciales->idCredenciales; ?>" class="col-auto col-form-label">Contraseña:</label>
                                                <div class="col input-group">
                                                    <input type="password" class="form-control" id="contraseniaEdit-<?php echo $credenciales->idCredenciales; ?>" name="contraseniaEdit">
                                                    <button class="input-group-text" type="button" id="seePasswordEdit-<?php echo $credenciales->idCredenciales; ?>">
                                                        <i class="fa-solid fa-eye-slash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <label for="observacionEdit-<?php echo $credenciales->idCredenciales; ?>" class="col-auto col-form-label">Observacion:</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="observacionEdit-<?php echo $credenciales->idCredenciales; ?>" name="observacionEdit" value="<?php echo $credenciales->observacion; ?>">
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
                                                <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarEditarCredenciales-<?php echo $credenciales->idCredenciales; ?>" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Aceptar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Aceptar Editar Credenciales-->
            <div class="modal fade" id="modalAceptarEditarCredenciales-<?php echo $credenciales->idCredenciales; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #106da2; color: #fff;">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Editar Credencial</h1>
                        </div>
                        <div class="modal-body">
                            La credencial del cliente <?php echo $credenciales->nombre; ?> sera editado.
                        </div>
                        <div class="modal-footer row align-items-center p-0">
                            <div class="row d-flex justify-content-end mb-3">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalEditarCredenciales-<?php echo $credenciales->idCredenciales; ?>" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" id="btn-aceptar-editar-credenciales-<?php echo $credenciales->idCredenciales; ?>" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Editar</button>
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
        <!-- Para que se muestre o oculte la contraseña -->
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
            <?php foreach ($credencialesArray as $credenciales) { ?>
                document.getElementById('seePasswordEdit-<?php echo $credenciales->idCredenciales; ?>').addEventListener('click', function() {
                    const passwordEdit = document.getElementById('contraseniaEdit-<?php echo $credenciales->idCredenciales; ?>');
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
        <!-- Para la tabla de credenciales -->
        <script>
            $('#credenciales').DataTable({
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
        </script>
        <!-- Para validar antes de agregar credenciales -->
        <script>
            $(document).ready(function() {
                // Evento para el botón de aceptar en modalAgregarCredenciales
                $('#btn-aceptar-credenciales').on('click', function(event) {
                    event.preventDefault(); // Prevenir el envío automático del formulario

                    // Validar los campos utilizando el modelo Credenciales
                    var usuario = $('#usuarioInsert').val().trim();
                    var contrasenia = $('#contraseniaInsert').val().trim();
                    var observacion = $('#observacionInsert').val().trim();
                    var idClientes = $('#idClientesInsert').val().trim();
                    var idServicios = $('#idServiciosInsert').val().trim();


                    // Validación
                    var mensajesErrores = [];

                    if (!usuario) {
                        mensajesErrores.push("El usuario no puede estar vacío.");
                    } else if (usuario.length > 30) {
                        mensajesErrores.push("El usuario no puede exceder 30 caracteres.");
                    }

                    if (!contrasenia) {
                        mensajesErrores.push("La contraseña no puede estar vacío.");
                    } else if (contrasenia.length > 255) {
                        mensajesErrores.push("La contraseña debe exceder los 255 caracteres.");
                    }

                    if (!observacion) {
                        mensajesErrores.push("La observación no puede estar vacío.");
                    } else if (observacion.length > 50) {
                        mensajesErrores.push("La observación no puede exceder 50 caracteres.");
                    }

                    if (!idClientes) {
                        mensajesErrores.push("No selecciono ningun cliente.");
                    } else if (idClientes.length > 6) {
                        mensajesErrores.push("El codigo de cliente excede 6 caracteres.");
                    }

                    if (!idServicios) {
                        mensajesErrores.push("No selecciono ningun servicio.");
                    } else if (idServicios.length > 6) {
                        mensajesErrores.push("El codigo de servicio excede 6 caracteres.");
                    }

                    <?php foreach ($credencialesArray as $credenciales) { ?>
                        if ((idClientes === '<?php echo $credenciales->idClientes; ?>') && (idServicios === '<?php echo $credenciales->idServicios; ?>')) {
                            mensajesErrores.push("El cliente ya esta registrado con ese servicio.");
                        }

                        if (usuario === '<?php echo $credenciales->usuario; ?>') {
                            mensajesErrores.push("El usuario ya existe.");
                        }
                    <?php } ?>

                    if (mensajesErrores.length > 0) {
                        var alertaErrores = $('#alertaErrores');
                        alertaErrores.css('display', 'block');
                        alertaErrores.html(mensajesErrores.join('<br>'));
                        $('#modalAceptarCredenciales').modal('hide');
                        $('#modalAgregarCredenciales').modal('show');
                    } else {
                        // Si no hay errores, verificar si existe duplicidad
                        $('#form-credenciales').submit(); // Enviar formulario si no hay errores
                    }
                });
            });
        </script>
        <!-- Para validar antes de editar credenciales -->
        <script>
            $(document).ready(function() {
                <?php foreach ($credencialesArray as $credenciales) { ?>
                    // Evento para el botón de aceptar en modalEditarCredenciales
                    $('#btn-aceptar-editar-credenciales-<?php echo $credenciales->idCredenciales; ?>').on('click', function(event) {
                        event.preventDefault(); // Prevenir el envío automático del formulario

                        // Validar los campos utilizando el modelo Credenciales
                        var usuario = $('#usuarioEdit-<?php echo $credenciales->idCredenciales; ?>').val().trim();
                        var contrasenia = $('#contraseniaEdit-<?php echo $credenciales->idCredenciales; ?>').val().trim();
                        var observacion = $('#observacionEdit-<?php echo $credenciales->idCredenciales; ?>').val().trim();
                        var idClientes = $('#idClientesEdit-<?php echo $credenciales->idCredenciales; ?>').val().trim();
                        var idServicios = $('#idServiciosEdit-<?php echo $credenciales->idCredenciales; ?>').val().trim();


                        // Validación
                        var mensajesErrores = [];

                        if (!usuario) {
                            mensajesErrores.push("El usuario no puede estar vacío.");
                        } else if (usuario.length > 30) {
                            mensajesErrores.push("El usuario no puede exceder 30 caracteres.");
                        }

                        if (!contrasenia) {
                            $('#contraseniaEdit-<?php echo $credenciales->idCredenciales; ?>').val('<?php echo $credenciales->contrasenia; ?>');
                        } else if (contrasenia.length > 255) {
                            mensajesErrores.push("La contraseña no puede exceder los 255 caracteres.");
                        } else {
                            $('#forPassword-<?php echo $credenciales->idCredenciales; ?>').val('new');
                        }

                        if (!observacion) {
                            mensajesErrores.push("La observación no puede estar vacío.");
                        } else if (observacion.length > 50) {
                            mensajesErrores.push("La observación no puede exceder 50 caracteres.");
                        }

                        if (!idClientes) {
                            mensajesErrores.push("No selecciono ningun cliente.");
                        } else if (idClientes.length > 6) {
                            mensajesErrores.push("El codigo de cliente excede 6 caracteres.");
                        }

                        if (!idServicios) {
                            mensajesErrores.push("No selecciono ningun servicio.");
                        } else if (idServicios.length > 6) {
                            mensajesErrores.push("El codigo de servicio excede 6 caracteres.");
                        }

                        // Verificación de la existencia de los valores 
                        <?php foreach ($credencialesArray as $value) { ?>
                            if (('<?php echo $credenciales->idCredenciales; ?>' != '<?php echo $value->idCredenciales; ?>') && (idClientes === '<?php echo $value->idClientes; ?>') && (idServicios === '<?php echo $value->idServicios; ?>')) {
                                mensajesErrores.push("El cliente ya esta registrado con ese servicio.");
                            }
                            if ('<?php echo $credenciales->idCredenciales; ?>' != '<?php echo $value->idCredenciales; ?>' && (usuario === '<?php echo $value->usuario; ?>')) {
                                mensajesErrores.push("El usuario ya existe.");
                            }
                        <?php } ?>

                        // Mostrar errores si los hay
                        if (mensajesErrores.length > 0) {
                            var alertaErrores = $('#alertaErroresEditar-<?php echo $credenciales->idCredenciales; ?>');
                            alertaErrores.css('display', 'block');
                            alertaErrores.html(mensajesErrores.join('<br>'));

                            if (!contrasenia) {
                                $('#contraseniaEdit-<?php echo $credenciales->idCredenciales; ?>').val('');
                            }

                            $('#modalAceptarEditarCredenciales-<?php echo $credenciales->idCredenciales; ?>').modal('hide');
                            $('#modalEditarCredenciales-<?php echo $credenciales->idCredenciales; ?>').modal('show');
                        } else {
                            var alertaErrores = $('#alertaErroresEditar-<?php echo $credenciales->idCredenciales; ?>');
                            alertaErrores.css('display', 'none');
                            $('#form-editar-credenciales-<?php echo $credenciales->idCredenciales; ?>').submit();
                        }
                    });
                <?php } ?>
            });
        </script>
        <!-- Para eliminar la credencial -->
        <script>
            $(document).ready(function() {
                <?php foreach ($credencialesArray as $credenciales) { ?>
                    // Evento para el botón de aceptar en modalEditarAdmin
                    $('#btn-aceptar-delete-credenciales-<?php echo $credenciales->idCredenciales; ?>').on('click', function(event) {
                        event.preventDefault(); // Prevenir el envío automático del formulario

                        $('#form-delete-credenciales-<?php echo $credenciales->idCredenciales; ?>').submit();
                    });
                <?php } ?>
            });
        </script>
    <?php
    } else {
        header("Location: credencialesAdmin.php");
    }
    ?>
</body>

</html>