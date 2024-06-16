<?php
require_once("layouts/headAdmin.php");
?>

<body>
    <?php
    require_once("layouts/headerAdmin.php");
    ?>
    <div class="container-fluid p-4">
        <button type="button" class="btn btn-primary w-auto clr-con" id="agregar-contrato" data-bs-toggle="modal" data-bs-target="#modalAgregarContrato"><i class="fa-solid fa-file-circle-plus"></i> AGREGAR</button>
    </div>
    <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded">
        <div class="row table-contrato">
            <table class="table table-striped" id="contrato">
                <thead>
                    <tr>
                        <th>SERVICIO</th>
                        <th>DOCUMENTO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Diseño</td>
                        <td>
                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Diseño</td>
                        <td>
                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Diseño</td>
                        <td>
                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Diseño</td>
                        <td>
                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Diseño</td>
                        <td>
                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Diseño</td>
                        <td>
                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Diseño</td>
                        <td>
                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Diseño</td>
                        <td>
                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Diseño</td>
                        <td>
                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Diseño</td>
                        <td>
                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Diseño</td>
                        <td>
                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Diseño</td>
                        <td>
                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Diseño</td>
                        <td>
                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                            </a>
                        </td>
                    </tr>

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
                    <div class="col mb-3 px-3">
                        <form id="form-contrato" action="">
                            <input type="hidden" name="idCliente">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-5">
                                    <div class="row">
                                        <label for="selectAdmin" class="col-auto col-form-label">Admin:</label>
                                        <div class="col">
                                            <select title="Admin..." data-style="btn-secondary" class="form-control" name="selectAdmin" id="selectAdmin">
                                                <option value="dni">Jhon Casimiro</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <label for="selectCredenciales" class="col-auto col-form-label">Credenciales:</label>
                                        <div class="col">
                                            <select title="Credenciales..." data-style="btn-secondary" class="form-control" name="selectCredenciales" id="selectCredenciales">
                                                <option value="diseñoWeb">Diseño Web</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col">
                                    <div class="row">
                                        <label for="fechaInicio" class="col-auto col-form-label">Fecha Inicio:</label>
                                        <div class="col">
                                            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <label for="fechaRenovacion" class="col-auto col-form-label">Fecha Renovación:</label>
                                        <div class="col">
                                            <input type="date" class="form-control" id="fechaRenovacion" name="fechaRenovacion">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label for="archivoContrato" class="col-auto col-form-label">Archivo Contrato:</label>
                                        <div class="col">
                                            <input type="file" class="form-control" id="archivoContrato" name="archivoContrato">
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
                                        <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarContrato" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
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
                            <button type="submit" id="btn-aceptar-contrato" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar Contrato-->
    <div class="modal fade" id="modalEliminarContrato" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #4a4a4a; color: #fff;">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar Contrato</h1>
                </div>
                <div class="modal-body">
                    El contrato sera eliminado.
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
    <?php
    require_once("layouts/footer.php");
    ?>

    <?php require_once("layouts/script.php"); ?>
    <script>
        document.getElementById('btn-aceptar-contrato').addEventListener('click', function() {
            document.getElementById('form-contrato').submit();
        });
    </script>
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
</body>

</html>