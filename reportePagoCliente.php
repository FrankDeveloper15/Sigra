<?php
require_once("layouts/headCliente.php");
?>

<body>
    <?php
    require_once("layouts/headerCliente.php");
    ?>
    <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded">
        <div class="row table-reporte">
            <table class="table table-striped" id="reportePago">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>MES</th>
                        <th>S/.</th>
                        <th>FECHA EMI.</th>
                        <th>FECHA VEN.</th>
                        <th>REPORTADO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Noviembre 2023</td>
                        <td>37.9</td>
                        <td>03/11/2023</td>
                        <td>04/11/2023</td>
                        <td>Pendiente</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>Noviembre 2023</td>
                        <td>37.9</td>
                        <td>03/11/2023</td>
                        <td>04/11/2023</td>
                        <td>Pendiente</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>Noviembre 2023</td>
                        <td>37.9</td>
                        <td>03/11/2023</td>
                        <td>04/11/2023</td>
                        <td>Pendiente</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>Noviembre 2023</td>
                        <td>37.9</td>
                        <td>03/11/2023</td>
                        <td>04/11/2023</td>
                        <td>Pendiente</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>Noviembre 2023</td>
                        <td>37.9</td>
                        <td>03/11/2023</td>
                        <td>04/11/2023</td>
                        <td>Pendiente</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>Noviembre 2023</td>
                        <td>37.9</td>
                        <td>03/11/2023</td>
                        <td>04/11/2023</td>
                        <td>Pendiente</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>Noviembre 2023</td>
                        <td>37.9</td>
                        <td>03/11/2023</td>
                        <td>04/11/2023</td>
                        <td>Pendiente</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>Noviembre 2023</td>
                        <td>37.9</td>
                        <td>03/11/2023</td>
                        <td>04/11/2023</td>
                        <td>Pendiente</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>Noviembre 2023</td>
                        <td>37.9</td>
                        <td>03/11/2023</td>
                        <td>04/11/2023</td>
                        <td>Pendiente</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>Noviembre 2023</td>
                        <td>37.9</td>
                        <td>03/11/2023</td>
                        <td>04/11/2023</td>
                        <td>Pendiente</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>Noviembre 2023</td>
                        <td>37.9</td>
                        <td>03/11/2023</td>
                        <td>04/11/2023</td>
                        <td>Pendiente</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>Noviembre 2023</td>
                        <td>37.9</td>
                        <td>03/11/2023</td>
                        <td>04/11/2023</td>
                        <td>Pendiente</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>Noviembre 2023</td>
                        <td>37.9</td>
                        <td>03/11/2023</td>
                        <td>04/11/2023</td>
                        <td>Pendiente</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>Noviembre 2023</td>
                        <td>37.9</td>
                        <td>03/11/2023</td>
                        <td>04/11/2023</td>
                        <td>Pendiente</td>
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
        $('#reportePago').DataTable({
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
                "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ Reporte Pago",
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