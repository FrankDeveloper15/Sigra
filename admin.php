<?php
$pageTitle = "Administradores";
require_once("layouts/headAdmin.php");
?>


<body>
    <?php
    require_once("Model/AdminDAO.php");
    $admin = new Admin();
    $datosProcesados = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mensajesErrores = "";
        switch ($_POST['tipoEnvio']) {
            case 'insert':
                $admin->tipoDocumento = $_POST['tipoDocumentoInsert'];
                $admin->numDocumento = $_POST['numDocumentoInsert'];
                $admin->telefonoContacto = $_POST['telefonoContactoInsert'];
                $admin->nombreApellidos = $_POST['nombreApellidosInsert'];
                $admin->correoContacto = $_POST['correoContactoInsert'];
                $admin->contrasenia = $_POST['contraseniaInsert'];

                $mensajesErrores = $admin->validarAdmin();

                if (count($mensajesErrores) > 0) {
                    $datosProcesados = false;
                } else {
                    try {
                        $adminDAO = new AdminDAO();
                        $adminDAO->insert($admin);

                        $_SESSION['msj'] = "Se registro el administrador correctamente.";
                        $_SESSION['icon'] = "success";
                        $datosProcesados = true;
                    } catch (Exception $e) {
                        $mensajesErrores[] = $e->getMessage();
                        $datosProcesados = false;
                    }
                }
                break;
            case 'edit':
                $admin->idAdmin = $_POST['idAdminEdit'];
                $admin->tipoDocumento = $_POST['tipoDocumentoEdit'];
                $admin->numDocumento = $_POST['numDocumentoEdit'];
                $admin->telefonoContacto = $_POST['telefonoContactoEdit'];
                $admin->nombreApellidos = $_POST['nombreApellidosEdit'];
                $admin->correoContacto = $_POST['correoContactoEdit'];
                $admin->contrasenia = $_POST['contraseniaEdit'];
                $admin->forPassword = $_POST['forPassword'];

                $mensajesErrores = $admin->validarAdmin();

                if (count($mensajesErrores) > 0) {
                    $datosProcesados = false;
                } else {
                    try {
                        $adminDAO = new AdminDAO();
                        $adminDAO->edit($admin);

                        $_SESSION['msj'] = "Se edito el administrador correctamente.";
                        $_SESSION['icon'] = "success";
                        $datosProcesados = true;
                    } catch (Exception $e) {
                        $mensajesErrores[] = $e->getMessage();
                        $datosProcesados = false;
                    }
                }
                break;
            case 'delete':
                $idAdmin = $_POST['idAdminDelete'];

                try {
                    $adminDAO = new AdminDAO();
                    $adminDAO->delete($idAdmin);

                    $_SESSION['msj'] = "Se elimino el administrador correctamente.";
                    $_SESSION['icon'] = "success";
                    $datosProcesados = true;
                } catch (Exception $e) {
                    $_SESSION['msj'] = "No se puede eliminar el admin ya que esta relacionado con otras tablas.";
                    $_SESSION['icon'] = "error";
                    $datosProcesados = true;
                }
                break;
            default:

                break;
        }

        if (!empty($mensajesErrores)) {
            header("Location: admin.php");
            exit();
        }
    } else {
        try {
            $adminDAO = new AdminDAO();
            $adminArray = array();
            $adminArray = $adminDAO->list();
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
                <div class="col">
                    <span><strong>ADMINISTRADORES:</strong></span>
                </div>
                <div class="col">
                    <button class="btn btn-primary clr-pa" id="add-admin" data-bs-target="#modalAgregarAdmin" data-bs-toggle="modal"><i class="fa-solid fa-file-circle-plus"></i>&nbsp; AGREGAR</button>
                </div>
            </div>
        </div>
        <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded">
            <div class="row table-admin">
                <table class="table table-striped" id="adminTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>TIPO DOCUMENTO</th>
                            <th>NÚMERO DOCUMENTO</th>
                            <th>TELEFONO CONTACTO</th>
                            <th>NOMBRE Y APELLIDOS</th>
                            <th>CORREO CONTACTO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($adminArray as $index => $admin) { ?>
                            <tr data-id="<?php $index + 1; ?>">
                                <td style="text-align: center;"><?php echo $index + 1; ?></td>
                                <td><?php echo $admin->tipoDocumento; ?></td>
                                <td><?php echo $admin->numDocumento; ?></td>
                                <td><?php echo $admin->telefonoContacto; ?></td>
                                <td><?php echo $admin->nombreApellidos; ?></td>
                                <td><?php echo $admin->correoContacto; ?></td>
                                <td>
                                    <button class="btn btn-primary clr-cre" id="edit-admin" data-bs-target="#modalEditarAdmin-<?php echo $admin->idAdmin; ?>" data-bs-toggle="modal" style="border-radius: 10px 0 0 10px;"><i class="fa-solid fa-pen"></i></button><button class="btn btn-primary clr-so" id="delete-admin" data-bs-target="#modalEliminarAdmin-<?php echo $admin->idAdmin; ?>" data-bs-toggle="modal" style="border-radius: 0 10px 10px 0;"><i class="fa-solid fa-circle-xmark"></i></button>
                                </td>
                            </tr>
                        <?php }; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Agregar Administrador -->
        <div class="modal fade" id="modalAgregarAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header title-edit" style="background-color: #00b807; margin-top: 0px;">
                        <p>AGREGAR ADMINISTRADOR</p>
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
                            <div class="col mb-3" style="background-color: #00b807; color: #fff;">
                                <div class="col p-2">
                                    <span>DATOS BUSCADOS</span>
                                </div>
                            </div>
                            <div class="col mb-3 px-3">
                                <form id="form-admin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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
                                                    <input readonly type="text" class="form-control" id="numDocumentoInsert" name="numDocumentoInsert" minlength="8" maxlength="9">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <label for="nombreApellidosInsert" class="col-auto col-form-label">Nombre y Apellidos:</label>
                                                <div class="col">
                                                    <input readonly type="text" class="form-control" id="nombreApellidosInsert" name="nombreApellidosInsert">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-5">
                                            <div class="row">
                                                <label for="telefonoContactoInsert" class="col-auto col-form-label">Telefono Contacto:</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="telefonoContactoInsert" name="telefonoContactoInsert" maxlength="9" minlength="9">
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
                                                <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarAdmin" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Aceptar</button>
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


        <!-- Modal Aceptar Admin-->
        <div class="modal fade" id="modalAceptarAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #00b807; color: #fff;">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Agregar un Administrador</h1>
                    </div>
                    <div class="modal-body">
                        El administrador sera registrado.
                    </div>
                    <div class="modal-footer row align-items-center p-0">
                        <div class="row d-flex justify-content-end mb-3">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary cancelar" data-bs-target="#modalAgregarAdmin" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" id="btn-aceptar-admin" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php foreach ($adminArray as $admin) { ?>
            <!-- Modal Eliminar Admin-->
            <div class="modal fade" id="modalEliminarAdmin-<?php echo $admin->idAdmin; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="form-delete-admin-<?php echo $admin->idAdmin; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="modal-header" style="background-color: #ff0000; color: #fff;">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar Administrador</h1>
                            </div>
                            <div class="modal-body">
                                El administrador <?php echo $admin->nombreApellidos; ?> sera eliminado.
                                <input type="hidden" name="tipoEnvio" value="delete">
                                <input type="hidden" name="idAdminDelete" value="<?php echo $admin->idAdmin; ?>">
                            </div>
                            <div class="modal-footer row align-items-center p-0">
                                <div class="row d-flex justify-content-end mb-3">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-secondary cancelar" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary salvar" id="btn-aceptar-delete-admin-<?php echo $admin->idAdmin; ?>"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Editar Admin -->
            <div class="modal fade" id="modalEditarAdmin-<?php echo $admin->idAdmin; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header title-edit" style="background-color: #106da2; margin-top: 0px;">
                            <p>EDITAR ADMINISTRADOR</p>
                        </div>
                        <div class="modal-body">
                            <div id="alertaErroresEditar-<?php echo $admin->idAdmin; ?>" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                            </div>
                            <div class="col mb-3 px-3">
                                <form id="form-editar-admin-<?php echo $admin->idAdmin; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <input type="hidden" name="tipoEnvio" value="edit">
                                    <input type="hidden" id="idAdminEdit-<?php echo $admin->idAdmin; ?>" name="idAdminEdit" value="<?php echo $admin->idAdmin; ?>">
                                    <input type="hidden" id="forPassword-<?php echo $admin->idAdmin; ?>" name="forPassword">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-5">
                                            <div class="row">
                                                <label for="tipoDocumentoEdit-<?php echo $admin->idAdmin; ?>" class="col-auto col-form-label">Tipo de Doc:</label>
                                                <div class="col">
                                                    <input readonly type="text" class="form-control" id="tipoDocumentoEdit-<?php echo $admin->idAdmin; ?>" name="tipoDocumentoEdit" value="<?php echo $admin->tipoDocumento; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <label for="numDocumentoEdit-<?php echo $admin->idAdmin; ?>" class="col-auto col-form-label">N° Doc:</label>
                                                <div class="col">
                                                    <input readonly type="text" class="form-control" id="numDocumentoEdit-<?php echo $admin->idAdmin; ?>" name="numDocumentoEdit" value="<?php echo $admin->numDocumento; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <label for="nombreApellidosEdit-<?php echo $admin->idAdmin; ?>" class="col-auto col-form-label">Nombre y Apellidos:</label>
                                                <div class="col">
                                                    <input readonly type="text" class="form-control" id="nombreApellidosEdit-<?php echo $admin->idAdmin; ?>" name="nombreApellidosEdit" value="<?php echo $admin->nombreApellidos; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-5">
                                            <div class="row">
                                                <label for="telefonoContactoEdit-<?php echo $admin->idAdmin; ?>" class="col-auto col-form-label">Telefono Contacto:</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="telefonoContactoEdit-<?php echo $admin->idAdmin; ?>" name="telefonoContactoEdit" value="<?php echo $admin->telefonoContacto; ?>" maxlength="9" minlength="9">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <label for="correoContactoEdit-<?php echo $admin->idAdmin; ?>" class="col-auto col-form-label">Correo Contacto:</label>
                                                <div class="col">
                                                    <input type="email" class="form-control" id="correoContactoEdit-<?php echo $admin->idAdmin; ?>" name="correoContactoEdit" value="<?php echo $admin->correoContacto; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="contraseniaEdit-<?php echo $admin->idAdmin; ?>" class="col-auto col-form-label">Contraseña:</label>
                                                <div class="col input-group">
                                                    <input type="password" class="form-control" id="contraseniaEdit-<?php echo $admin->idAdmin; ?>" name="contraseniaEdit">
                                                    <button class="input-group-text" type="button" id="seePasswordEdit-<?php echo $admin->idAdmin; ?>">
                                                        <i class="fa-solid fa-eye-slash"></i>
                                                    </button>
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
                                                <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarEditarAdmin-<?php echo $admin->idAdmin; ?>" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Aceptar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Aceptar Editar Administrador -->
            <div class="modal fade" id="modalAceptarEditarAdmin-<?php echo $admin->idAdmin; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #106da2; color: #fff;">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Editar Este Administrador</h1>
                        </div>
                        <div class="modal-body">
                            El administrador <?php echo $admin->nombreApellidos; ?> será editado.
                        </div>
                        <div class="modal-footer row align-items-center p-0">
                            <div class="row d-flex justify-content-end mb-3">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalEditarAdmin-<?php echo $admin->idAdmin; ?>" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" id="btn-aceptar-editar-admin-<?php echo $admin->idAdmin; ?>" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
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
            <?php foreach ($adminArray as $admin) { ?>
                document.getElementById('seePasswordEdit-<?php echo $admin->idAdmin; ?>').addEventListener('click', function() {
                    const passwordEdit = document.getElementById('contraseniaEdit-<?php echo $admin->idAdmin; ?>');
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
        <!-- Para la busqueda de DNI o RUC -->
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
                                $('#nombreApellidosInsert').val(nombreCompleto);
                                $('#numDocumentoInsert').val(data.numeroDocumento);
                                $('#tipoDocumentoInsert').val('DNI');
                                $('#documento').val('');
                                alertaBusqueda.css('display', 'none');
                                alertaErrores.css('display', 'none');
                            }
                        } else if (tipoDoc === "RUC") {
                            if (data.numeroDocumento == documento) {
                                $('#nombreApellidosInsert').val(data.razonSocial);
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
        <!-- Para la tabla de administrador -->
        <script>
            $('#adminTable').DataTable({
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
                    "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ administradores",
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
        <!-- Para validar antes de agregar administrador -->
        <script>
            $(document).ready(function() {
                // Evento para el botón de aceptar en modalAgregarAdmin
                $('#btn-aceptar-admin').on('click', function(event) {
                    event.preventDefault(); // Prevenir el envío automático del formulario

                    // Validar los campos utilizando el modelo Admin
                    var tipoDocumento = $('#tipoDocumentoInsert').val().trim();
                    var numDocumento = $('#numDocumentoInsert').val().trim();
                    var telefonoContacto = $('#telefonoContactoInsert').val().trim();
                    var nombreApellidos = $('#nombreApellidosInsert').val().trim();
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

                    if (!nombreApellidos) {
                        mensajesErrores.push("El nombre apellidos no puede estar vacío.");
                    } else if (nombreApellidos.length > 60) {
                        mensajesErrores.push("El nombre apellidos no puede exceder 60 caracteres.");
                    }

                    if (!contrasenia) {
                        mensajesErrores.push("La contraseña no puede estar vacío.");
                    } else if (contrasenia.length > 255) {
                        mensajesErrores.push("La contraseña debe exceder los 255 caracteres.");
                    }

                    <?php foreach ($adminArray as $admin) { ?>
                        if (numDocumento === '<?php echo $admin->numDocumento; ?>') {
                            mensajesErrores.push("El número de documento ya existe.");
                        }

                        if (telefonoContacto === '<?php echo $admin->telefonoContacto; ?>') {
                            mensajesErrores.push("El teléfono contacto ya existe.");
                        }

                        if (correoContacto === '<?php echo $admin->correoContacto; ?>') {
                            mensajesErrores.push("El correo contacto ya existe.");
                        }
                    <?php } ?>

                    if (mensajesErrores.length > 0) {
                        var alertaErrores = $('#alertaErrores');
                        alertaErrores.css('display', 'block');
                        alertaErrores.html(mensajesErrores.join('<br>'));
                        $('#modalAceptarAdmin').modal('hide');
                        $('#modalAgregarAdmin').modal('show');
                    } else {
                        // Si no hay errores, verificar si existe duplicidad
                        $('#form-admin').submit(); // Enviar formulario si no hay errores
                    }
                });
            });
        </script>
        <!-- Para validar antes de editar administrador -->
        <script>
            $(document).ready(function() {
                <?php foreach ($adminArray as $admin) { ?>
                    // Evento para el botón de aceptar en modalEditarAdmin
                    $('#btn-aceptar-editar-admin-<?php echo $admin->idAdmin; ?>').on('click', function(event) {
                        event.preventDefault(); // Prevenir el envío automático del formulario

                        // Validar los campos utilizando el modelo Admin
                        var tipoDocumento = $('#tipoDocumentoEdit-<?php echo $admin->idAdmin; ?>').val().trim();
                        var numDocumento = $('#numDocumentoEdit-<?php echo $admin->idAdmin; ?>').val().trim();
                        var telefonoContacto = $('#telefonoContactoEdit-<?php echo $admin->idAdmin; ?>').val().trim();
                        var nombreApellidos = $('#nombreApellidosEdit-<?php echo $admin->idAdmin; ?>').val().trim();
                        var correoContacto = $('#correoContactoEdit-<?php echo $admin->idAdmin; ?>').val().trim();
                        var contrasenia = $('#contraseniaEdit-<?php echo $admin->idAdmin; ?>').val().trim();

                        // Validación
                        var mensajesErrores = [];

                        if (!tipoDocumento) {
                            mensajesErrores.push("El tipo de documento no puede estar vacío.");
                        } else if (tipoDocumento.length > 20) {
                            mensajesErrores.push("El tipo de documento no puede exceder 20 caracteres.");
                        }

                        if (!numDocumento) {
                            mensajesErrores.push("El número de documento no puede estar vacío.");
                        } else if (numDocumento.length > 15) {
                            mensajesErrores.push("El número de documento no puede exceder 15 caracteres.");
                        }

                        if (!telefonoContacto) {
                            mensajesErrores.push("El teléfono contacto no puede estar vacío.");
                        } else if (telefonoContacto.length !== 9) {
                            mensajesErrores.push("El teléfono contacto debe ser de 9 dígitos.");
                        }

                        if (!nombreApellidos) {
                            mensajesErrores.push("El nombre y apellidos no puede estar vacío.");
                        } else if (nombreApellidos.length > 60) {
                            mensajesErrores.push("El nombre y apellidos no puede exceder 60 caracteres.");
                        }

                        if (!correoContacto) {
                            mensajesErrores.push("El correo contacto no puede estar vacío.");
                        } else if (!/\S+@\S+\.\S+/.test(correoContacto)) {
                            mensajesErrores.push("El correo contacto tiene formato incorrecto.");
                        }

                        if (!contrasenia) {
                            $('#contraseniaEdit-<?php echo $admin->idAdmin; ?>').val('<?php echo $admin->contrasenia; ?>');
                        } else if (contrasenia.length > 255) {
                            mensajesErrores.push("La contraseña no puede exceder los 255 caracteres.");
                        } else {
                            $('#forPassword-<?php echo $admin->idAdmin; ?>').val('new');
                        }

                        // Verificación de la existencia de los valores teléfono y correo
                        <?php foreach ($adminArray as $value) { ?>
                            if ('<?php echo $admin->idAdmin; ?>' != '<?php echo $value->idAdmin; ?>' && (telefonoContacto === '<?php echo $value->telefonoContacto; ?>')) {
                                mensajesErrores.push("El teléfono contacto ya existe.");
                            }
                            if ('<?php echo $admin->idAdmin; ?>' != '<?php echo $value->idAdmin; ?>' && (correoContacto === '<?php echo $value->correoContacto; ?>')) {
                                mensajesErrores.push("El correo contacto ya existe.");
                            }
                        <?php } ?>

                        // Mostrar errores si los hay
                        if (mensajesErrores.length > 0) {
                            var alertaErrores = $('#alertaErroresEditar-<?php echo $admin->idAdmin; ?>');
                            alertaErrores.css('display', 'block');
                            alertaErrores.html(mensajesErrores.join('<br>'));

                            if (!contrasenia) {
                                $('#contraseniaEdit-<?php echo $admin->idAdmin; ?>').val('');
                            }

                            $('#modalAceptarEditarAdmin-<?php echo $admin->idAdmin; ?>').modal('hide');
                            $('#modalEditarAdmin-<?php echo $admin->idAdmin; ?>').modal('show');
                        } else {
                            var alertaErrores = $('#alertaErroresEditar-<?php echo $admin->idAdmin; ?>');
                            alertaErrores.css('display', 'none');
                            $('#form-editar-admin-<?php echo $admin->idAdmin; ?>').submit();
                        }
                    });
                <?php } ?>
            });
        </script>
        <!-- Para eliminar el administrador -->
        <script>
            $(document).ready(function() {
                <?php foreach ($adminArray as $admin) { ?>
                    // Evento para el botón de aceptar en modalEditarAdmin
                    $('#btn-aceptar-delete-admin-<?php echo $admin->idAdmin; ?>').on('click', function(event) {
                        event.preventDefault(); // Prevenir el envío automático del formulario

                        $('#form-delete-admin-<?php echo $admin->idAdmin; ?>').submit();
                    });
                <?php } ?>
            });
        </script>
    <?php
    } else {
        header("Location: admin.php");
    }
    ?>
</body>

</html>