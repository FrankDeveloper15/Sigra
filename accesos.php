<?php
    require_once("layouts/headAdmin.php");
?>

<body>
    <?php
        require_once("layouts/headerAdmin.php");
    ?>
    <main>
        <div class="container__clientes">
            <div class="container__title historial__button">
                <button class="agregar__secundario"><i class="fa-solid fa-file-circle-plus"></i> AGREGAR</button>
            </div>
            <div class="container__tabla__historial">
                <table class="tabla__historial">
                    <thead class="cabezado__historial">
                        <tr>
                            <th class="fila__secundaria__one">SERVICIO</th>
                            <th class="fila__secundaria__two">TIPO</th>
                            <th class="fila__secundaria__three">N° USUARIO</th>
                            <th class="fila__secundaria__four">CONTRASEÑA</th>
                            <th class="fila__secundaria__five">LIK DE ACCESO</th>
                            <th class="fila__secundaria__six">F. INICIO</th>
                            <th class="fila__secundaria__seven">F. RENOVACIÓN</th>
                            <th class="fila__secundaria__night">OBSERVACIÓN</th>
                        </tr>
                    </thead>
                    <tbody class="cuerpo__historial">
                        <tr>
                            <td class="fila__secundaria__one">Diseño</td>
                            <td class="fila__secundaria__two">Web</td>
                            <td class="fila__secundaria__three">admin053@tudominio.com</td>
                            <td class="fila__secundaria__four">Admin5553</td>
                            <td class="fila__secundaria__five">www.microsoft.com</td>
                            <td class="fila__secundaria__six">15/04/2023</td>
                            <td class="fila__secundaria__seven">15/05/2024</td>
                            <td class="fila__secundaria__night">Acceder desde un ordenador</td>
                        </tr>
                        <tr>
                            <td class="fila__secundaria__one">Correo</td>
                            <td class="fila__secundaria__two">Corporativo</td>
                            <td class="fila__secundaria__three">global@tunegocio.pe</td>
                            <td class="fila__secundaria__four">SShmgnnfnv</td>
                            <td class="fila__secundaria__five">www.google.com</td>
                            <td class="fila__secundaria__six">25/03/2022</td>
                            <td class="fila__secundaria__seven">17/09/2028</td>
                            <td class="fila__secundaria__night">Recuerde que acceder desde navegador incognito</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php
        require_once("layouts/footerAdmin.php");
    ?>
</body>

</html>