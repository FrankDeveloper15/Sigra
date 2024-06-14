<?php
require_once("layouts/headAdmin.php");
?>

<body>
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
            <div class="col">
                <button class="btn btn-primary clr-cre" id="edit-servicios" data-bs-target="#modalEditarServicios" data-bs-toggle="modal"><i class="fa-solid fa-pen"></i>&nbsp; MODIFICAR</button>
            </div>
            <div class="col">
                <button class="btn btn-primary clr-so" id="delete-servicios" data-bs-target="#modalEliminarServicios" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; ELIMINAR</button>
            </div>
        </div>
    </div>
    <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded">
        <div class="row">
            <table class="table table-servicios">
                <thead class="encabezadoEstatico">
                    <tr>
                        <th>NOMBRE DE SERVICIO O PRODUCTO</th>
                        <th>CODIGO UNICO</th>
                        <th>FECHA DE REGISTRO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>LICENCIA DE USO PERSONAL MICROSOFT 365 100GB</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2022</td>
                    </tr>
                    <tr>
                        <td>LICENCIA DE USO PERSONAL MICROSOFT 365 100GB</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2022</td>
                    </tr>
                    <tr>
                        <td>LICENCIA DE USO PERSONAL MICROSOFT 365 100GB</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2022</td>
                    </tr>
                    <tr>
                        <td>LICENCIA DE USO PERSONAL MICROSOFT 365 100GB</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2022</td>
                    </tr>
                    <tr>
                        <td>LICENCIA DE USO PERSONAL MICROSOFT 365 100GB</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2022</td>
                    </tr>
                    <tr>
                        <td>LICENCIA DE USO PERSONAL MICROSOFT 365 100GB</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2022</td>
                    </tr>
                    <tr>
                        <td>LICENCIA DE USO PERSONAL MICROSOFT 365 100GB</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2022</td>
                    </tr>
                    <tr>
                        <td>LICENCIA DE USO PERSONAL MICROSOFT 365 100GB</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2022</td>
                    </tr>
                    <tr>
                        <td>LICENCIA DE USO PERSONAL MICROSOFT 365 100GB</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2022</td>
                    </tr>
                    <tr>
                        <td>LICENCIA DE USO PERSONAL MICROSOFT 365 100GB</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2022</td>
                    </tr>
                    <tr>
                        <td>LICENCIA DE USO PERSONAL MICROSOFT 365 100GB</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2022</td>
                    </tr>
                    <tr>
                        <td>LICENCIA DE USO PERSONAL MICROSOFT 365 100GB</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2022</td>
                    </tr>
                    <tr>
                        <td>LICENCIA DE USO PERSONAL MICROSOFT 365 100GB</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2022</td>
                    </tr>
                    <tr>
                        <td>LICENCIA DE USO PERSONAL MICROSOFT 365 100GB</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2022</td>
                    </tr>
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
                    <div class="col mb-3 px-3">
                        <form id="form-servicios" action="">
                            <input type="hidden" name="idCliente">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-5">
                                    <div class="row">
                                        <label for="nombreServicios" class="col-auto col-form-label">Nombre de Servicios:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="nombreServicios" name="nombreServicios">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <label for="numeroProveedor" class="col-auto col-form-label">Número de Proveedor:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="numeroProveedor" name="numeroProveedor">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label for="linkAcceso" class="col-auto col-form-label">Link Acceso:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="linkAcceso" name="linkAcceso">
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
                                        <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarServicios" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
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
                            <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalAgregarServicios" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" id="btn-aceptar-servicios" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar Servicios-->
    <div class="modal fade" id="modalEliminarServicios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #ff0000; color: #fff;">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar Servicio</h1>
                </div>
                <div class="modal-body">
                    El servicio sera eliminado.
                </div>
                <div class="modal-footer row align-items-center p-0">
                    <div class="row d-flex justify-content-end mb-3">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary cancelar" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Servicios -->
    <div class="modal fade" id="modalEditarServicios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header title-edit" style="background-color: #106da2; margin-top: 0px;">
                    <p>EDITAR SERVICIOS</p>
                </div>
                <div class="modal-body">
                    <div class="col mb-3 px-3">
                        <form id="form-editar-servicios" action="">
                            <input type="hidden" name="idCliente">
                            <div class="row align-items-center mb-3">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-5">
                                    <div class="row">
                                        <label for="nombreServicios" class="col-auto col-form-label">Nombre de Servicios:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="nombreServicios" name="nombreServicios">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <label for="numeroProveedor" class="col-auto col-form-label">Número de Proveedor:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="numeroProveedor" name="numeroProveedor">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label for="linkAcceso" class="col-auto col-form-label">Link Acceso:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="linkAcceso" name="linkAcceso">
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
                                        <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarEditarServicios" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
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
    <div class="modal fade" id="modalAceptarEditarServicios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalEditarServicios" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" id="btn-aceptar-editar-servicios" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
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
        document.getElementById('btn-aceptar-editar-servicios').addEventListener('click', function() {
            document.getElementById('form-editar-servicios').submit();
        });

        document.getElementById('btn-aceptar-servicios').addEventListener('click', function() {
            document.getElementById('form-servicios').submit();
        });
    </script>
</body>

</html>