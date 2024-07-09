<?php
$pageTitle = "Facturas";
require_once("layouts/headCliente.php");
?>

<body>
    <?php
    require_once("Model/ClienteDAO.php");
    $clienteDAO = new ClienteDAO();
    $facturasArray = array();
    $facturasArray = $clienteDAO->infoFacturas($_SESSION['idClientes']);
    ?>
    <?php
    require_once("layouts/headerCliente.php");
    ?>
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
    <?php
    require_once("layouts/footer.php");
    ?>

    <?php require_once("layouts/script.php"); ?>
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
</body>

</html>