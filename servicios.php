<?php
require_once("layouts/headAdmin.php");
?>


<body>
    <?php
    require_once("Model/ServiciosDAO.php");
    $servicios = new Servicios();
    $datosProcesados = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        switch ($_POST['tipoEnvio']) {
            case 'insert':
                $servicios->nombreServicios = $_POST['nombreServiciosInsert'];
                $servicios->correoProveedor = $_POST['correoProveedorInsert'];
                $servicios->linkAcceso = $_POST['linkAccesoInsert'];

                $mensajesErrores = $servicios->validarServicios();

                if (count($mensajesErrores) > 0) {
                    $datosProcesados = false;
                } else {
                    try {
                        $serviciosDAO = new ServiciosDAO();
                        $serviciosDAO->insert($servicios);

                        $datosProcesados = true;
                    } catch (Exception $e) {
                        $mensajesErrores[] = $e->getMessage();
                        $datosProcesados = false;
                    }
                }
                break;
            case 'edit':

                $servicios->idServicios = $_POST['idServiciosEdit'];
                $servicios->nombreServicios = $_POST['nombreServiciosEdit'];
                $servicios->correoProveedor = $_POST['correoProveedorEdit'];
                $servicios->linkAcceso = $_POST['linkAccesoEdit'];

                $mensajesErrores = $servicios->validarServicios();

                if (count($mensajesErrores) > 0) {
                    $datosProcesados = false;
                } else {
                    try {
                        $serviciosDAO = new ServiciosDAO();
                        $serviciosDAO->edit($servicios);

                        $datosProcesados = true;
                    } catch (Exception $e) {
                        $mensajesErrores[] = $e->getMessage();
                        $datosProcesados = false;
                    }
                }
                break;
            case 'delete':
                $idServicios = $_POST['idServiciosDelete'];

                try {
                    $serviciosDAO = new ServiciosDAO();
                    $serviciosDAO->delete($idServicios);

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
            header("Location: servicios.php");
            exit();
        }
    } else {
        try {
            $serviciosDAO = new ServiciosDAO();
            $serviciosArray = array();
            $serviciosArray = $serviciosDAO->list();
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

        <div class="container-fluid p-4">
            <div class="row">
                <div class="col">
                    <span><strong>SERVICIOS:</strong></span>
                </div>
                <div class="col">
                    <button class="btn btn-primary clr-pa" id="add-servicios" data-bs-target="#modalAgregarServicios" data-bs-toggle="modal"><i class="fa-solid fa-file-circle-plus"></i>&nbsp; AGREGAR</button>
                </div>
            </div>
        </div>
        <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded">
            <div class="row table-servicios">
                <table class="table table-striped" id="serviciosTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NOMBRE DE SERVICIO O PRODUCTO</th>
                            <th>CORREO PROVEEDOR</th>
                            <th>LINK DE ACCESO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($serviciosArray as $index => $servicios) { ?>
                            <tr data-id="<?php $index + 1; ?>">
                                <td style="text-align: center;"><?php echo $index + 1; ?></td>
                                <td><?php echo $servicios->nombreServicios; ?></td>
                                <td><?php echo $servicios->correoProveedor; ?></td>
                                <td><?php echo $servicios->linkAcceso; ?></td>
                                <td>
                                    <button class="btn btn-primary clr-cre" id="edit-servicios" data-bs-target="#modalEditarServicios-<?php echo $servicios->idServicios; ?>" data-bs-toggle="modal" style="border-radius: 10px 0 0 10px;"><i class="fa-solid fa-pen"></i></button><button class="btn btn-primary clr-so" id="delete-servicios" data-bs-target="#modalEliminarServicios-<?php echo $servicios->idServicios; ?>" data-bs-toggle="modal" style="border-radius: 0 10px 10px 0;"><i class="fa-solid fa-circle-xmark"></i></button>
                                    <!-- Modal Eliminar Servicios-->
                                    <div class="modal fade" id="modalEliminarServicios-<?php echo $servicios->idServicios; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form id="form-delete-servicios-<?php echo $servicios->idServicios; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                    <div class="modal-header" style="background-color: #ff0000; color: #fff;">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar Servicio</h1>
                                                    </div>
                                                    <div class="modal-body">
                                                        El servicio <?php echo $servicios->nombreServicios;?> sera eliminado.
                                                        <input type="hidden" name="tipoEnvio" value="delete">
                                                        <input type="hidden" name="idServiciosDelete" value="<?php echo $servicios->idServicios; ?>">
                                                    </div>
                                                    <div class="modal-footer row align-items-center p-0">
                                                        <div class="row d-flex justify-content-end mb-3">
                                                            <div class="col-md-4">
                                                                <button type="button" class="btn btn-secondary cancelar" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <button type="submit" class="btn btn-primary salvar" id="btn-aceptar-delete-servicios-<?php echo $servicios->idServicios; ?>"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Eliminar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Editar Servicios -->
                                    <div class="modal fade" id="modalEditarServicios-<?php echo $servicios->idServicios; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header title-edit" style="background-color: #106da2; margin-top: 0px;">
                                                    <p>EDITAR SERVICIOS</p>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="alertaErroresEditar-<?php echo $servicios->idServicios; ?>" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                                                    </div>
                                                    <div class="col mb-3 px-3">
                                                        <form id="form-editar-servicios-<?php echo $servicios->idServicios; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                            <input type="hidden" name="tipoEnvio" value="edit">
                                                            <input type="hidden" name="idServiciosEdit" value="<?php echo $servicios->idServicios; ?>">
                                                            <div class="row align-items-center mb-3">
                                                                <div class="col-md-6">
                                                                    <div class="col">
                                                                        <label for="nombreServiciosEdit-<?php echo $servicios->idServicios; ?>" class="col-auto col-form-label">Nombre de Servicios:</label>
                                                                        <div class="col">
                                                                            <input type="text" class="form-control" id="nombreServiciosEdit-<?php echo $servicios->idServicios; ?>" name="nombreServiciosEdit" value="<?php echo $servicios->nombreServicios; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="col">
                                                                        <label for="correoProveedorEdit-<?php echo $servicios->idServicios; ?>" class="col-auto col-form-label">Correo de Proveedor:</label>
                                                                        <div class="col">
                                                                            <input type="text" class="form-control" id="correoProveedorEdit-<?php echo $servicios->idServicios; ?>" name="correoProveedorEdit" value="<?php echo $servicios->correoProveedor; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <label for="linkAccesoEdit-<?php echo $servicios->idServicios; ?>" class="col-auto col-form-label">Link Acceso:</label>
                                                                        <div class="col">
                                                                            <input type="text" class="form-control" id="linkAccesoEdit-<?php echo $servicios->idServicios; ?>" name="linkAccesoEdit" value="<?php echo $servicios->linkAcceso; ?>">
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
                                                                        <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarEditarServicios-<?php echo $servicios->idServicios; ?>" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Aceptar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Editar Servicios-->
                                    <div class="modal fade" id="modalAceptarEditarServicios-<?php echo $servicios->idServicios; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #106da2; color: #fff;">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Editar Este Servicio</h1>
                                                </div>
                                                <div class="modal-body">
                                                    El servicio sera editado.
                                                </div>
                                                <div class="modal-footer row align-items-center p-0">
                                                    <div class="row d-flex justify-content-end mb-3">
                                                        <div class="col-md-4">
                                                            <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalEditarServicios-<?php echo $servicios->idServicios; ?>" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <button type="submit" id="btn-aceptar-editar-servicios-<?php echo $servicios->idServicios; ?>" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php }; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Agregar Servicios -->
        <div class="modal fade" id="modalAgregarServicios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header title-edit" style="background-color: #00b807; margin-top: 0px;">
                        <p>AGREGAR SERVICIOS</p>
                    </div>
                    <div class="modal-body">
                        <div id="alertaErrores" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        </div>
                        <div class="col mb-3 px-3">
                            <form id="form-servicios" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <input type="hidden" name="tipoEnvio" value="insert">
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-6">
                                        <div class="col">
                                            <label for="nombreServiciosInsert" class="col-auto col-form-label">Nombre de Servicios:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="nombreServiciosInsert" name="nombreServiciosInsert">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col">
                                            <label for="correoProveedorInsert" class="col-auto col-form-label">Correo de Proveedor:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="correoProveedorInsert" name="correoProveedorInsert">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label for="linkAccesoInsert" class="col-auto col-form-label">Link Acceso:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="linkAccesoInsert" name="linkAccesoInsert">
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
                                            <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarServicios" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Aceptar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Aceptar Servicios-->
        <div class="modal fade" id="modalAceptarServicios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #00b807; color: #fff;">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Agregar un Servicio</h1>
                    </div>
                    <div class="modal-body">
                        El servicio sera registrado.
                    </div>
                    <div class="modal-footer row align-items-center p-0">
                        <div class="row d-flex justify-content-end mb-3">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary cancelar" data-bs-target="#modalAgregarServicios" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" id="btn-aceptar-servicios" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once("layouts/footer.php");
        ?>

        <?php require_once("layouts/script.php"); ?>

        <script>
            $('#serviciosTable').DataTable({
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
                    "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ servicios",
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
                // Evento para el botón de aceptar en modalAgregarServicios
                $('#btn-aceptar-servicios').on('click', function(event) {
                    event.preventDefault(); // Prevenir el envío automático del formulario

                    // Validar los campos utilizando el modelo Servicios
                    var nombreServicios = $('#nombreServiciosInsert').val().trim();
                    var correoProveedor = $('#correoProveedorInsert').val().trim();
                    var linkAcceso = $('#linkAccesoInsert').val().trim();

                    // Validación
                    var mensajesErrores = [];

                    if (!nombreServicios) {
                        mensajesErrores.push("El nombre de servicios no puede estar vacío.");
                    } else if (nombreServicios.length > 50) {
                        mensajesErrores.push("Nombre de servicios no puede exceder 50 caracteres.");
                    }

                    if (!correoProveedor) {
                        mensajesErrores.push("El correo no puede estar vacío.");
                    } else if (!/\S+@\S+\.\S+/.test(correoProveedor)) {
                        mensajesErrores.push("El correo del proveedor tiene formato incorrecto.");
                    }

                    if (!linkAcceso) {
                        mensajesErrores.push("El link de acceso no puede estar vacío.");
                    } else if (linkAcceso.length > 255) {
                        mensajesErrores.push("El link de acceso no debe exceder los 255 caracteres.");
                    }

                    if (mensajesErrores.length > 0) {
                        var alertaErrores = $('#alertaErrores');
                        alertaErrores.css('display', 'block');
                        alertaErrores.html(mensajesErrores.join('<br>'));
                        $('#modalAceptarServicios').modal('hide');
                        $('#modalAgregarServicios').modal('show');
                    } else {
                        // Si no hay errores, enviar el formulario
                        $('#form-servicios').submit();
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                <?php foreach ($serviciosArray as $servicios) { ?>
                    // Evento para el botón de aceptar en modalEditarServicios
                    $('#btn-aceptar-editar-servicios-<?php echo $servicios->idServicios; ?>').on('click', function(event) {
                        event.preventDefault(); // Prevenir el envío automático del formulario

                        // Validar los campos utilizando el modelo Servicios
                        var nombreServicios = $('#nombreServiciosEdit-<?php echo $servicios->idServicios; ?>').val().trim();
                        var correoProveedor = $('#correoProveedorEdit-<?php echo $servicios->idServicios; ?>').val().trim();
                        var linkAcceso = $('#linkAccesoEdit-<?php echo $servicios->idServicios; ?>').val().trim();

                        // Validación
                        var mensajesErrores = [];

                        if (!nombreServicios) {
                            mensajesErrores.push("El nombre de servicios no puede estar vacío.");
                        } else if (nombreServicios.length > 50) {
                            mensajesErrores.push("Nombre de servicios no puede exceder 50 caracteres.");
                        }

                        if (!correoProveedor) {
                            mensajesErrores.push("El correo no puede estar vacío.");
                        } else if (!/\S+@\S+\.\S+/.test(correoProveedor)) {
                            mensajesErrores.push("El correo del proveedor tiene formato incorrecto.");
                        }

                        if (!linkAcceso) {
                            mensajesErrores.push("El link de acceso no puede estar vacío.");
                        } else if (linkAcceso.length > 255) {
                            mensajesErrores.push("El link de acceso no debe exceder los 255 caracteres.");
                        }

                        if (mensajesErrores.length > 0) {
                            var alertaErrores = $('#alertaErroresEditar-<?php echo $servicios->idServicios; ?>');
                            alertaErrores.css('display', 'block');
                            alertaErrores.html(mensajesErrores.join('<br>'));
                            $('#modalAceptarEditarServicios-<?php echo $servicios->idServicios; ?>').modal('hide');
                            $('#modalEditarServicios-<?php echo $servicios->idServicios; ?>').modal('show');
                        } else {
                            // Si no hay errores, enviar el formulario
                            $('#form-editar-servicios-<?php echo $servicios->idServicios; ?>').submit();
                        }
                    });
                <?php } ?>
            });
        </script>

        <script>
            $(document).ready(function() {
                <?php foreach ($serviciosArray as $servicios) { ?>
                    // Evento para el botón de aceptar en modalEditarServicios
                    $('#btn-aceptar-delete-servicios-<?php echo $servicios->idServicios; ?>').on('click', function(event) {
                        event.preventDefault(); // Prevenir el envío automático del formulario

                        $('#form-delete-servicios-<?php echo $servicios->idServicios; ?>').submit();
                    });
                <?php } ?>
            });
        </script>

    <?php
    } else {
        header("Location: servicios.php");
    }
    ?>
</body>

</html>