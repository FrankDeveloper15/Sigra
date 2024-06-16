<?php
require_once("layouts/headCliente.php");
?>

<body>
    <?php
    require_once("layouts/headerCliente.php");
    ?>
    <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded">
        <div class="row table-contrato">
            <table class="table table-striped" id="contratos">
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
    <?php
    require_once("layouts/footer.php");
    ?>

    <?php require_once("layouts/script.php"); ?>
    <script>
        $('#contratos').DataTable({
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
    </script>
</body>

</html>