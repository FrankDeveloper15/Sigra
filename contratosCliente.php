<?php
$pageTitle = "Contratos";
require_once("layouts/headCliente.php");
?>

<body>
    <?php
    require_once("Model/ClienteDAO.php");
    $clienteDAO = new ClienteDAO();
    $contratoArray = array();
    $contratoArray = $clienteDAO->infoContrato($_SESSION['idClientes']);
    ?>

    <?php
    require_once("layouts/headerCliente.php");
    ?>
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
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    require_once("layouts/footer.php");
    ?>

    <?php require_once("layouts/script.php"); ?>
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
</body>

</html>