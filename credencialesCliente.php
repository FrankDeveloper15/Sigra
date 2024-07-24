<?php
$pageTitle = "Credenciales";
require_once("layouts/headCliente.php");
?>

<body>
    <?php
    require_once("Model/ClienteDAO.php");
    $clientesDAO = new ClienteDAO();
    $credencialesArray = array();
    $credencialesArray = $clientesDAO->infoCredenciales($_SESSION['idClientes']);
    ?>

        <?php
        require_once("layouts/headerCliente.php");
        ?>
        <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded">
            <div class="row table-credenciales">
                <table class="table table-striped" id="credenciales">
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
                        <?php foreach ($credencialesArray as $index => $credenciales) { ?>
                            <tr data-id="<?php $index + 1; ?>">
                                <td><?php echo $index + 1; ?></td>
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

        <?php
        require_once("layouts/footer.php");
        ?>

        <?php require_once("layouts/script.php"); ?>
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
</body>

</html>